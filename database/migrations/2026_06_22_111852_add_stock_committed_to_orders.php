<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Whether this order's stock has been deducted from inventory. Flips on when the
            // order reaches a fulfilling status and off again if it is cancelled/returned,
            // keeping the deduction idempotent across repeated status changes.
            $table->boolean('stock_committed')->default(false)->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('stock_committed');
        });
    }
};
