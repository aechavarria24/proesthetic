<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class servicioTipocontratoPedido extends Model
{
  public $table="servicio_tipocontrato_pedido";

protected $fillabe = [
  'servicio_tipocontrato_id','pedido_id','observacion'
];

  public $timestamp = false;
}
