<?php

namespace RecipesOfKitchen;

use Illuminate\Database\Eloquent\Model;

class Recipes extends Model
{
    protected $fillable = ['idReceta', 'autor', 'valoracion', 'breveDescripcion', 'cantidad', 'ingredientes', 'elaboracion', 'consejo', 'imagen', 'tipoimagen'];
    protected $primaryKey = 'idReceta';
}
