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
            $table->string('slug');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();

            $table->string('email');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('street_address');
            $table->string('city');
            $table->string('state');
            $table->string('zip')->nullable();

            $table->decimal('sub_total',10,2);
            $table->decimal('shipping_charge',10,2);
            $table->decimal('coupon_discount',10,2)->default(0);
            $table->decimal('total_charge',10,2);
            $table->enum('payment_status',['paid','not_paid'])->default('not_paid');
            $table->enum('status',['pending','shipped','delivered','cancelled'])->default('pending');
            $table->timestamp('shipped_date')->nullable();
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
