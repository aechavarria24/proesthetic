<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\cuentaCobro;
use Notify;
use Datatables;


class cuentaCobroController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */

  public function getData (Request $Request)
  {
    $cuentascobro = cuentaCobro::all();
    return Datatables::of($cuentascobro)
    ->addColumn('action', function ($cuentaCobro) {
      return '<a href="/cuentacobro/'.$cuentaCobro->id.'/edit" class=""><i class="glyphicon glyphicon-edit"></i>&nbsp;</a>
      <a href="/cuentacobro/'.$cuentaCobro->id.'/edit" class=""><i class="glyphicon glyphicon-ok" ></i>&nbsp;</a>';
    })
    ->make(true);
  }



  public function index()
  {
    return redirect('cuentacobro/show');
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
    $cuentacobros = cuentaCobro::all();

        return view('cuentacobro.listar');

  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {

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
