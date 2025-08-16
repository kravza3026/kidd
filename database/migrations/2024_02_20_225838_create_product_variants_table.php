<?php

use App\Models\Color;
use App\Models\Fabric;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Color::class)->constrained()->restrictOnDelete();
            $table->foreignIdFor(Size::class)->constrained()->cascadeOnDelete();
//            $table->foreignId('pattern_id')->constrained()->onDelete('cascade');

            $table->boolean('is_visible')->default(1); // Variant is available

            $table->string('sku', 50)->unique()->nullable(); // Stock Keeping Unit
            $table->unsignedInteger('quantity')->default(0); // Quantity

            $table->unsignedInteger('price_vendor')->default(0); //Buy price
            $table->unsignedInteger('price_wholesale')->default(0); // Wholesale Sales price
            $table->unsignedInteger('price_online')->default(0); // Online Store Sales price
            $table->unsignedInteger('price_store')->default(0); // Physical Store Sales price

            $table->unsignedInteger('price_final')->default(0); // Final cost after discount (online price - discount amount) (old price - price_online, new price - price_final)
            $table->unsignedInteger('discount_amount')->default(0); // Discount amount
            $table->unsignedInteger('discount_display')->default(0); // Discount display

            $table->unsignedInteger('price_shipping')->default(0); // Shipping cost

            $table->json('shipping_sizes')
                ->default(json_encode([
                    'shipping_weight' => 0,
                    'shipping_height' => 0,
                    'shipping_width' => 0,
                    'shipping_length' => 0,
                ]));

            $table->timestamps();

            $table->index('sku');
            $table->index('product_id');
            $table->index('color_id');
            $table->index('size_id');

//            $table->unique(['product_id', 'color_id', 'size_id']); // TODO: Remove comment when ready
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
