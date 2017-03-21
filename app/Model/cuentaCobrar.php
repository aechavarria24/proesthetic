<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class cuentaCobrar extends Model
{
  public $table = "cuenta_cobro";

  protected $fillable = [
    'valor_total'

  ];
}
