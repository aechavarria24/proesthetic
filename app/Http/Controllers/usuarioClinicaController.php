<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\usuarioClinica;
use App\Model\clinica;
use App\Model\preguntaCliente;
use App\Model\rol;
use Datatables;
use Notify;


class usuarioClinicaController extends Controller
{
    public function cambiar_estado(Request $request){
        $input = $request->all();
        $usuario_clinica =usuarioClinica::find($input['usuario_id']);
        if($usuario_clinica ==null){
            Notify::warning ('No se encontraron datos','Espera');
            return redirect('/usuario/show');
        }
        $usuario_clinica -> update(["estado"=>$input['estado']]);
        return json_encode(['respuesta'=>'1']);

    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function getData (Request $Request)
    {
        $usuarioClinica = usuarioClinica::all();


        return Datatables::of($usuarioClinica)
        ->addColumn('action', function ($usuario) {
            $btnEstado="";
            if ($usuario->estado==1) {

                $btnEstado .= '<a  onclick="cambiar_estado('.$usuario->id.', 2)" title = "Inactivar" ><i class="glyphicon glyphicon-remove" ></i>&nbsp;</a>';

            }elseif ($usuario->estado==2) {
                $btnEstado .= '<a  onclick="cambiar_estado('.$usuario->id.', 1)" title = "Activar" ><i class="glyphicon glyphicon-ok" ></i>&nbsp;</a>';
            }

            return $btnEstado .= '<a href="/usuario/'.$usuario->id.'/edit" title = "Editar"><i class="glyphicon glyphicon-edit"></i>&nbsp;</a>';
        })
        ->editColumn('estado', function ($usuario){
            return  $usuario->estado == 1 ? "Activo" : "Inactivo";

        })
        ->make(true);
    }
    public function index()
    {
        //
        return view('usuarioClinica.index');
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
        $clinica = clinica::all();
        $roles = rol::all();
        $preguntas = preguntaCliente::all();
        return view('usuarioClinica.crear', compact('clinica', 'roles', 'preguntas'));
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
        try {
            $clinica = clinica::all();
            $roles = rol::all();
            $preguntas = preguntaCliente::all();
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            usuarioClinica::create($input);
            Notify::success("Usuario ". $input['username'] .", se registro con éxito.","Registro exitoso");
            return view('usuarioClinica.crear', compact('clinica', 'roles', 'preguntas'));
        } catch ( \Exception $e) {

            switch ($e) {
                //Excepcion de campos repetidos en la base de datos
                case '23000':
                Notify::danger("El usuario que intenta registrar: ". $e->getCode() .", ya existe.","Ooops...");
                return view('usuarioClinica.crear', compact('clinica', 'roles', 'preguntas'));
                break;

                default:
                Notify::danger("Error ". $e->getCode() .", se registro con éxito.","Registro exitoso");
                break;
            }
        }

        $clinica = clinica::all();
        $roles = rol::all();
        $preguntas = preguntaCliente::all();
        $input = $request->all();
        usuarioClinica::create($input);
        Notify::success("Usuario ". $input['username'] .", se registro con éxito.","Registro exitoso");
        return view('usuarioClinica.crear', compact('clinica', 'roles', 'preguntas'));

    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $usuarioClinica= usuarioClinica::all();
        return view('usuarioClinica.listar');

    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $usuarioClinica = usuarioClinica::select('usuario_clinica.password as password','usuario_clinica.id as id','usuario_clinica.nombre as nombre','usuario_clinica.username as username','clinica.nombre as clinica_nombre')
        ->join('clinica','clinica.id','=','usuario_clinica.clinica_id')
        ->where('usuario_clinica.id',$id)
        ->first();
        // var_dump($usuarioClinica);
        // exit;

        if ($usuarioClinica==null) {
            Notify::warning('No se encontraron datos','Espera...');
            return redirect('/usuarioClinica/show');
        } else {
            return view('usuarioClinica.editar',compact('usuarioClinica'));
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
        $usuarioClinica = usuarioClinica::find($id);

        if ($input['password']!=$input['confirmarPassword']) {
            Notify::warning('Contraseña y confirmar contraseña no coinciden','Alerta: ');
            return redirect('usuario/'.$id.'/edit');
        }elseif ($usuarioClinica==null) {
            Notify::warning('No se encontraron datos','Nota: ');
            return redirect('usuario/show');
        }
        $input['password'] = bcrypt($input['password']);
        $input['confirmarPassword'] = bcrypt($input['password']);
        $usuarioClinica->update($input);
        Notify::success("El usuario \"". $input['nombre'] ."\", se modifico con éxito.","Modificacion exitosa");
        return redirect('usuario/show');
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

    public function validar_usuario(Request $request){
        $input = $request->all();
        $usuario_clinica = usuarioClinica::select("*")
        ->where("username", "=", $input["id"])
        ->count();

        if ($usuario_clinica == 0) {
            return response()->json(['respuesta'=>$usuario_clinica]);
        }else{
            $usuario_clinica=1;
            return response()->json(['respuesta'=>$usuario_clinica]);
        }
    }
}
