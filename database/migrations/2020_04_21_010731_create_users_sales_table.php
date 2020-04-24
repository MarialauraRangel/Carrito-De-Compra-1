<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('casher')->unsigned()->nullable()->comment('cajero');
            $table->bigInteger('delivery_man')->unsigned()->nullable()->comment('repartidor');
            $table->timestamps();

             #Relations
            $table->foreign('casher')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('delivery_man')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_sales');
    }
}
