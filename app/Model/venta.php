<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class venta extends Model
{
  //

  public $table = "venta";

  protected $fillable = ['pedido_id', 'empleado_id', 'estado_venta_id'];
}
