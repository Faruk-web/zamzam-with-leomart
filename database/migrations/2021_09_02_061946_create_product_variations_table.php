<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->unsigned();
            $table->string('variation_image')->nullable();
            $table->string('color_id');
            $table->string('size_id')->nullable();
            $table->string('qty')->nullable();
            $table->string('price')->nullable();
            $table->string('discount_price')->nullable();
            $table->date('offer_start')->nullable();
            $table->date('offer_end')->nullable();
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
        Schema::dropIfExists('product_variations');
    }
}
