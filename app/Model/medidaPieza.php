<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class medidapieza extends Model
{
  public $table = "medida_pieza";

  protected $fillable = [
    'dimension','cantidad','unidadMedidad','servicio_tipocontrato_pedido_id'
  ];
public $timestamps = false;
}
