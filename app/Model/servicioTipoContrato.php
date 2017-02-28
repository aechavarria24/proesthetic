<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class servicioTipoContrato extends Model
{
    public  $table = "servicio_TipoContrato";

    protected $fillable = [
      'servicio_id','tipocontrato_id','valor'
    ];
}
