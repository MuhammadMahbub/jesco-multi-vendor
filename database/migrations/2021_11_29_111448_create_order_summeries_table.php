<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderSummeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_summeries', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('cart_total');
            $table->integer('discount_total')->default('0');
            $table->integer('sub_total');
            $table->integer('shipping_total');
            $table->integer('grand_total');
            $table->integer('payment_option');
            $table->integer('payment_status')->default('0');
            $table->string('coupon_name')->nullable();
            $table->integer('delivered_status')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_summeries');
    }
}
