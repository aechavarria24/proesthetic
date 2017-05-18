<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class usuarioClinica extends Model
{
    public $table = "usuario_clinica";

    protected $fillable = [
        'rol_id', 'username', 'nombre', 'apellido', 'password', 'email',
        'clinica_id','estado'
    ];
}
