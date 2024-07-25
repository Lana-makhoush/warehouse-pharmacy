;<?php

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
        Schema::create('fmedicines', function (Blueprint $table) {
            $table->id();
            $table->string('scientific_name');
            $table->string('commercial_name');
            $table->string('manufacture_company');
            $table->integer('available_quantity');
            $table->date('expiry_date');
            $table->integer('price');
            $table->string('image')->nullable();
            $table->timestamps();
            $table->foreignId('category')->references('id')->on('acategories');
            $table->foreignId('warehouse')->references('id')->on('cwarehouses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fmedicines');
    }
};
