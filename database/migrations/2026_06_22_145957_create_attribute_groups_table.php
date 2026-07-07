<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Taxonomy resources (brand/color/size/…) keyed by the resource key the admin uses.
     */
    private array $tables = [
        'brands', 'colors', 'sizes', 'genders', 'seasons', 'fabrics', 'care_instructions',
    ];

    public function up(): void
    {
        Schema::create('attribute_groups', function (Blueprint $table) {
            $table->id();
            // Which taxonomy this group belongs to — matches the admin resource key
            // (brand, color, size, gender, season, fabric, careInstruction).
            $table->string('attribute', 40)->index();
            $table->json('name'); // translatable
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        foreach ($this->tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->foreignId('attribute_group_id')->nullable()->after('id')
                    ->constrained('attribute_groups')->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropConstrainedForeignId('attribute_group_id');
            });
        }

        Schema::dropIfExists('attribute_groups');
    }
};
