<?php

use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(ProductVariant::class)->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->json('variant_snapshot');

            $table->unsignedInteger('quantity')->default(1); // Quantity of the product variant in the order
            $table->unsignedInteger('unit_price')->default(0); // Product price in cents on the order/invoice
            $table->unsignedInteger('total_price')->default(0); // Final price (qty*price) in cents on the order/invoice

            $table->index([
                'order_id',
                'product_variant_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
