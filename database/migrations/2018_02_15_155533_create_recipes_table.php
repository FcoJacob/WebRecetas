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
            $table->integer('idReceta')->autoIncrement();            
            $table->string('autor', 120);
            $table->integer('valoracion')->nullable();
            $table->string('breveDescripcion', 140);
            $table->integer('cantidad')->nullable();
            $table->string('ingredientes', 400);            
            $table->string('elaboracion', 2000);
            $table->string('consejo', 500);   
            $table->binary('imagen');                   
            $table->timestamps();                       
        });
    }
    //'imagen' => "data:imagen/jpg;base64,".base64_encode($recipe->imagen),
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
