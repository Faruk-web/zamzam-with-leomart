<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('name');
            $table->string('customer_type')->nullable();
            $table->string('admin_type')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->unique()->nullable();
            $table->integer('type')->default(2);
            $table->string('city')->nullable();
            $table->string('image')->nullable();
            $table->string('nid')->nullable();
            $table->text('address')->nullable();
            $table->integer('is_wholeseller')->default(0);
            $table->integer('is_active')->default(1);
            $table->integer('referral_id')->nullable();
            $table->integer('affiliate_applied')->default(0);
            $table->integer('is_affiliate')->default(0);
            $table->integer('affiliate_rejection')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
