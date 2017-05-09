<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class cuentaCobro extends Model
{
  public $table = "cuenta_cobro";

  protected $fillable = [
    'id','valorTotal','created_at','estado'
  ];
}
