<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class pagina_rol extends Model
{
    //
    public $table = "pagina_rol";

    protected $fillable = ["pagina_id", "rol_id"];

    public $timestamp = false;
}
