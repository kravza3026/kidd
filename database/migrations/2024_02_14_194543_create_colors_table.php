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
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->unsignedSmallInteger('type')->default(1); // 1 = Clothes, 2 = Shoes, 3 = Accessory TODO: Move to enum

            $table->json('name');
            $table->json('slug')->nullable();
            $table->string('hex', 7)->nullable();
            $table->string('icon', 200)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colors');
    }
};
