<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\paciente;
use App\Model\pedido;
use App\Model\servicio;
use App\Model\usuarioClinica;
use App\Model\clinica;
use App\Model\servicioTipoContrato;
use App\Model\medidapieza;
use App\Model\ordenProduccion;
use App\Model\rol;
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
            $servicio_TipoContrato = servicioTipoContrato::select("valor")->where("id",$id)->first();
            // var_dump($servicio_TipoContrato);
            // exit;
            return json_encode($servicio_TipoContrato);
        }

    }


    public function detalle($id) {
        $pedido=pedido::select('pedido.observacion','pedido.id','clinica.nombre','paciente.nombre as pacienteNombre','paciente.cedula','estado_pedido.nombre as estadoPedido','fechaEntrega')
        ->join('usuario_clinica','usuario_clinica.id','=','pedido.usuario_id')
        ->join('clinica','clinica.id','=','usuario_clinica.clinica_id')
        ->join('paciente','paciente.id','=','pedido.paciente_id')
        ->join('estado_pedido','estado_pedido.id','=','pedido.estado_pedido_id')
        ->where('pedido.id',$id)
        ->get();

        $piezas_pedido = $this->consultar_piezas($pedido[0]["id"]);
        $servicios = $piezas_pedido["servicios"];
        $medidas_pieza = $piezas_pedido["medidas"];

        return view('pedido.detalle',compact('pedido','servicios', 'medidas_pieza'));
    }

    public function aprobarPedido(Request $request){
        $input=$request->all();
        /* Se debe tomar el id de la session de usuario*/
        $respuesta = 0;
        $respuesta2=0;
        $respuesta3=0;
        try {
            \DB::beginTransaction();
            $id_usuario= \Auth::user()->id;
            $estado_orden_produccion_id = 3;
            $pedido=pedido::find($input["id"]);
            if ($pedido != null && $pedido["estado_pedido_id"] == 1) {
                $input["estado_pedido_id"] = 2;
                $pedido->update($input);
                $orden_produccion=ordenProduccion::create(['usuario_id'=>$id_usuario,'pedido_id'=>$pedido["id"],'estado_orden_produccion_id'=>$estado_orden_produccion_id]);
                Notify::success("Orden de producción","Orden"." ". $orden_produccion." "."creado con éxito");
                $respuesta = 1;
                $respuesta2=$orden_produccion['id'];
            }else{
                // dd($respuesta);
                $respuesta = 0;
            }
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            $respuesta = 2;
            $respuesta3 ="No tiene permisos para realizar la operación, contacte al administrador del sistema e informe el código de error";
        }



        return json_encode(["respuesta" => $respuesta,"respuesta2"=>$respuesta2,"respuesta3"=>$respuesta3]);

    }

    public function cancelarPedido(Request $Request){
        $input=$Request->all();
        $pedido=pedido::find($input["id"]);

        if ($pedido != null && $pedido["estado_pedido_id"] == 1) {
            $input["estado_pedido_id"]=7;
            $pedido->update(["estado_pedido_id"=>$input["estado_pedido_id"],
            "observacion"=>$input["descripcion"]
        ]);
        return json_encode(["respuesta"=>1]);
    }else{
        return json_encode(["respuesta"=>0]);
    }

}
public function getData (Request $Request)
{
    // return "llego al data";
    $retornar=0;

    /**
     * Validar el rol de usuario para mostrar los pedido, ya sean solo de
     * un doctor ó todos para el Administrador.
     * @var [rol_id ]
     */
    if (\Auth::user()->rol_id == rol::select("*")
    ->where("nombre", "=", "Administrador")->first()["id"]) {
        $pedido = pedido::select('clinica.nombre as usuario_id','pedido.id as id','pedido.created_at as created_at',
        'pedido.fechaEntrega as fechaEntrega','estado_pedido.nombre','pedido.estado_pedido_id')
        ->join('estado_pedido','estado_pedido.id','=','pedido.estado_pedido_id')
        ->join('usuario_clinica','usuario_clinica.id','=','pedido.usuario_id')
        ->join('clinica','clinica.id','=','usuario_clinica.clinica_id')
        ->get();
    } else if(\Auth::user()->rol_id == rol::select("*")
    ->where("nombre", "=", "Doctor")->first()["id"]){
        $pedido = pedido::select('clinica.nombre as usuario_id','pedido.id as id','pedido.created_at as created_at',
        'pedido.fechaEntrega as fechaEntrega','estado_pedido.nombre','pedido.estado_pedido_id')
        ->join('estado_pedido','estado_pedido.id','=','pedido.estado_pedido_id')
        ->join('usuario_clinica','usuario_clinica.id','=','pedido.usuario_id')
        ->join('clinica','clinica.id','=','usuario_clinica.clinica_id')
        ->where("usuario_id", "=", \Auth::user()->id)
        ->get();
    }

    return Datatables::of($pedido)
    ->addColumn('action', function ($pedido) {

        $btnAprobarProcesar = '<a><i onclick="aprobarPedido(this);" id="'.$pedido->id.'" class="fa fa-handshake-o" aria-hidden="true" title="Aprobar y procesar"></i>&nbsp;</a>';
        $btnCancelar = '<a><i class="glyphicon glyphicon-trash"  onclick="cancelarPedido(this);" id="'.$pedido->id.'" title="Cancelar"></i>&nbsp;</a>';
        $btnEditar = '<a href="/pedido/'.$pedido->id.'/edit" ><i class="glyphicon glyphicon-edit" title="Editar"></i>&nbsp;</a>';
        $btnDetallePedido = '<a href="/pedido/'.$pedido->id.'/detallePedido" ><i class="fa fa-eye" title="Detalle"></i>&nbsp;</a>';
        $btnRetornar =  $pedido->estado_pedido_id == 6  ? '<a href="/pedido/'.$pedido->id.'/retornar" title = "Retornar"><i class="fa fa-undo"></i></a>': "";

        /**
         * Retornar los botones según el rol del usuario (Doctor ó Administrador).
         * @var [rol_id]
         */
        if (\Auth::user()->rol_id == rol::select("*")
        ->where("nombre", "=", "Doctor")->first()["id"]) {
            return $btnCancelar.$btnEditar.$btnDetallePedido.$btnRetornar;
        } else if (\Auth::user()->rol_id == rol::select("*")
        ->where("nombre", "=", "Administrador")->first()["id"]){
            return $btnAprobarProcesar.$btnCancelar.$btnEditar.$btnDetallePedido;
        }


        return $btnAprobarProcesar.$btnCancelar.$btnEditar.$btnDetallePedido.$btnRetornar;
    })->editColumn('estado_pedido_id', function($pedido){

        switch ($pedido->estado_pedido_id) {
            case '1':
            $estado = "Pendiente";
            break;
            case '2':
            $estado = "Aprobado y procesando";
            break;
            case '3':
            $estado = "Rechazado";
            break;
            case '4':
            $estado = "Cumplido";
            break;
            case '5':
            $estado = "Procesando";
            break;
            case '6':
            $estado = "Enviado";
            break;
            case '7':
            $estado = "Cancelado";
            break;
            case '8':
            $estado = "Retornado";
            break;
            default:
            $estado = "";
            break;
        }

        return $estado;

    })->make(true);
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
    $usuarioClinica =  usuarioClinica::select('usuario_clinica.id','usuario_clinica.nombre as NombreDoctor','usuario_clinica.apellido as ApellidoDocto','clinica.nombre as usuarioClinica')
    ->join('clinica','usuario_clinica.clinica_id','=','clinica.id')
    ->where('usuario_clinica.id', '=', \Auth::user()->id)
    ->get();

    // var_dump($usuarioClinica);
    // exit;

    //
    // SELECT * FROM servicio_tipocontrato as A
    //     INNER join servicio as b on a.servicio_id=b.id
    $servicio = serviciotipoContrato::select('servicio_tipocontrato.id as id', 'servicio.nombre')
    ->join('servicio','servicio_tipocontrato.servicio_id','=','servicio.id')
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
public function obtener_tipo_servicio(){
    $i = 0;
    $key_array = [];
    $a = session("pedido");
    foreach($a as $val) {
        if (!in_array($val["servicio_tipo_id"] , $key_array)) {
            $key_array[$i] = $val["servicio_tipo_id"];
        }
        $i++;
    }
    return $key_array;
}
function traer_nombre_paciente(Request $request){

    $cedula=$request->all();
    $nombre = paciente::select('nombre')
    ->where("cedula",'=',$cedula["cedula"])->get();

    return json_encode($nombre);

}

//-----GUARDAR
public function store(Request $request)
{
    if (!Session("pedido")==null) {
        $input = $request->all();
        $valida_paciente[0] = null;
        $valida_paciente = paciente::select('*')
        ->where('cedula','=',$input['cedula'])
        ->first();
        //$auxiliar_paciente=0;
        if ($valida_paciente == false) {
            $paciente1=paciente::create(['cedula'=>$input["cedula"],'nombre'=>$input["nombre"]]);
            $auxiliar_paciente=$paciente1->id;
        }else {
            $valida_paciente->update(['nombre'=>$input["nombre"]]);
            $auxiliar_paciente=$valida_paciente->id;
        }

        $pedido=pedido::create(['usuario_id'=>$input["usuario_id"],'fechaEntrega'=>$input["fechaEntrega"],'observacion'=>$input["observacion"],'paciente_id'=>$auxiliar_paciente ]);
        $id=$pedido["id"];
        $session=session("pedido");


        foreach ($this->obtener_tipo_servicio() as $key => $servicio) {


            $servicio_tipocontrato_pedido_id=servicioTipocontratoPedido::create(
                ['pedido_id'=>$pedido["id"],'servicio_tipocontrato_id'=>$servicio]);

                foreach (session("pedido") as $key=> $medida) {
                    if ($servicio==$medida["servicio_tipo_id"]) {
                        $medidaPieza=medidaPieza::create(
                            ['servicio_tipocontrato_pedido_id'=>$servicio_tipocontrato_pedido_id["id"],
                            'dimension'=>$medida["dimension"],'cantidad'=>$medida["cantidad"]
                            ,'unidadMedidad'=>$medida["unidad"]]);
                        }
                    }
                }

                Notify::success("Pedido","Pedido"." ". $id." "."creado con éxito");
                return redirect('pedido/create');
            }else {
                Notify::error("Ingrese un servicio","Atencion...");
                return redirect('pedido/create');
            }

        }
        /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function show($id)  {

            $pedido = pedido::select('clinica.nombre as usuario_id','pedido.id as id','pedido.created_at as created_at',
            'pedido.fechaEntrega as fechaEntrega','estado_pedido.nombre')
            ->join('estado_pedido','estado_pedido.id','=','pedido.estado_pedido_id')
            ->join('clinica','clinica.id','=','pedido.usuario_id')
            ->get();
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

            if ($pedido==null) {
                Notify::warning('No se encontraron datos','Espera...');
                return redirect('/pedido/show');}
                elseif ($pedido['estado_pedido_id']==1) {                  # code...

                    $paciente = paciente::select('*')
                    ->join('pedido','pedido.paciente_id','=','paciente.id')
                    ->where('pedido.id','=',$id)
                    ->get();
                    // dd($paciente);

                    $medida_pieza = pedido::select('servicio.nombre as servicio','medida_pieza.id as id_pieza','medida_pieza.cantidad as cantidad','medida_pieza.dimension as dimension','medida_pieza.unidadMedidad as unidadMedidad')
                    ->join('servicio_tipocontrato_pedido','servicio_tipocontrato_pedido.pedido_id','=','pedido.id')
                    ->join('medida_pieza','medida_pieza.servicio_tipocontrato_pedido_id','=',
                    'servicio_tipocontrato_pedido.id')
                    ->join('servicio_tipocontrato','servicio_tipocontrato.id','=','servicio_tipocontrato_pedido.servicio_tipocontrato_id')
                    ->join('servicio','servicio.id','=','servicio_tipocontrato.servicio_id')
                    ->where('pedido.id',$id)
                    ->get();

                    $servicio = serviciotipoContrato::select('*')
                    ->join('servicio','servicio_tipocontrato.servicio_id','=','servicio.id')
                    // ->join('servicio','servicio_tipoContrato.tipoContrato_id','=','servicio_tipoContrato.tipoContrato_id')
                    -> get();
                    return view('pedido.editar',compact('pedido','servicio','paciente','medida_pieza','$tabla'));
                }else {
                    Notify::warning('El pedido se encuentra en un estado que no se puede editar','Alerta');
                    return view('pedido.listar');
                }
                //   dd($tabla);
                // return view('pedido.editar',$tabla);

            }

            /**
            * Update the specified resource in storage.
            *
            * @param  \Illuminate\Http\Request  $request
            * @param  int  $id
            * @return \Illuminate\Http\Response
            */
            public function update(Request $request)
            {
                $input=$request->all();
                // var_dump($input);
                // exit;
                $paciente=paciente::where("cedula",$input['cedulaPaciente'])->first();

                foreach ($input['id_pieza']  as $key =>  $value) {
                    $medida_Pieza=medidapieza::where('id',$value);
                    $medida_Pieza->update(["cantidad"=>$input['cantidad'][$key],"dimension"=>$input['dimension'][$key],"unidadMedidad"=>$input['unidadMedida'][$key]]);
                }


                if ($paciente==null && $medida_Pieza==null) {
                    Notify::warning('Lo siento','pedido no existe');
                    return view('pedido.listar');
                }
                $paciente->update(["cedula"=>$input['cedula'],"nombre"=>$input['nombre']]);
                Notify::success('Pedido','Pedido actualizado ');
                return view('pedido.listar');


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

            public function add_medida_pieza_tabla(Request $request){

                $input = $request->all();

                // dd(session("pedido"));
                // var_dump(session("pedido"));
                // exit;
                if (session("pedido") == null ) {

                    session(["pedido"=> [[ "id_tabla" => $input["id"], "unidad" => $input["unidad"], "cantidad" => $input["cantidad"], "dimension" => $input["dimension"],"servicio_tipo_id"=>$input["servicio_tipo_id"], "contadorSession" => $input["contador_session"]]]]);
                } else {
                    $pedido = session("pedido");
                    array_push($pedido, [ "id_tabla" => $input["id"], "unidad" => $input["unidad"], "cantidad" => $input["cantidad"], "dimension" => $input["dimension"], "servicio_tipo_id"=>$input["servicio_tipo_id"], "contadorSession" => $input["contador_session"]]);
                    session(["pedido" => $pedido]);
                }


                return response()->json(session("pedido"));

            }
            public function delete_medida_pieza_tabla(Request $request){
                $input=$request->all();
                // var_dump(session("pedido"));
                // exit;
                $session=session("pedido");
                foreach ($session as $key=>  $value) {
                    if ($input["contador"]==$value["contadorSession"]) {
                        unset($session[$key]);
                        session(["pedido"=>$session]);
                        // var_dump(session("pedido"));
                        // exit;
                        return json_encode(['respuesta'=>1]);
                    }
                }

            }

            public function eliminar_session(Request $request){
                $request->session()->forget('pedido');
            }

            private function consultar_piezas($id_pedido){

                $medidas_pieza = medidapieza::select("medida_pieza.*", "servicio.nombre as servicio")
                ->join("servicio_tipocontrato_pedido", "servicio_tipocontrato_pedido.id", "=", "medida_pieza.servicio_tipocontrato_pedido_id")
                ->join("servicio_tipocontrato", "servicio_tipocontrato.id", "=", "servicio_tipocontrato_pedido.servicio_tipocontrato_id")
                ->join("servicio", "servicio.id", "=", "servicio_tipocontrato.servicio_id")
                ->where("servicio_tipocontrato_pedido.pedido_id", "=", $id_pedido)
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
                ->where("servicio_tipocontrato_pedido.pedido_id", "=", $id_pedido)
                ->groupBy("servicio.nombre")
                ->get();

                return $datos=["medidas"=>$medidas_pieza, "servicios"=>$servicios];

            }
        }
