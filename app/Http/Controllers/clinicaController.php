<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\clinica;
use App\Model\contrato;
use Datatables;
use Notify;



class clinicaController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function getData(Request $Request){
        $clinica = clinica::all();


        $btnEstado ="";

        return Datatables::of($clinica)

        ->addColumn('action', function ($clinica) {
            $btnEstado ="";
            if($clinica->estadoClinica == 1){
                $btnEstado .= '<button  onclick="cambiar_estado('.$clinica->id.', 0)" title = "Inactivar" ><i class="glyphicon glyphicon-remove" ></i></button>';
            }else if ($clinica->estadoClinica == 0){
                $btnEstado .= '<button onclick="cambiar_estado('.$clinica->id.', 1)"  title = "Activar" ><i class="glyphicon glyphicon-ok" ></i></button>';
            }

            return $btnEstado .= '<a href="/clinica/'.$clinica->id.'/edit" title = "Editar"><i class="glyphicon glyphicon-edit"></i></a>';
        })

        ->editColumn('estadoClinica', function ($clinica){
            return  $clinica->estadoClinica == 1 ? "Activo" : "Inactivo";

        })

        ->make(true);
    }


    public function index(){
        //
        return view('clinica.index');
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(){
        //
        $tipoContrato = contrato::all();
        return view('clinica.crear', compact('tipoContrato'));
    }

    /**
    *  a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request){
        //

        $input = $request->all();
        clinica::create($input);
        $tipoContrato = contrato::all();
        Notify::success("La clínica ". $input['nombre'] .", se registro con éxito.","Registro exitoso");
        return view('clinica.crear', compact('tipoContrato'));
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(){
        return view('clinica.listar');
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id){
        $tipoContrato= contrato::all();
        // $tipoContrato= contrato::select('tipo_contrato.*')
        // ->join('clinica','tipo_contrato.id','=','clinica.tipo_contrato_id')
        // ->where('clinica.id', $id)
        // ->get();
        $clinica = clinica::find($id);
        if ($clinica==null) {
            Notify::warning('No se encontraron datos','Espera...');
            return redirect('/clinica/show');
        } else {
            return view('clinica.editar',compact('clinica','tipoContrato'));
        }

    }

    public function cambiar_estado(Request $request){
        $input = $request->all();
        $clinica =clinica::find($input['clinica_id']);
        if($clinica ==null){
            Notify::warning ('No se encontraron datos','Espera');
            return redirect('/clinica');
        }

        $clinica -> update(["estadoClinica"=>$input['estado']]);
        return json_encode(['respuesta'=>'1']);

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
        $clinica = clinica::find($id);
        if ($clinica==null) {
            Notify::warning('No se encontraron datos','Nota: ');
            return redirect('clinica/show');
        }
        $clinica->update($input);
        Notify::success("La clinica \"". $input['nombre'] ."\", se modifico con éxito.","Modificacion exitosa");
        return redirect('clinica/show');
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

    public function validar_clinica(Request $request){
        $input = $request->all();
        $respuesta = 0;
        $clinica = clinica::select('*')->where("nombre", "=", $input["nombre"])->first();
        if ($clinica != null) {
            $respuesta = 1;
        }

        return response()->json(["respuesta"=>$respuesta]);
    }
}
