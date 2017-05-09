<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class insumo extends Model
{

  public $table = "insumo";

  protected $fillable = ['nombre', 'unidadMedida'];

  public $timestamps = false;
}
