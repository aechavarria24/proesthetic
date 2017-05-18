<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class empleado extends Model
{
    //
    public $table = "empleado";

    protected $fillable = ['username', 'rol_id', 'nombre', 'apellido',
    'password','email', 'estado'];
}
