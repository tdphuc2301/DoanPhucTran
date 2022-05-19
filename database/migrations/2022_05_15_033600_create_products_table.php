<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->nullable(false);
            $table->string('name')->nullable(false);
            $table->string('code');
            $table->string('index');
            $table->string('short_description');
            $table->string('description');
            $table->string('avatar');
            $table->string('search');
            $table->integer('price');
            $table->integer('sale_off_price');
            $table->integer('rate');
            $table->integer('total_rate');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            //$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
}
