<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class insumoOrdenProduccion extends Model
{
  public $table = "insumo_ordenproduccion";

  protected $fillable = ['cantidad', 'insumo_id', 'orden_produccion_id'];

  public $timestamps = false;
}
