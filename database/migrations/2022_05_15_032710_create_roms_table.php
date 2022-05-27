<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->integer('capacity')->nullable(false);
            $table->integer('index')->nullable()->default(1);
            $table->string('description')->nullable();
            $table->string('search')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('roms');
    }
}
