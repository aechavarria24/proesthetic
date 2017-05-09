<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ordenProduccion extends Model
{
  public $table = "orden_produccion";

  protected $fillable = [
    'usuario_id','fechaFin','observacion','pedido_id','estado_orden_produccion_id'
  ];
}
