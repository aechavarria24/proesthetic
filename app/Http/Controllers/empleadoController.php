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
    return Datatables::of($empleados)
    ->addColumn('action', function ($empleado) {
      return '<a href="/empleado/'.$empleado["id"].'/edit" title = "Editar" class="btn btn-xsy"><i class="glyphicon glyphicon-edit"></i></a>
      <a href="/empleado/'.$empleado["id"].'/edit" title = "Inhabilitar" class="btn btn-xs"><i class="glyphicon glyphicon-trash"></i></a>';
    })->editColumn('estado',function($empleado){ return $empleado["rol"] != 1 ? "Activo":"Inactivo";})
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


  public function validar_empleado(Request $request){
    $empleado =  empleado::where('username', $request['usuario'])->first();
    if ($empleado == null) {
      $empleado = 0;
    }else {
      $empleado = 1;
    }

    return response()->json(['respuesta'=>$empleado]);

  }
}
