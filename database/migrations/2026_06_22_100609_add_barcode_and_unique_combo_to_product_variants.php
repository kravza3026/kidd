<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_variants', function (Blueprint $table) {
            // 1D barcode (EAN-13) — auto-generated, editable, unique. Nullable so legacy rows
            // and not-yet-labelled variants are allowed (Postgres permits multiple NULLs).
            $table->string('barcode', 64)->nullable()->unique()->after('sku');

            // A product never has two variants of the same colour + size. This was deferred in
            // the original migration (TODO) until the variant matrix made it enforceable.
            $table->unique(['product_id', 'color_id', 'size_id']);
        });
    }

    public function down(): void
    {
        Schema::table('product_variants', function (Blueprint $table) {
            $table->dropUnique(['product_id', 'color_id', 'size_id']);
            $table->dropUnique('product_variants_barcode_unique');
            $table->dropColumn('barcode');
        });
    }
};
