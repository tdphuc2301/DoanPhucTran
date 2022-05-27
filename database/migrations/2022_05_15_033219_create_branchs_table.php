<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branchs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('address')->nullable(false);
            $table->string('long');
            $table->string('lat');
            $table->string('search')->default(null);
            $table->integer('index')->default(1);
            $table->string('description')->default(null);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            //$table->foreign('province_code')->references('province_code')->on('provinces')->onDelete('cascade');
            //$table->foreign('district_code')->references('district_code')->on('provinces')->onDelete('cascade');
            //$table->foreign('ward_code')->references('ward_code')->on('provinces')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branchs');
    }
}
