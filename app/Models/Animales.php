<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animales extends Model
{
    protected $fillable = ['nombre', 'tipo', 'peso', 'enfermedad', 'comentarios'];
}
