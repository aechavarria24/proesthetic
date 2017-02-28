<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\proveedor;
use Notify;
use Datatables;

class proveedorController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */

  public function getData (Request $Request)
  {
    $proveedores = proveedor::all();
    return Datatables::of($proveedores)
    ->addColumn('action', function ($proveedor) {
      return '<a href="/proveedor/'.$proveedor->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>&nbsp;Editar</a>
      <a href="/proveedor/'.$proveedor->id.'/edit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>&nbsp;Inabilitar</a>';
    })
    ->make(true);
  }



  public function index()
  {
    return view('proveedor.index');
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    //
    return view('proveedor.crear');
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
    $input = $request->all();
    proveedor::create($input);
    Notify::success("El proveedor \"". $input['nombre'] ."\", se registro con éxito.","Registro exitoso");
    return view('proveedor.crear');

  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //
    $proveedores = proveedor::all();
    return view('proveedor.listar');
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //
    $proveedor = proveedor::find($id);
    if ($proveedor == null) {
      Notify::warning('No se encontraron datos','Espera...');
      return redirect('/proveedor/show');
    } else {
      return view('proveedor.editar',compact('proveedor'));
    }
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
    $input = $request->all();
    $proveedor = proveedor::find($id);
    if ($proveedor == null) {
      Notify::warning('No se encontraron datos','Nota: ');
      return redirect('proveedor/show');
    }
    $proveedor->update($input);
    Notify::success("El proveedor \"". $input['nombre'] ."\", se modifico con éxito.","Modificacion exitosa");
    return redirect('proveedor/show');
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
