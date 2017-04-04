<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class paciente extends Model
{
  public $table = "paciente";

  protected $fillable = [
    'cedula','nombre'
  ];
public $timestamps = false; 
}
