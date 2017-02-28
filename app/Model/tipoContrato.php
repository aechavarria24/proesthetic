<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tipoContrato extends Model
{
    public $table = "tipo_contrato";

    protected $fillable = ['nombre', 'descripcion'];

}
