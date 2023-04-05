<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->integer('customer_id')->nullable();
            $table->double('price');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->integer('district_id');
            $table->integer('area_id');
            $table->text('shipping_address')->nullable();
            $table->integer('delivery_boy_id')->nullable();
            $table->double('delivery_charge')->nullable();
            $table->double('vat')->nullable();
            $table->integer('order_status_id')->default(1);
            $table->string('payment_status')->default(0);
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('sender_phone')->nullable();
            $table->string('sender_amount')->nullable();
            $table->string('note')->nullable();
            $table->integer('referral_id')->nullable();
            $table->double('referral_amount')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
