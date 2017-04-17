<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\venta;
use App\Model\pedido;
use App\Model\servicioTipoContrato;
use App\Model\servicioTipocontratoPedido;
use App\Model\cuentaCobro;
use App\Model\cuentaCobroVenta;
use Notify;
use Datatables;

class ventaController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function detalle($id){
        $venta=venta::select('pedido.id as pedido','clinica.nombre as nombreClinica','pedido.fechaEntrega','pedido.created_at as fechaSolicitud','venta.id as venta','usuario_clinica.nombre as nombreDoctor','usuario_clinica.apellido as apellidoDoctor')
        ->join('pedido','pedido.id','=','venta.pedido_id')
        ->join('usuario_clinica','usuario_clinica.id','=','pedido.usuario_id')
        ->join('clinica','clinica.id','=','usuario_clinica.clinica_id')
        ->where('venta.id',$id)
        ->get();



        return view('venta.detalleVenta',compact('venta'));

    }


    public function getData (Request $Request)
    {
        $venta = venta::all();
        return Datatables::of($venta)
        ->addColumn('action', function ($venta) {
            return '<a href="/venta/'.$venta->id.'/edit" class="btn btn-xs "><i title="Editar" class="glyphicon glyphicon-edit"></i>&nbsp;</a>
            <a href="/venta/'.$venta->id.'/detalle"> <i class="fa fa-eye" title="Detalle"></i>&nbsp;</a>';
        })
        ->addColumn('seletion', "")
        ->make(true);
    }



    public function index()
    {
        return redirect('venta/show');
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
        return view('venta.detalleVenta');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {

        //generar cuanta de cobro
        $input=$request->all();

        if (isset($input['s'])) {

            $suma=0;
            foreach ($input['s'] as  $value) {

                $consulta_Venta=venta::select('venta.id as venta','servicio_tipoContrato.valor')
                ->join( 'pedido','pedido.id','=','venta.pedido_id')
                ->join( 'servicio_tipocontrato_pedido','servicio_tipocontrato_pedido.pedido_id','=','pedido.id')
                ->join( 'servicio_tipocontrato','servicio_tipocontrato.id','=','servicio_tipocontrato_pedido.servicio_tipocontrato_id')

                ->where( 'venta.id','=',$value)
                ->first();

                $suma=$consulta_Venta['valor']+$suma;

            }

            $insert_cuentaCobro=cuentaCobro::create(['valorTotal'=>$suma]);

            foreach ($input['s'] as  $value) {

                $consulta_Venta=venta::select('venta.id as venta','servicio_tipoContrato.valor')
                ->join( 'pedido','pedido.id','=','venta.pedido_id')
                ->join( 'servicio_tipocontrato_pedido','servicio_tipocontrato_pedido.pedido_id','=','pedido.id')
                ->join( 'servicio_tipocontrato','servicio_tipocontrato.id','=','servicio_tipocontrato_pedido.servicio_tipocontrato_id')

                ->where( 'venta.id','=',$value)
                ->first();

                $insert_cuentaCobro_venta=cuentaCobroVenta::create(['cuentaCobro_id'=>$insert_cuentaCobro['id'],'venta_id'=>$consulta_Venta['venta']]);
            }
            Notify::success('Cuenta de cobro'.' '.$insert_cuentaCobro['id'].' '.'creada con exito','Noticia');

            return redirect('venta/show');
        }
        Notify::Error('Por favor seleccione una venta','Error');
        return redirect('venta/show');

    }



    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $venta = venta::all();
        return view('venta.listar');
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
