<?php

use App\Models\Product;
use App\Models\Warehouse;
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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class)->constrained()->restrictOnDelete();
            $table->foreignIdFor(Warehouse::class)->constrained()->restrictOnDelete();

            $table->unsignedSmallInteger('rack_number')->nullable();
            $table->string('rack_code', 30)->nullable();
            $table->unsignedSmallInteger('row_number')->nullable();
            $table->string('row_code', 30)->nullable();
            $table->unsignedSmallInteger('column_number')->nullable();
            $table->string('column_code', 30)->nullable();

            $table->unsignedInteger('quantity')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
