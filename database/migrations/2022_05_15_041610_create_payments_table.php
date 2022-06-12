<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_code')->nullable(false)->nullable(false);
            $table->string('order_id')->nullable(false)->nullable(false);
            $table->integer('paid');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            //$table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            //$table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
