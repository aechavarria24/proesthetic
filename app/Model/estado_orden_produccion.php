<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class estado_orden_produccion extends Model
{
    public $table = "estado_orden_produccion";

    protected $fillable = [
      'nombre'
    ];
    public $timestamps = false;

}
