<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class insumoproveedor extends Model
{
  public $table = "insumo_proveedor";

  protected $fillable = ['insumo_id', 'proveedor_id'];

  public $timestamps = false;
}
