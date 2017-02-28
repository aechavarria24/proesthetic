<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class clinica extends Model
{
    public $table = "clinica";

    protected $fillable = [
      'NIT',  'nombre', 'telefono', 'estado', 'direccion', 'diaCorte', 'mesCorte', 'tipo_contrato_id'
    ];



}
