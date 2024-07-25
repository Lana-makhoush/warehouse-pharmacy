<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dorders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('first_med')->nullable();
            $table->string('quantity1')->nullable();
            $table->string('price1')->nullable();
            $table->string('second_med')->nullable();
            $table->string('quantity2')->nullable();
            $table->string('price2')->nullable();
            $table->string('third_med')->nullable();
            $table->string('quantity3')->nullable();
            $table->string('price3')->nullable();
            $table->string('fourth_med')->nullable();
            $table->string('quantity4')->nullable();
            $table->string('price4')->nullable();
            $table->string('fifth_med')->nullable();
            $table->string('quantity5')->nullable();
            $table->string('price5')->nullable();
            $table->enum('order_satatus',['in_preparation','has been sent','receives'])->default('in_preparation');
            $table->enum('payment_status',['paid','un_paid'])->default('un_paid');
            $table->string('total_price');
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
        Schema::dropIfExists('dorders');
    }
};
