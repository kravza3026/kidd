<?php

use App\Enums\Language;
use App\Models\Company;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Company::class, 'company_id')->constrained()->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone', 16)->unique(); // +37360558844
            $table->string('email')->unique();
            $table->string('cart_session_id')->nullable(); // Cart session ID
            $table->timestamp('phone_verified_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('default_locale', 2)->default('ro'); // Default locale for the user

            $table->boolean('newsletter')->default(1);
            $table->boolean('new_order_to_email')->default(1);
            $table->boolean('new_order_to_sms')->default(1);
            $table->boolean('order_status_email')->default(1);
            $table->boolean('order_status_sms')->default(1);
            $table->boolean('email_marketing')->default(1);
            $table->boolean('sms_marketing')->default(1);

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['phone', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
