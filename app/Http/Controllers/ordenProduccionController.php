<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ordenProduccion;
use App\Model\estado_orden_produccion;

use App\Model\insumo;

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
      $estado_orden = estado_orden_produccion::where("id", ">", $ordenProduccion->estado_orden_produccion_id)->get()
      ->toArray();        
      if($ordenProduccion == null){
       return json_encode(["data"=>1]);
     }

        //return json_encode(["data"=>[$estado_orden], "estado"=>$estado->nombre]);

     return ["data"=>$estado_orden, "estado"=>$estado->nombre];


   }

   public function getData(Request $Request)
   {
     $ordenProduccion = ordenProduccion::select("orden_produccion.*", "estado_orden_produccion.nombre as estado")
     ->join("estado_orden_produccion", "orden_produccion.estado_orden_produccion_id", "=", "estado_orden_produccion.id")
     ->get();




     return Datatables::of($ordenProduccion)
     ->addColumn('action', function ($ordenProduccion) {

      $option_estado = "";
      $estados = $this->detalle($ordenProduccion->id);

      foreach ($estados["data"] as $value) {
       $option_estado .= '<li><button class="btn btn-link" onclick = "cambiar_estado('.$ordenProduccion->id.','.$value["id"].')">'.$value["nombre"].'</button></li>';
     }

     $btn_insumo= '<a href="/produccion/asociar/insumo/'.$ordenProduccion->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>&nbsp;Insumo</a>';

     $btn_cambiar_estado = '<div class="btn-group">
     <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Estados <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      '.$option_estado.'
    </ul>
  </div>';

  if ($option_estado === "") {
    return $btn_insumo;
  } else {
    return $btn_insumo . $btn_cambiar_estado;
  }
  return 

  ;
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

public function cambiar_estado(Request $request){

  $input = $request->all();
  $orden_produccion =ordenProduccion::find($input['orden_produccion']);
  if($orden_produccion ==null){
   return json_encode(['respuesta'=>'3']);
 }

 $orden_produccion -> update(["estado_orden_produccion_id"=>$input['estado']]);

 return json_encode(['respuesta'=>'1']);

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
 $insumo= orden_produccion::all();

 $insumo = orden_produccion::find($id);
 if ($clinica==null) {
  Notify::warning('No se encontraron datos','Espera...');
  return redirect('/produccion/show');
} else {
  return view('produccion.editar',compact('produccion','insumo'));
}

}

public function asociar_Insumo($id){

  $insumoProduccion = insumo::all();

  $pedido = ordenProduccion::select('orden_produccion.id as idp','pedido.id as idt')
  ->join('pedido','pedido.id','=','orden_produccion.pedido_id')
  ->where('orden_produccion.id',$id)
  ->get();
  
  // // dd($pedido);
  // // dd($pedido[0]["id"]);

  // exit;

  return view('ordenProduccion.ordenProduccionInsumo',compact('insumoProduccion','pedido'));
}

public function add_Insumo(Request $request){

  $input = $request->all();



  if(session("insumo") != null){

    $insumos = session("insumo");
    array_push($insumos, ["insumo"=>$input["insumo"], "cantidad"=>$input["cantidad"]]);
    session(["insumo"=>$insumos]);

  }else{

    session(["insumo"=>[ "insumo"=>$input["insumo"], "cantidad"=>$input["cantidad"] ]]);

  }

  return json_encode(session("insumo"));


}

public function get_producto(){
  return json_decode(session("insumo"));
}


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

public function eliminar_tabla_asociar(Request $request){
  $request->session("insumo")->flush();
}

}
