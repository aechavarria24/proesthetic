<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class usuarioClinica extends Model
{
    public $table = "usuario_clinica";

    protected $fillable = [
        'rol_id', 'username', 'nombre', 'apellido', 'password', 'pregunta_id', 'respuesta',
        'clinica_id','estado'
    ];
}
