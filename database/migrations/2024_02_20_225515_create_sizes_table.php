<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->unsignedSmallInteger('type')->default(1); // 1 = Clothes, 2 = Shoes, 3 = Accessory TODO: Move to enum

            $table->json('name');
            $table->json('eu_size')->nullable();
            $table->json('us_size')->nullable();
            $table->unsignedSmallInteger('min_height')->default(0);
            $table->unsignedSmallInteger('max_height')->default(0);
            $table->unsignedSmallInteger('min_weight')->default(0);
            $table->unsignedSmallInteger('max_weight')->default(0);
            $table->unsignedSmallInteger('min_age')->default(0);
            $table->unsignedSmallInteger('max_age')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sizes');
    }
};
