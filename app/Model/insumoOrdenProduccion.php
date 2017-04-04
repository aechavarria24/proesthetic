<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class insumoOrdenProduccion extends Model
{
  public $table = "insumo_ordenproduccion";

  protected $fillable = ['cantidad'];

  public $timestamps = false;
}
