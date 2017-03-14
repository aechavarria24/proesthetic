<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ordenProduccion;
use App\Model\empleado;
use Notify;
use Datatables;

class ordenProduccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function detalle($id){
       $ordenProduccion = ordenProduccion::all();
      //  $ordenProduccion=  ordenProduccion::select('orden_Produccion.*')
      //  ->join('empleado','empleado.id','=','orden_Produccion.usuario_id')
      //  ->get();
      //  var_dump($ordenProduccion);
      //  exit;

     return view('ordenProduccion.detalle',compact('ordenProduccion'  ));

     }

     public function getData (Request $Request)
     {
       $ordenProduccion = ordenProduccion::all();
       return Datatables::of($ordenProduccion)
       ->addColumn('action', function ($ordenProduccion) {
         return '<a href="/produccion/'.$ordenProduccion->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>&nbsp;Insumo</a>
         <a href="/produccion/'.$ordenProduccion->id.'/detalle" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i>&nbsp;Detalle</a>';
       })
       ->make(true);
     }
    public function index()
    {
      return redirect('produccion/show');


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return redirect('produccion/show');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect('produccion/show');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $ordenProduccion = ordenProduccion::all();

      return view('ordenProduccion.listar');
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
