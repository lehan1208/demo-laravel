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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('PRO_ID');
            $table->string('Code', 255);
            $table->string('Name', 255);
            $table->smallInteger('Votes');
            $table->double('Price');
            $table->string('Unit', 255);
            $table->string('Materials', 255);
            $table->string('Amount', 255);
            $table->longText('Description', 255)->nullable();
            $table->string('Image', 255)->nullable();

            $table->unsignedInteger('TYPE_ID');
            $table->foreign('TYPE_ID')->references('TYPE_ID')->on('product_types');
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
};
