<?php

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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->string('iso_alpha2', 2);
            $table->string('iso_alpha3', 3)->nullable();
            $table->string('phone_code', 5)->nullable();
            $table->string('currency_code', 3)->nullable();
            $table->string('flag')->nullable();
            $table->string('language')->nullable();
            $table->string('language_code', 2)->nullable();
            $table->string('timezone')->default('Europe/Chisinau');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique('iso_alpha2');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //        Schema::dropIfExists('countries');
    }
};
