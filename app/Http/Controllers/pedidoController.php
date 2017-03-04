<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\pedido;
use App\Model\servicio;
use Notify;
use Datatables;

class pedidoController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function detalle (Request $Request) {
    return view('pedido/detalle');
  }
  public function getData (Request $Request)
  {
    $pedido = pedido::all();
    return Datatables::of($pedido)
    ->addColumn('action', function ($pedido) {
      return '<a href="/producto/'.$pedido->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>&nbsp;Insumo</a>
      <a href="/produccion/'.$pedido->id.'/destroy" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i>&nbsp;Eliminar</a>
      <a href="/produccion/'.$pedido->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>&nbsp;Eliminar</a>
      <a href="/produccion/'.$pedido->id.'/detalle" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i>&nbsp;Detalle</a>';
    })
    ->make(true);
  }
  public function index()
  {
    //

  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $pedido = pedido::all();
    return view('pedido.crear', compact('pedido'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    //
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    return view('pedido.listar');
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id){
  $pedido = pedido::find($id);
    return view('pedido.editar',compact('pedido'));

}
  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    //
  }
}
