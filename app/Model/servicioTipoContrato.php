<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class servicioTipoContrato extends Model
{
    public $table = "servicio_tipocontrato";

    protected $fillable = [
      'servicio_id','tipoContrato_id','valor'
    ];

    public $timestamps = false;
}
