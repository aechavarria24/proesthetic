<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class preguntaCliente extends Model
{
  public $table = "pregunta_cliente";

  protected $fillable = ['pregunta'];

  public $timestamps =  false;
}
