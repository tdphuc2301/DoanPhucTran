<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAliasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('alias')){
            Schema::create('alias', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->string('alias')->unique();
                $table->integer('model_id');
                $table->string('model_type');

                $table->primary(['model_id','model_type']);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alias');
    }
}
