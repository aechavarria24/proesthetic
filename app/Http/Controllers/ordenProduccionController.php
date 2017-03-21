<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ordenProduccion;
use App\Model\estado_orden_produccion;
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

        $ordenProduccion = ordenProduccion::find($id);
        $estado = estado_orden_produccion::find($ordenProduccion->estado_orden_produccion_id);
        $estado_orden = estado_orden_produccion::where("id", ">", $ordenProduccion->estado_orden_produccion_id)->get();
        if($ordenProduccion == null){
             return json_encode(["data"=>1]);
        }

        //return json_encode(["data"=>[$estado_orden], "estado"=>$estado->nombre]);
        return ["data"=>$estado_orden, "estado"=>$estado->nombre];

       $ordenProduccion = ordenProduccion::all();
      //  $ordenProduccion=  ordenProduccion::select('orden_Produccion.*')
      //  ->join('empleado','empleado.id','=','orden_Produccion.usuario_id')
      //  ->get();
      //  var_dump($ordenProduccion);
      //  exit;

     return view('ordenProduccion.detalle',compact('ordenProduccion'  ));


     }

     public function getData(Request $Request)
     {
       $ordenProduccion = ordenProduccion::select("orden_produccion.*", "estado_orden_produccion.nombre as estado")
       ->join("estado_orden_produccion", "orden_produccion.estado_orden_produccion_id", "=", "estado_orden_produccion.id")
       ->get();

        $option_estado = "<option>Nada</option>";
       $estados = $this->detalle($ordenProduccion[0]["id"]);
       
       foreach ($estados["data"] as $value) {
           $option_estado .= '<option value = "'.$value["id"].'">'.$value["nombre"].'</option>';
       }

       return Datatables::of($ordenProduccion)
       ->addColumn('action', function ($ordenProduccion) use ($option_estado) {

         return '<a href="/produccion/'.$ordenProduccion->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>&nbsp;Insumo</a>

            <a href="#"  class="btn btn-xs btn-info"><i class="fa fa-eye" ></i>&nbsp;</a> <select hidden="" class="form-control" ="'.$option_estado.'" id="ddlEstados">
         
        </select>';
       })

        ->addColumn('estado_orden_produccion', function ($ordenProduccion){
            return $ordenProduccion ->estado;

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
