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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('sort_order')->default(0);

            $table->json('name');
            $table->json('slug');
            $table->json('body');
            $table->json('page_meta')->nullable();
            $table->timestamps();

            $table->fullText('slug');
            $table->fullText('body');
            $table->fullText('page_meta');
            // TODO Add full text search with postgres
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
