<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\venta;
use App\Model\pedido;
use App\Model\servicioTipoContrato;
use App\Model\servicioTipocontratoPedido;
use Datatables;

class ventaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function detalle(){

        return view('venta.detalleVenta');

     }


     public function getData (Request $Request)
     {
       $venta = venta::all();
       return Datatables::of($venta)
       ->addColumn('action', function ($venta) {
         return '<a href="/venta/'.$venta->id.'/edit" class="btn btn-xs "><i class="glyphicon glyphicon-edit"></i>&nbsp;</a>
         <a href="/venta/'.$venta->id.'/detalle" class="btn btn-xs ">&nbsp;Detalle</a>';
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
      $input=$request->all();
      foreach ($input as  $value) {
        $insert_cuenta=pedido::select('venta.id as id_venta','pedido.id as pedido_id')
        ->join('tipo_contrato','tipo_contrato.id','=','servicio_tipocontrato.tipoContrato_id')
        ->join('servicio_tipocontrato','servicio_tipocontrato.servicio_id','=','servicio_tipocontrato_pedido.servicio_tipocontrato_id')
        ->join('servicio_tipocontrato_pedido','servicio_tipocontrato_pedido.pedido_id','=','pedido.id')
        ->join('venta','venta.pedido_id','=','pedido.id')
        ->where('pedido.id',$value)
        ->get();
      }

      dd($insert_cuenta);
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
