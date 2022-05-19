<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductBranchsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_branchs', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable(false);
            $table->integer('branch_id')->nullable(false);
            $table->integer('stock_quantity');
            $table->timestamps();

            //$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            //$table->foreign('branch_id')->references('id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_branchs');
    }
}
