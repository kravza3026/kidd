<?php

use App\Models\ProductVariant;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ProductVariant::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Warehouse::class)->constrained()->restrictOnDelete();

            $table->string('type', 20);             // App\Enums\StockMovementType
            $table->integer('quantity');            // signed: +received / −sold
            $table->nullableMorphs('reference');    // e.g. an Order that caused the movement
            $table->string('note')->nullable();
            $table->foreignIdFor(User::class)->nullable()->constrained()->nullOnDelete();

            $table->timestamps();

            $table->index(['product_variant_id', 'warehouse_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
