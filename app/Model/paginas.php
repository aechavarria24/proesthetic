<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class paginas extends Model
{
    //

    public $table = "pagina";

    protected $fillable = ["nombre", "url", "padre", "orden", "icono"];

    public $timestamp = false;
}
