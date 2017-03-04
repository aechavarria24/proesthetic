<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ordenProduccion extends Model
{
  public $table = "orden_produccion";

  protected $fillable = [
    'usuario_id','fechaFin','observacion','pedidoid','estado_orden_produccion'
  ];
}
