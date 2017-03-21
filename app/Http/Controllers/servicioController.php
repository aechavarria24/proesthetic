<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\servicio;
use Notify;
use Datatables;

class servicioController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function getData (Request $Request)
  {
    $servicios = servicio::all();
    return Datatables::of($servicios)
    ->addColumn('action', function ($servicio) {
      return '<a href="/servicio/'.$servicio->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>&nbsp;Editar</a>';
    })
    ->make(true);
  }
  public function index()
  {
    return view("servicio.index");
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view("servicio.crear");
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    //funcion para guardar en bd
    $input = $request->all();
    servicio::create($input);
    Notify::success("El servicio \"". $input['nombre'] ."\", se registro con éxito.","Registro exitoso");
    return view('servicio.crear');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $servicios = servicio::all();
    return view('servicio.listar');
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $servicios = servicio::find($id);
    if ($servicios==null) {
      Notify::warning('No se encontraron datos','Espera...');
      return redirect('/servicio/show');
    } else {
      return view('servicio.editar',compact('servicios'));
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
    $input = $request->all();
    $servicios = servicio::find($id);
    if ($servicios==null) {
      Notify::warning('No se encontraron datos','Nota: ');
      return redirect('servicio/show');
    }
      $servicios->update($input);
      Notify::success("El servicio \"". $input['nombre'] ."\", se modifico con éxito.","Modificacion exitosa");
      return redirect('servicio/show');

  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {

  }
}
