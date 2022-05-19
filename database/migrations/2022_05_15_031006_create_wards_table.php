<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wards', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('search');
            $table->string('district_code');
            $table->string('ward_code');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            //$table->foreign('district_code')->references('district_code')->on('districts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wards');
    }
}
