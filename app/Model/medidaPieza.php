<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class medidaPieza extends Model
{
      public $table="medida_pieza";

    protected $fillabe = [
      'dimension','cantidad','unidadMedida','servicio_tipocontrato_pedido_id'
    ];

      public $timestamp = false;
}
