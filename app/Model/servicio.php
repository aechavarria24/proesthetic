<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class servicio extends Model
{
    public $table="servicio";

    protected $fillable = [
      'nombre','descripcion'
    ];
}
