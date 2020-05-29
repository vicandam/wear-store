<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->string('name');

            $table->integer('quantity')->default(0);


            $table->double('price');
            $table->double('dealer_discount')->default(0.0);
            $table->double('store_profit')->default(0.0);
            $table->double('net_amount')->default(0.0);;
            $table->string('photo', 255);

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
        Schema::dropIfExists('items');
    }
}
