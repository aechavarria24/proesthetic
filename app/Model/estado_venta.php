<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class estado_venta extends Model
{
    public $table = "estado_venta";

    protected $fillable = [
      'nombre'
    ];

    public $timestamps = false;
}
