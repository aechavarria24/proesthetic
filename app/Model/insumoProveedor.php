<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class insumProveedor extends Model
{
    public $table = "insumo_proveedor";

  protected $fillable = ['insumo_id', 'proveedor_id'];

  public $timestamp = false;
}