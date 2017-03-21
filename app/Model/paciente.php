<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class paciente extends Model
{
    public $tabla = "paciente";

    protected $fillable = [
      'cedula','nombre'
    ];

    public $timestamp = false;



}
