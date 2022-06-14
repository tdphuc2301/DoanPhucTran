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
            $table->integer('branch_id')->nullable(false);
            $table->integer('rom_id')->nullable(false);
            $table->integer('ram_id')->nullable(false);
            $table->integer('brand_id')->nullable(false);
            $table->string('name')->nullable(false);
            $table->string('code')->nullable();
            $table->string('index')->nullable();
            $table->string('short_description')->nullable();
            $table->string('description')->nullable();
            $table->string('search');
            $table->integer('price');
            $table->integer('sale_off_price');
            $table->integer('rate')->default(1);
            $table->integer('total_rate')->default(1);
            $table->integer('stock_quantity')->nullable(false);
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
