<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('brand_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('sub_category_id')->nullable();
            $table->double('price');
            $table->double('discount_price')->nullable();
            $table->double('is_sale')->default(0);
            $table->integer('vendor_status')->nullable();
            $table->string('code')->nullable();
            $table->string('unit')->nullable();
            $table->double('weight')->default(0);
            $table->string('type')->nullable();
            $table->integer('qty')->nullable();
            $table->string('image')->nullable();
            $table->text('variations')->nullable();
            $table->text('choice_options')->nullable();
            $table->integer('current_stock')->default(0);
            $table->text('description')->nullable();
            $table->integer('is_active')->default(1);
            $table->integer('slod')->default(0);
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
        Schema::dropIfExists('products');
    }
}
