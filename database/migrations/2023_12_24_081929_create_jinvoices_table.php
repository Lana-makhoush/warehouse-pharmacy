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
        Schema::create('jinvoices', function (Blueprint $table) {
            $table->id();
            $table->string('number_of_units');
            $table->date('invoice_date');
            $table->integer('total_price');
            $table->string('payment_status')->default('Unpaid');
            $table->foreignId('cwarehouse')->references('id')->on('cwarehouses');
            $table->foreignId('dorder')->references('id')->on('dorders');
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
        Schema::dropIfExists('jinvoices');
    }
};
