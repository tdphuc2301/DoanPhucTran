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
            $table->string('province_code');
            $table->string('district_code');
            $table->string('ward_code');
            $table->string('long');
            $table->string('lat');
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
