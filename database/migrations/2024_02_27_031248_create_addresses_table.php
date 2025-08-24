<?php

use App\Enums\AddressType;
use App\Models\City;
use App\Models\Country;
use App\Models\Region;
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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();

            $table->morphs('addressable');

            // TODO - use everywhere address types, e.g. private, commercial, shipping, billingб etc.
            $table->unsignedTinyInteger('address_type')->default(AddressType::Shipping);

            $table->boolean('is_default')->default(false);

            $table->string('label', 100);

            $table->foreignIdFor(Country::class)->default(1);
            $table->foreignIdFor(Region::class);
            $table->foreignIdFor(City::class);

            $table->string('contact_first_name')->nullable();
            $table->string('contact_last_name')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();

            $table->string('company_name')->nullable();
            $table->string('company_code')->nullable();
            $table->string('vat_code')->nullable();

            $table->string('street_name');
            $table->string('building');
            $table->string('entrance')->nullable();
            $table->string('floor')->nullable();
            $table->string('apartment')->nullable();
            $table->string('intercom')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
