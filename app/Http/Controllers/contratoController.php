<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\contrato;
use Notify;
use Datatables;

class contratoController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */

  public function getData (Request $Request)
  {
    $contrato = contrato::all();
    return Datatables::of($contrato)
    ->addColumn('action', function ($contrato) {
      return '<a href="/contrato/'.$contrato->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>&nbsp;Editar</a>
      <a href="/contrato/'.$contrato->id.'/edit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>&nbsp;Inabilitar</a>';
    })
    ->make(true);
  }




  public function index()
  {
    return view('contrato.index');
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    //
    return view('contrato.crear');
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
    contrato::create($input);
    Notify::success("El contrato \"". $input['nombre'] ."\", se registro con éxito.","Registro exitoso");
    return view('tipoContrato.crear');

  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $contrato = contrato::all();
    return view('contrato.listar');
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $contrato = contrato::find($id);
    if (false/**$contrato==null*/) {
      Notify::warning('No se encontraron datos','Espera...');
      return redirect('/edit/show');
    } else {
      return view('contrato.editar',compact('contrato'));
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
    $contrato = contrato::find($id);
    if ($contrato==null) {
      Notify::warning('No se encontraron datos','Nota: ');
      return redirect('contrato/show');
    }
    $contrato->update($input);
    Notify::success("El Contrato \"". $input['nombre'] ."\", se modifico con éxito.","Modificacion exitosa");
    return redirect('contrato/show');
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
