<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\contrato;
use App\Model\servicio;
use App\Model\servicioTipoContrato;
use Notify;
use Datatables;

class contratoController extends Controller{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function getData (Request $Request){
        $contrato = contrato::all();
        return Datatables::of($contrato)
        ->addColumn('action', function ($contrato) {
            return '<a href="/contrato/'.$contrato->id.'/edit" class="btn btn-xs
            btn-primary"><i class="glyphicon glyphicon-edit"></i>&nbsp;Editar</a>
            <a href="/contrato/'.$contrato->id.'/edit" class="btn btn-xs btn-danger">
            <i class="glyphicon glyphicon-trash"></i>&nbsp;Inabilitar</a>';
        })->make(true);
    }




    public function index(){
        return view('contrato.index');
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(){
        //
        $servicio = servicio::all();
        return view('contrato.crear', compact("servicio"));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request){
        $input = $request->all();
        $servicio = session("contrato");
        \DB::beginTransaction();
        $id_contrato = contrato::create($input);
        if ($id_contrato != null ) {
            try {

                foreach ($servicio as $key => $value) {
                    servicioTipoContrato::create(["servicio_id"=>$value["servicio"],
                    "tipoContrato_id"=>$id_contrato["id"], "valor"=>$value["valor"]]);
                }

                Notify::success("El contrato \"". $input['nombre'] ."\", se
                registro con éxito.","Registro exitoso");

                \DB::commit();
            } catch (\Exception $e) {
                \DB::rollBack();
                Notify::error("El contrato \"". $input['nombre'] ."\", no se pudo
                registrar con éxito, debido a una excepción","Error");
            }
        }else{
            Notify::error("El contrato \"". $input['nombre'] ."\", no se pudo
            registrar con éxito","Error");
        }
        return redirect('/contrato/create');
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id){
        $contrato = contrato::all();
        return view('contrato.listar');
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $contrato = contrato::find($id);
    if (false/**$contrato==null*/) {
        Notify::warning('No se encontraron datos','Espera...');
        return redirect('/edit/show');
    } else {
        return view('contrato.editar',compact('contrato'));
    }
}

/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id){
    $input = $request->all();
    $contrato = contrato::find($id);
    if ($contrato==null) {
        Notify::warning('No se encontraron datos','Nota: ');
        return redirect('contrato/show');
    }
    $contrato->update($input);
    Notify::success("El Contrato \"". $input['nombre'] ."\", se modifico con
    éxito.","Modificacion exitosa");
    return redirect('contrato/show');
}

/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy($id){
    //
}


public function agregar_servicio(Request $request){
    $input = $request->all();

    if (session("contrato") == null) {
        session(["contrato"=>[["servicio" => $input["servicio"],
        "valor" => $input["valor"], "nombre"=>$input["nombre"] ] ]] );
    }else{
        $contrato = session("contrato");
        array_push($contrato, ["servicio" => $input["servicio"],
        "valor" => $input["valor"], "nombre"=>$input["nombre"]]);
        session(["contrato" => $contrato]);
    }

    return response()->json(session("contrato"));
}

function eliminar_tabla_servicio(Request $request){
    $input = $request->all();
    $request->session("contrato")->flush();
}


function eliminar_servicio(Request $request){
    $input = $request->all();

    $contrato = session("contrato");

    foreach ($contrato as $key => $value) {
        if ($value["servicio"] == $input["id"]) {
            $servicio = $contrato[$key];
            unset($contrato[$key]);
            session(["contrato"=>$contrato]);
            break;
        }
    }

    return response()->json(["session"=>session("contrato"),
    "servicioEliminado"=>$servicio]);
}
}
