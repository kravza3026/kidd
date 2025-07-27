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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('sort_order')->default(0);

            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('categories')->restrictOnDelete();

            $table->boolean('is_visible')->default(1);

            $table->json('name');
            $table->json('slug');
            $table->json('description')->nullable();
            $table->string('image')->nullable();
            $table->text('icon')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->fullText('name');
            $table->fullText('description');
            // TODO Add full text search with postgres
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
