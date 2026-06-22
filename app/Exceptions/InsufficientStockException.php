<?php

namespace App\Exceptions;

use App\Models\ProductVariant;
use App\Models\Warehouse;

final class InsufficientStockException extends \RuntimeException
{
    public static function for(ProductVariant $variant, Warehouse $warehouse, int $available, int $change): self
    {
        return new self(sprintf(
            'Insufficient stock for variant #%d in warehouse #%d: %d available, change of %d would go negative.',
            $variant->id,
            $warehouse->id,
            $available,
            $change,
        ));
    }
}
