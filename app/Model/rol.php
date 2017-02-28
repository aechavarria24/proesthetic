<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class rol extends Model
{
    public $table = 'rol';
    
    protected $fillable = ['nombre'];
    
    public $timestamp = false;
    
    
}
