<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class proveedor extends Model
{
  public $table = "proveedor";

  protected $fillable = ['nombre', 'telefono'];

  public $timestamps = false;
}
