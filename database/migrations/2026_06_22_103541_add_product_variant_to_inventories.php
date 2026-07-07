<?php

use App\Models\ProductVariant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inventories', function (Blueprint $table) {
            // Stock is tracked per variant per warehouse. Nullable so legacy product-level
            // rows (none exist yet) wouldn't break, but new rows always set it.
            $table->foreignIdFor(ProductVariant::class)->nullable()->after('warehouse_id')->constrained()->cascadeOnDelete();

            // One stock row per variant per warehouse.
            $table->unique(['product_variant_id', 'warehouse_id']);
        });
    }

    public function down(): void
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropUnique(['product_variant_id', 'warehouse_id']);
            $table->dropConstrainedForeignIdFor(ProductVariant::class);
        });
    }
};
