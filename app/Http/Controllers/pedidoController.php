<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\pedido;
use App\Model\servicio;
use App\Model\usuarioClinica;
use App\Model\clinica;
use App\Model\servicioTipoContrato;
use App\Model\medidapieza;
use App\Model\paciente;
use App\Model\servicioTipocontratoPedido;
use Notify;
use Datatables;

class pedidoController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function get_valor($id){
      if ($id==null) {
        $servicio_TipoContrato=0;
        return json_encode($servicio_TipoContrato);
      } else {
        $servicio_TipoContrato = servicioTipoContrato::where("servicio_id",$id)->first();
        // var_dump($servicio_TipoContrato);
        // exit;
        return json_encode($servicio_TipoContrato);
      }

  }


  public function detalle (Request $Request) {
    return view('pedido/detalle');
  }
  public function getData (Request $Request)
  {
    // return "llego al data";
    $pedido = pedido::all();
    return Datatables::of($pedido)
    ->addColumn('action', function ($pedido) {
      return '<a href="/producto/'.$pedido->id.'/edit" ><i class="glyphicon glyphicon-plus" title="Agregar insumo"></i>&nbsp;</a>
      <a href="/produccion/'.$pedido->id.'/destroy" ><i class="glyphicon glyphicon-trash" title="Eliminar"></i>&nbsp;</a>
      <a href="/produccion/'.$pedido->id.'/edit" ><i class="glyphicon glyphicon-edit" title="Editar"></i>&nbsp;</a>
      <a href="/produccion/'.$pedido->id.'/detalle" ><i class="fa fa-eye" title="Detalle"></i>&nbsp;</a>';
    })
    ->make(true);
  }
  public function index()
  {
    return redirect('pedido/show');

  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    //SELECT * FROM usuario_clinica as A inner join clinica as b on b.id=a.clinica_id
    $usuarioClinica=  usuarioClinica::select('usuario_clinica.*')
    ->join('clinica','usuario_clinica.clinica_id','=','clinica.id')
    ->get();
    //
    // SELECT * FROM servicio_tipocontrato as A
    //     INNER join servicio as b on a.servicio_id=b.id
    $servicio = serviciotipoContrato::select('*')
    ->join('servicio','servicio_tipoContrato.servicio_id','=','servicio.id')
    // ->join('servicio','servicio_tipoContrato.tipoContrato_id','=','servicio_tipoContrato.tipoContrato_id')
    ->get();
    // var_dump ($servicio);
    // exit;
    // $servicio_tipoContrato = servicioTipoContrato::all();
    // $pedido = pedido::all();
    // $servicio = servicio::all();
    // $usuario_clinica = usuarioClinica::all();
    return view('pedido.crear', compact('servicio','usuarioClinica','servicio_tipoContrato'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $input = $request->all();
    var_dump($input);
    exit;
    return $input;
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)  {
    $pedido = pedido::all();
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
