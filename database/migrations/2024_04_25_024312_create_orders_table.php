<?php

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\ShippingMethod;
use App\Models\Customer;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Customer::class)->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('tracking_id');
            $table->foreignId('payment_id');
            $table->unsignedBigInteger('order_number', true)->unique();
            $table->unsignedInteger('total_amount');
            $table->unsignedTinyInteger('status')->default(OrderStatus::Pending);
            $table->unsignedTinyInteger('shipping_method')->default(ShippingMethod::Regular);
            $table->unsignedTinyInteger('payment_method')->default(PaymentMethod::CashOrCard);
            $table->json('cart_snapshot')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('placed_at')->useCurrent();
            $table->timestamp('processed_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();

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
