<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetaSeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('meta_seos')) {
            Schema::create('meta_seos', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->integer('model_id');
                $table->string('model_type');
                $table->string('title')->nullable();
                $table->string('description')->nullable();
                $table->string('keyword')->nullable();

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
        Schema::dropIfExists('meta_seos');
    }
}
