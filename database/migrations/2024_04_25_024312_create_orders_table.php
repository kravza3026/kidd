<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Customer;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Customer::class)->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('tracking_id');
            $table->foreignId('payment_id');
            $table->unsignedBigInteger('order_number')->unique();
            $table->unsignedInteger('total_amount');
            $table->string('status')->default('pending');
            $table->json('shipping_address');
            $table->json('billing_address')->nullable();
            $table->json('cart_snapshot')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('placed_at')->useCurrent();
            $table->timestamp('processed_at')->nullable()->default(null);
            $table->timestamp('delivered_at')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->index([
                    'customer_id',
                    'tracking_id',
                    'payment_id',
                    'order_number',
                    'status',
                ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
