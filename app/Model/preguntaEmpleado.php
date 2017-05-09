<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class preguntaEmpleado extends Model
{
  //
  public $table = "pregunta_empleado";

  protected $fillable = ['pregunta'];
}
