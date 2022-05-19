<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->integer('code')->nullable(false);
            $table->string('description');
            $table->enum('type',[10,20,25,50,65,80,90])->nullable(false);
            $table->dateTime('begin')->nullable(false);
            $table->dateTime('end')->nullable(false);
            $table->integer('value')->nullable(false);
            $table->tinyInteger('status');
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
        Schema::dropIfExists('promotions');
    }
}
