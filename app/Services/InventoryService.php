<?php

namespace App\Services;

use App\Enums\StockMovementType;
use App\Exceptions\InsufficientStockException;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\ProductVariant;
use App\Models\StockMovement;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Single source of truth for stock changes. Every change goes through a signed stock-movement
 * ledger entry; the per-(variant, warehouse) `inventories.quantity` and the variant's overall
 * `quantity` total are recomputed from that ledger inside one transaction.
 */
class InventoryService
{
    /**
     * Record a signed stock movement and apply it to inventory.
     *
     * @param  int  $quantity  signed: positive adds stock, negative removes it
     *
     * @throws InsufficientStockException when the change would drive a location negative
     */
    public function record(
        ProductVariant $variant,
        Warehouse $warehouse,
        StockMovementType $type,
        int $quantity,
        ?string $note = null,
        ?Model $reference = null,
        ?int $userId = null,
    ): StockMovement {
        return DB::transaction(function () use ($variant, $warehouse, $type, $quantity, $note, $reference, $userId) {
            $inventory = Inventory::query()
                ->where('product_variant_id', $variant->id)
                ->where('warehouse_id', $warehouse->id)
                ->lockForUpdate()
                ->first();

            $current = $inventory?->quantity ?? 0;
            $next = $current + $quantity;

            if ($next < 0) {
                throw InsufficientStockException::for($variant, $warehouse, $current, $quantity);
            }

            $movement = StockMovement::create([
                'product_variant_id' => $variant->id,
                'warehouse_id' => $warehouse->id,
                'type' => $type,
                'quantity' => $quantity,
                'reference_type' => $reference?->getMorphClass(),
                'reference_id' => $reference?->getKey(),
                'note' => $note,
                'user_id' => $userId,
            ]);

            $this->writeInventory($variant, $warehouse, $next, $inventory);
            $this->recomputeVariantTotal($variant);

            return $movement;
        });
    }

    /**
     * Set a location's stock to an absolute level, recording the difference as an adjustment.
     */
    public function setLevel(ProductVariant $variant, Warehouse $warehouse, int $target, ?string $note = null, ?int $userId = null): ?StockMovement
    {
        $current = Inventory::query()
            ->where('product_variant_id', $variant->id)
            ->where('warehouse_id', $warehouse->id)
            ->value('quantity') ?? 0;

        $delta = $target - $current;

        if ($delta === 0) {
            return null;
        }

        return $this->record($variant, $warehouse, StockMovementType::Adjustment, $delta, $note, userId: $userId);
    }

    /**
     * Move stock between two warehouses as a paired transfer (out then in).
     *
     * @return array{0: StockMovement, 1: StockMovement}
     */
    public function transfer(ProductVariant $variant, Warehouse $from, Warehouse $to, int $quantity, ?string $note = null, ?int $userId = null): array
    {
        return DB::transaction(function () use ($variant, $from, $to, $quantity, $note, $userId) {
            $out = $this->record($variant, $from, StockMovementType::Transfer, -abs($quantity), $note, userId: $userId);
            $in = $this->record($variant, $to, StockMovementType::Transfer, abs($quantity), $note, userId: $userId);

            return [$out, $in];
        });
    }

    /**
     * Total stock for a variant across all warehouses.
     */
    public function totalFor(ProductVariant $variant): int
    {
        return (int) Inventory::query()->where('product_variant_id', $variant->id)->sum('quantity');
    }

    /**
     * Deduct an order's items from stock as Sale movements. Best-effort: each variant is
     * drawn from its warehouses highest-stock-first and never driven negative, so this never
     * blocks an order even if stock is short. Idempotent via the order's stock_committed flag.
     */
    public function commitOrder(Order $order, ?int $userId = null): void
    {
        if ($order->stock_committed) {
            return;
        }

        DB::transaction(function () use ($order, $userId) {
            foreach ($order->items as $item) {
                if ($item->product_variant_id && $item->quantity > 0) {
                    $variant = ProductVariant::find($item->product_variant_id);
                    if ($variant) {
                        $this->deductBestEffort($variant, (int) $item->quantity, $order, $userId);
                    }
                }
            }

            $order->forceFill(['stock_committed' => true])->save();
        });
    }

    /**
     * Reverse a previously-committed order's stock by recording Return movements that mirror
     * the Sale movements taken for it (same warehouses, opposite sign). Idempotent.
     */
    public function releaseOrder(Order $order, ?int $userId = null): void
    {
        if (! $order->stock_committed) {
            return;
        }

        DB::transaction(function () use ($order, $userId) {
            $sales = StockMovement::query()
                ->where('reference_type', $order->getMorphClass())
                ->where('reference_id', $order->getKey())
                ->where('type', StockMovementType::Sale)
                ->with('variant', 'warehouse')
                ->get();

            foreach ($sales as $sale) {
                if ($sale->variant && $sale->warehouse) {
                    $this->record($sale->variant, $sale->warehouse, StockMovementType::Return, abs($sale->quantity), 'Order release', $order, $userId);
                }
            }

            $order->forceFill(['stock_committed' => false])->save();
        });
    }

    /**
     * Draw a quantity from a variant's warehouses, highest stock first, never going negative.
     * Materialises a denormalised `quantity` into an opening inventory row on first use so
     * existing catalogue variants (stock set directly on the variant) participate.
     */
    protected function deductBestEffort(ProductVariant $variant, int $quantity, ?Model $reference, ?int $userId): void
    {
        if ($quantity <= 0) {
            return;
        }

        $this->ensureInventorySeeded($variant);

        $rows = Inventory::query()
            ->where('product_variant_id', $variant->id)
            ->where('quantity', '>', 0)
            ->with('warehouse')
            ->orderByDesc('quantity')
            ->get();

        $remaining = $quantity;

        foreach ($rows as $row) {
            if ($remaining <= 0) {
                break;
            }

            $take = min($remaining, $row->quantity);
            $this->record($variant, $row->warehouse, StockMovementType::Sale, -$take, null, $reference, $userId);
            $remaining -= $take;
        }
    }

    /**
     * Materialise a variant's denormalised `quantity` into an opening inventory row when it has
     * no per-warehouse rows yet, so ledger operations have stock to work against.
     */
    protected function ensureInventorySeeded(ProductVariant $variant): void
    {
        if ($variant->quantity <= 0 || $variant->inventories()->exists()) {
            return;
        }

        $warehouse = Warehouse::query()->orderBy('id')->first();

        if ($warehouse) {
            $this->record($variant, $warehouse, StockMovementType::Adjustment, (int) $variant->quantity, 'Opening stock', null, null);
        }
    }

    protected function writeInventory(ProductVariant $variant, Warehouse $warehouse, int $quantity, ?Inventory $inventory): void
    {
        if ($inventory) {
            $inventory->update(['quantity' => $quantity]);

            return;
        }

        Inventory::create([
            'product_variant_id' => $variant->id,
            'product_id' => $variant->product_id, // legacy non-null column
            'warehouse_id' => $warehouse->id,
            'quantity' => $quantity,
        ]);
    }

    /**
     * Keep the variant's denormalised total in sync with the ledger-backed inventory rows.
     */
    protected function recomputeVariantTotal(ProductVariant $variant): void
    {
        $variant->forceFill(['quantity' => $this->totalFor($variant)])->saveQuietly();
    }
}
