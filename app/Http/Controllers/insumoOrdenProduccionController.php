<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\insumoOrdenProduccion;

class insumoOrdenProduccionController extends Controller
{

  public function index()
  {
      return view('insumoOrdenProduccion.index');
  }

  public function create()
  {

    return view ('insumoOrdenProduccion.crear');
  }

}
