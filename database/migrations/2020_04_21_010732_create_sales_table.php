<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->unique();
            $table->bigInteger('order_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable()->comment('cliente');
            $table->bigInteger('user_sale_id')->unsigned()->nullable()->comment('Repartidor y cajero');
            $table->bigInteger('province_id')->unsigned()->nullable()->comment('Estado');
            $table->bigInteger('distance_id')->unsigned()->nullable();
            $table->bigInteger('store_id')->unsigned()->nullable();
            $table->enum('state', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13])->default(1);
            $table->integer('time');
            $table->mediumText('address');
            $table->timestamps();

            #Relations
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_sale_id')->references('id')->on('users_sales')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('distance_id')->references('id')->on('distances')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
