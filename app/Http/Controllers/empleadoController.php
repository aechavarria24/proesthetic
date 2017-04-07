<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\rol;
use App\Model\preguntaEmpleado;
use App\Model\empleado;
use Notify;
use Datatables;

class empleadoController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        //
        return view('empleado.index');
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function getData (Request $Request)
    {
        $empleados = empleado::select("empleado.*","rol.nombre AS rol")->join("rol", "rol.id", "=", "rol_id")->get()->toArray();
        $btnEstado = "";
        return Datatables::of($empleados)
        ->addColumn('action', function ($empleado) {
            $btnEstado ="";
            if($empleado["estado"] == 1){
                $btnEstado .= '<button  onclick="cambiar_estado('.$empleado["id"].', 0)" class="btn" title = "Inactivar" ><i class="glyphicon glyphicon-remove" ></i></button>';
            }else if ($empleado["estado"] == 0){
                $btnEstado .= '<button onclick="cambiar_estado('.$empleado["id"].', 1)" class="btn" title = "Activar" ><i class="glyphicon glyphicon-ok" ></i></button>';
            }
            return $btnEstado.='<a href="/empleado/'.$empleado["id"].'/edit" title = "Editar" class="btn btn-xsy"><i class="glyphicon glyphicon-edit"></i></a>
            <a href="/empleado/'.$empleado["id"].'/edit" title = "Inhabilitar" class="btn btn-xs"><i class="glyphicon glyphicon-trash"></i></a>';
        })->editColumn('estado',function($empleado){ return $empleado["estado"] != 1 ? "Activo":"Inactivo";})
        ->make(true);
    }




    public function create()
    {
        $roles = Rol::all();
        $preguntas = preguntaEmpleado::all();
        return view('empleado.crear', compact('roles', 'preguntas'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        //
        $roles = Rol::all();
        $preguntas = preguntaEmpleado::all();
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        empleado::create($input);
        Notify::success("El empleado \"". $input['nombre'] ."\", se registro con éxito.","Registro exitoso");
        return view('empleado.crear', compact('roles', 'preguntas'));

    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        //
        return view('empleado.listar');
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
        $empleado = empleado::find($id);

        //$empleado = empleado::select("empleado.*", "rol.nombre AS rol")
        //->join("rol", "rol.id", "=", "empleado.rol_id")
        //->where("empleado.id", $id)
        //->first();
        $pregunta = preguntaEmpleado::select("pregunta_empleado.*")
        ->join("empleado", "pregunta_empleado.id", "=", "empleado.pregunta_empleado_id")
        ->where("empleado.id", $id)
        ->first();
        if ($empleado == null) {
            Notify::success("No se encontro el empleado \"". $input['nombre'] ."\".","Ooops");
            redirect('empleado/show');
        } else {
            $roles = rol::pluck("nombre","id");
            $preguntas = preguntaEmpleado::pluck("pregunta", "id");
            return view("empleado.editar", compact("empleado", "roles", 'pregunta'));
        }


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
        $input = $request->all();
        $empleado = empleado::find($id);
        if ($empleado == null) {
            Notify::warning('No se encontro el empleado que intenta actualizar', 'Nota: ');
            return redirect('empleado/show');;
        } else {
            $empleado->update($input);
            Notify::success('Empelado '.$input['nombre'].' actualizado con éxito', 'Nota: ');
            return redirect('empleado/show');
        }


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


    public function validar_empleado(Request $request){
        $empleado =  empleado::where('username', $request['usuario'])->first();
        if ($empleado == null) {
            $empleado = 0;
        }else {
            $empleado = 1;
        }
        return response()->json(['respuesta'=>$empleado]);
    }

    public function cambiar_estado(Request $request){
        $input = $request->all();
        $empleado =empleado::find($input['empleado_id']);
        if($empleado ==null){
            Notify::warning ('No se encontraron datos','Espera');
            return redirect('/empleado');
        }

        $empleado -> update(["estado"=>$input['estado']]);
        return json_encode(['respuesta'=>'1']);

    }
}
