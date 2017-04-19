<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ordenProduccion;
use App\Model\estado_orden_produccion;
use App\Model\pedido;
use App\Model\estado_pedido;
use App\Model\medidapieza;
use App\Model\servicio;
use App\Model\servicioTipoContrato;
use App\Model\servicioTipocontratoPedido;
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

            $estado_id = ordenProduccion::select("*")
            ->where("estado_orden_produccion_id", "=",
            estado_orden_produccion::select("*")->where("nombre", "=", "Venta Generada")->first()["id"])
            ->where("pedido_id", "=", $ordenProduccion["pedido_id"])->get();

            if (count($estado_id) == 0) {

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
            } else {
                return "";
            }


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
        $respuesta = 0;
        $estados = estado_orden_produccion::all();

        $input = $request->all();
        $orden_produccion =ordenProduccion::find($input['orden_produccion']);
        if($orden_produccion ==null){
            $respuesta = '3';
        }else {
            if ($input['estado'] == estado_orden_produccion::select("*")->where("nombre", "=", "Enviado")->first()["id"]) {
                \DB::beginTransaction();
                try {
                    $pedido = pedido::select("*")->where("id", "=",
                    $orden_produccion["pedido_id"])->first();
                    $pedido->update(["estado_pedido_id"=>estado_pedido::select("id")
                    ->where("nombre", "=", "Enviado")->first()["id"]]);
                    $orden_produccion -> update(["estado_orden_produccion_id"
                    =>$input['estado']]);
                    \DB::commit();
                    $respuesta = '1';
                } catch (\Exception $e) {
                    \DB::rollBack();
                    $respuesta = '3';
                }
            }else if ($input['estado'] == estado_orden_produccion::select("*")->where("nombre", "=", "Procesando")->first()["id"]) {
                \DB::beginTransaction();
                try {
                    $pedido = pedido::select("*")->where("id", "=",
                    $orden_produccion["pedido_id"])->first();
                    $pedido->update(["estado_pedido_id"=>estado_pedido::select("id")
                    ->where("nombre", "=", "Procesando")->first()["id"]]);
                    $orden_produccion -> update(["estado_orden_produccion_id"
                    =>$input['estado']]);
                    \DB::commit();
                    $respuesta = '1';
                } catch (\Exception $e) {
                    \DB::rollBack();
                    $respuesta = '3';
                }
            } // Fin if estado 135
        } //Fin else $orden_produccion


        return json_encode(['respuesta'=>$respuesta]);

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

            session(["insumo"=>[[ "insumo"=>$input["insumo"], "cantidad"=>$input["cantidad"] ]]]);

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

    public function retornar($id){
        /*
        SELECT pa.cedula, pa.nombre paciente, pe.id, uc.nombre doctor, uc.apellido apelldio_doctor
        FROM paciente pa INNER JOIN pedido pe ON pa.id = pe.paciente_id
        INNER JOIN usuario_clinica uc ON pe.usuario_id = uc.id AND pe.id = 4;*/
        $pedido = pedido::select("paciente.cedula","paciente.nombre as paciente",
        "pedido.id as nro_pedido","usuario_clinica.nombre as doctor",
        "usuario_clinica.apellido as apellido_doctor")
        ->where('pedido.id', '=', $id)
        ->where("estado_pedido_id", "=", estado_pedido::select("id")
        ->where("nombre", "=", "Enviado")->first()["id"]
        )
        ->join("paciente", "paciente.id", "=", "paciente_id")
        ->join("usuario_clinica", "usuario_clinica.id", "=", "usuario_id")
        ->first();

        if ($pedido != null) {
            /*
            SELECT mp.*, se.nombre  FROM medida_pieza mp
            INNER JOIN servicio_tipocontrato_pedido stp ON  stp.id = mp.servicio_tipocontrato_pedido_id
            INNER JOIN servicio_tipocontrato st ON st.id = stp.servicio_tipocontrato_id
            INNER JOIN servicio se ON se.id =  st.servicio_id
            AND stp.pedido_id = 6;
            */
            $medidas_pieza = medidapieza::select("medida_pieza.*", "servicio.nombre as servicio")
            ->join("servicio_tipocontrato_pedido", "servicio_tipocontrato_pedido.id", "=", "medida_pieza.servicio_tipocontrato_pedido_id")
            ->join("servicio_tipocontrato", "servicio_tipocontrato.id", "=", "servicio_tipocontrato_pedido.servicio_tipocontrato_id")
            ->join("servicio", "servicio.id", "=", "servicio_tipocontrato.servicio_id")
            ->where("servicio_tipocontrato_pedido.pedido_id", "=", $pedido["nro_pedido"])
            ->get();
            /*
            SELECT mp.*, se.nombre  FROM medida_pieza mp
            INNER JOIN servicio_tipocontrato_pedido stp ON  stp.id = mp.servicio_tipocontrato_pedido_id
            INNER JOIN servicio_tipocontrato st ON st.id = stp.servicio_tipocontrato_id
            INNER JOIN servicio se ON se.id =  st.servicio_id
            AND stp.pedido_id = 6 group by (nombre);
            */
            $servicios = medidapieza::select("servicio.nombre as servicio")
            ->join("servicio_tipocontrato_pedido", "servicio_tipocontrato_pedido.id", "=", "medida_pieza.servicio_tipocontrato_pedido_id")
            ->join("servicio_tipocontrato", "servicio_tipocontrato.id", "=", "servicio_tipocontrato_pedido.servicio_tipocontrato_id")
            ->join("servicio", "servicio.id", "=", "servicio_tipocontrato.servicio_id")
            ->where("servicio_tipocontrato_pedido.pedido_id", "=", $pedido["nro_pedido"])
            ->groupBy("servicio.nombre")
            ->get();
            return view('ordenProduccion.retornar', compact('pedido','medidas_pieza', 'servicios'));
        }else{
            return redirect('/pedido/show');
        }

    }

    public function cambiar_estado_retornar(Request $request)
    {
        $input = $request->all();
        $var = 0;
        $fecha_fin = (getdate()["year"]."-".getdate()["mon"]."-".getdate()["mday"]);
        try {
            \DB::beginTransaction();
            $orden_produccion = ordenProduccion::select("*")->where("Pedido_id", "=", $input["nro_pedido"])
            ->where("estado_orden_produccion_id", "=",
            estado_orden_produccion::select("*")
            ->where("nombre", "=", "Enviado")->first()["id"])->first();

            $orden_produccion->update(["estado_orden_produccion_id" =>
            estado_orden_produccion::select("*")
            ->where("nombre", "=", "Terminado")
            ->first()["id"],"fechaFin"=>$fecha_fin]);

            $var = ordenProduccion::create(["pedido_id"=>
            $orden_produccion["pedido_id"],"observacion"=>
            $input["observacion"],"estado_orden_produccion_id"=>
            estado_orden_produccion::select("*")->where("nombre", "=", "Pendiente")
            ->first()["id"]]);

            $pedido = pedido::find($orden_produccion["pedido_id"]);

            $pedido->update(["estado_pedido_id"=>
            estado_pedido::select("*")->where("nombre", "=", "Retornado")->first()["id"]]);
            Notify::success("Pedido, ". $pedido["id"]." Retornado con éxito."."Notificación");
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            Notify::Error("Ha ocurrido un error al retornar el pedido, Por favor vuelva a intentarlo "."Notificación");
        }
        return redirect('/pedido/show');;
    }

}
