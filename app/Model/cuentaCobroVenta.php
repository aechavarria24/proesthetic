<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class cuentaCobroVenta extends Model
{
    public $table = "cuentacobro_venta";

    protected $fillable = [
        'id','cuentaCobro_id','venta_id'];

        public $timestamps = false;
    }
