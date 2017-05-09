<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class clinica extends Model
{
    public $table = "clinica";

    protected $fillable = [
      'NIT',  'nombre', 'telefono', 'estadoClinica', 'direccion', 'diaCorte', 'tipo_contrato_id'
    ];



}
