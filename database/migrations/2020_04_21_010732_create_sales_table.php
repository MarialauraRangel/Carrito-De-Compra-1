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
            $table->string('phone');
            $table->mediumText('address');
            $table->float('subtotal', 10, 2)->default(0.00);
            $table->float('delivery', 10, 2)->default(0.00);
            $table->float('total', 10, 2)->default(0.00);
            $table->string('time_start')->nullable();
            $table->string('time_finish')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('store_id')->unsigned()->nullable();
            $table->bigInteger('distance_id')->unsigned()->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->enum('state', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13])->default(1);
            $table->timestamps();

            #Relations
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
