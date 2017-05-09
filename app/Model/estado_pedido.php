<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class estado_pedido extends Model
{
    public $table = "estado_pedido";

    protected $fillable = [
      'nombre'
    ];

    public $timestamps = false;
}
