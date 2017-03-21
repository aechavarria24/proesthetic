<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
  public $table = "empleado";

  protected $fillable = [
    'rol_id','username','nombre','apellido','password','preguntaEmpleado_is',
    'respuesta','estado'
  ];
}
