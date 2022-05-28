<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('phone')->nullable(false);
            $table->string('email');
            $table->string('address');
            $table->string('lat');
            $table->string('long');
            $table->integer('point');
            $table->integer('index')->nullable()->default(1);
            $table->string('description')->nullable();
            $table->string('search')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('user_id');
            $table->integer('type_id');
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
        Schema::dropIfExists('customers');
    }
}
