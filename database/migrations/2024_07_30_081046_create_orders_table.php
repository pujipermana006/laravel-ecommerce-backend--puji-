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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            //address_id
            $table->foreignId('address_id')->constrained('addresses')->onDelete('cascade');
            //seller_id
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
            //total_price
            $table->decimal('total_price', 15, 2);
            //shipping price
            $table->decimal('shipping_price', 15, 2);
            //grandtotal
            $table->decimal('grand_total', 15, 2);
            //status
            $table->string('status')->default('PENDING');
            //payment va name
            $table->string('payment_va_name')->nullable();
            //payment va number
            $table->string('payment_va_number')->nullable();
            //payment status
            $table->string('payment_service')->nullable();
            //payment type
            $table->string('shipping_number')->nullable();
            //transaction number
            $table->string('transaction_number')->nullable();
            $table->timestamps();
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
