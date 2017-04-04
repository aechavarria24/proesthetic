<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class servicioTipocontratoPedido extends Model
{
  public $table = "servicio_tipocontrato_pedido";

  protected $fillable = [
    'servicio_tipocontrato_id','pedido_id','observacion'
  ];
public $timestamps = false;
}
