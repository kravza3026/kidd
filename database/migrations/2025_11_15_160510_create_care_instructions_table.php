<?php

use App\Models\CareInstruction;
use App\Models\Product;
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
        Schema::create('care_instructions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->smallInteger('sort_order')->default(0);
            $table->tinyText('icon')->nullable();
            $table->json('title');
            $table->json('description');
            $table->timestamps();
        });

        Schema::create('care_instruction_product', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CareInstruction::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignIdFor(Product::class)->constrained()->onUpdate('cascade')->onDelete('cascade');

            //            $table->index(['care_instruction_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('care_instructions');
    }
};
