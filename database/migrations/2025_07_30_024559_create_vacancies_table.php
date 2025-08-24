<?php

use App\Models\Company;
use App\Models\Location;
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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();

            // [Rel] Company
            $table->foreignIdFor(Company::class)->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');

            // [Rel] Vacancy Location (HQ if Remote) default is Headquarter
            $table->foreignIdFor(Location::class)->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');

            // Job Title
            $table->json('title');
            // Job Slug
            $table->json('slug');
            // Job Remote?
            $table->boolean('remote')->default(false);
            // Job Summary
            $table->json('summary')->nullable();
            // Job Responsibilities
            $table->json('responsibilities')->nullable();
            // Job Requirements
            $table->json('requirements')->nullable();
            // Job description footer
            $table->json('extra')->nullable();
            // Job notes.
            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
