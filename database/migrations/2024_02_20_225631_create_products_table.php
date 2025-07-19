<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\Fabric;
use App\Models\Gender;
use App\Models\Season;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->constrained()->restrictOnDelete(); // Product Category
            $table->foreignIdFor(Brand::class)->nullable()->constrained()->nullOnDelete(); // Product Brand
            $table->foreignIdFor(Gender::class)->constrained()->restrictOnDelete()->cascadeOnUpdate(); // Product Gender
            $table->foreignIdFor(Season::class)->nullable()->constrained()->nullOnDelete(); // Product Season
            $table->foreignIdFor(Fabric::class)->constrained()->restrictOnDelete(); // Product Fabric

            $table->json('name');
            $table->json('slug');
            $table->json('description')->nullable();

            $table->string('main_image')->nullable();

            $table->integer('rating')->default(0);
            $table->integer('review_count')->default(0);

            $table->boolean('is_visible')->default(1); // Product is visible in the store
            $table->boolean('is_new')->default(1); // Product is new
            $table->boolean('has_discount')->default(0); // Product has discount
            $table->boolean('is_featured')->default(0); // Product is featured
            $table->boolean('is_bestseller')->default(0); // Product is bestseller

            $table->string('barcode')->nullable(); // Product Barcode

            $table->timestamps();
            $table->softDeletes();

//            $table->fullText('name');
//            $table->fullText('slug');
//            $table->fullText('description');
            // TODO Add full text search with postgres
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
