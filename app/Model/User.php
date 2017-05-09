<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    function __construct(){
      $this->table=session('tabla_usuario');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     public $table ;

    protected $fillable = [
        'username', 'password', 'rol_id', 'pregunta_id', 'respuesta', 'estado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
