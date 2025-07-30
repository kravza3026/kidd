<?php

use App\Models\Address;
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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            // Location name
            $table->json('name');
            // Location type (Store || Warehouse)
            $table->unsignedSmallInteger('type')->default(1); // 1 - Warehouse, 2 - Store..
            // Location Geo Position (lat,lng) coords
            $table->json('geo_position')->nullable();
            // Location Open Hours
            $table->json('open_hours')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
