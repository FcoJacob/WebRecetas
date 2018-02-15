<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('autor', 120);
            $table->integer('valoracion')->nullable();
            $table->string('breveDescripcion', 140);
            $table->integer('cantidad')->nullable();
            $table->string('ingredientes', 400);            
            $table->string('elaboracion', 500);
            $table->string('consejo', 500);
            $table->binary('imagen');
            $table->string('tipoImagen', 20);
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
        Schema::dropIfExists('recipes');
    }
}
