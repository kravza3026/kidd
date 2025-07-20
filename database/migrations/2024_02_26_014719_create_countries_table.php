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
            $table->string('iso2_code', 2);
            $table->string('iso3_code', 3);
            $table->string('phone_code', 6);
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->index(['iso2_code', 'iso3_code']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
