<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable(false);
            $table->integer('promotion_id')->nullable(false);
            $table->string('code');
            $table->string('note')->nullable();
            $table->integer('total_price');
            $table->integer('price_promotion')->nullable();
            $table->string('search')->nullable();
            $table->integer('branch_id')->nullable(false);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            //$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            //$table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
