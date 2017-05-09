<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class contrato extends Model
{
    public $table = "tipo_contrato";

    protected $fillable = ['nombre', 'descripcion', 'servicio_id','valor'];

}
