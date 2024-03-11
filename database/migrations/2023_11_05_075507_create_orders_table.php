<?php

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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('status')->default(0);
            $table->string('email');
            $table->string('order_code');
            $table->string('phone');
            $table->string('payment_account_name');
            $table->string('payment_process_number');
            $table->string('address');
            $table->string('location_link');
            $table->integer('delivery_price');
            $table->bigInteger('total_with_delivery_price');
            $table->bigInteger('total');
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
