<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\cuentaCobro;
use App\Model\paciente;
use App\Model\usuarioClinica;
use App\Model\clinica;
use Notify;
use Datatables;


class cuentaCobroController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */

  public function detalle($id) {
  $cuentaCobro=cuentaCobro::select('cuenta_cobro.id')

  ->get();

      return view('cuentaCobro.detalle',compact('cuentaCobro'));
  }

  public function getData (Request $Request)
  {
    $cuentascobro = cuentaCobro::all();
    return Datatables::of($cuentascobro)
    ->addColumn('action', function ($cuentaCobro) {
      return '<a href="/cuentacobro/'.$cuentaCobro->id.'/edit" class="btn btn-xs "><i class="glyphicon glyphicon-edit"></i>&nbsp;</a>
      <a href="/cuentacobro/'.$cuentaCobro->id.'/detalle" class="btn btn-xs ">&nbsp;Detalle</a>';
    })
    ->addColumn('seletion', "")

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
  public function create(Request $request)
  {
    $input=$request->all();

    $pago=cuentacobro::whereIn('id',$input['s'])->sum('valorTotal');

    $usuarioClinica=  usuarioClinica::select('usuario_clinica.id','usuario_clinica.nombre as NombreDoctor','usuario_clinica.apellido as ApellidoDocto','clinica.nombre as usuarioClinica')
    ->join('clinica','usuario_clinica.clinica_id','=','clinica.id')


    ->get();

   return view('cuentacobro.pago', compact('usuarioClinica','pago'));

  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $input=$request->all();

      foreach ($input['s'] as  $value) {
        $insert_cuenta=pedido::select('pedido.valor','pedido.usurio_id')
        // ->join('tipo_contrato','tipo_contrato.id','=','servicio_tipocontrato.tipoContrato_id')
        // ->join('clinica',)
        // ->join('usuario_clinica',)
        // ->join('cuenta_cobro',)
        ->join('servicio_tipocontrato_pedido','servicio_tipocontrato_pedido.pedido_id','=','pedido.id')
        ->join('servicio_tipocontrato','servicio_tipocontrato.id','=','servicio_tipocontrato_pedido.servicio_tipocontrato_id')
        ->join('venta','venta.pedido_id','=','pedido.id')
        ->where('pedido.id',$value)
        ->get();
        var_dump($insert_cuenta);
        exit;


        $cuenta_cobro=cuentaCobro::create($insert_cuenta);
        dd($cuenta_cobro);
      }



        echo "llego";


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
    $cuentaCobro = cuentaCobro::find($id);
    if ($cuentaCobro == null) {
      Notify::warning('No se encontraron datos','Espera...');
      return redirect('/cuentacobro/show');
    } else {
      return view('cuentaCobro.editar',compact('cuentaCobro'));
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
    $cuentaCobro = cuentaCobro::find($id);
    if ($cuentaCobro == null) {
      Notify::warning('No se encontraron datos','Nota: ');
      return redirect('cuentacobro/show');
    }
    $cuentaCobro->update($input);
    Notify::success("La cuenta de cobro  se modifico con éxito.","Modificacion exitosa");
    return redirect('cuentacobro/show');
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
