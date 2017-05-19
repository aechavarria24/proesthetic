<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\cuentaCobro;
use App\Model\paciente;
use App\Model\usuarioClinica;
use App\Model\clinica;
use App\Model\venta;
use App\Model\cuentaCobroVenta;
use App\Model\rol;
use Notify;
use Datatables;
use PDF;
use Empleado;


class cuentaCobroController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function generar_Pdf($id){
        $cuentaCobro = venta::select('cuentacobro_venta.id as cobroVentaId','cuenta_cobro.id as cuentaCobro','venta.id as numventa','venta.pedido_id as pedido_id',
        'empleado.username as empleado_id','venta.created_at as fechaCreacion',
        'cuenta_cobro.valorTotal as valorTotal','clinica.nombre as clinica','clinica.diaCorte')
        ->join('cuentacobro_venta','cuentacobro_venta.venta_id','=','venta.id')
        ->join('cuenta_cobro','cuenta_cobro.id','=','cuentacobro_venta.cuentaCobro_id')
        ->join('empleado','empleado.id','=','venta.empleado_id')
        ->join('pedido','pedido.id','=','venta.pedido_id')
        ->join('usuario_clinica','usuario_clinica.id','=','pedido.usuario_id')
        ->join('clinica','clinica.id','=','usuario_clinica.clinica_id')
        ->where('cuenta_cobro.id',$id)
        ->get();

        $pdf = PDF::loadView('cuentaCobro.pdf',compact('cuentaCobro'));
        return $pdf->stream('cuentaCobro'.$id.'.pdf');

    }

    public function detalle($id) {
        $permiso = false;
        $cuentaCobro = venta::select('cuentacobro_venta.id as cobroVentaId','cuenta_cobro.id as cuentaCobro','venta.id as numventa','venta.pedido_id as pedido_id',
        'empleado.username as empleado_id','venta.created_at as fechaCreacion','cuenta_cobro.valorTotal as valorTotal')
        ->join('cuentacobro_venta','cuentacobro_venta.venta_id','=','venta.id')
        ->join('cuenta_cobro','cuenta_cobro.id','=','cuentacobro_venta.cuentaCobro_id')
        ->join('empleado','empleado.id','=','venta.empleado_id')
        ->where('cuenta_cobro.id', "=", $id)
        ->get();

        if (\Auth::user()->rol_id == rol::select("*")->where("nombre","=", "Administrador")->first()["id"]){
            $permiso = true;
        }


        return view('cuentaCobro.detalle',compact('cuentaCobro', 'permiso'));
    }
    public function pagarCuenta(Request $request)
    {
        $input=$request->all();



        if (isset($input['suma']) && isset($input['s'])) {

            $input=$request->all();
            $pago=cuentacobro::whereIn('id',$input['s'])->sum('valorTotal');



            $usuarioClinica=  usuarioClinica::select('usuario_clinica.id','usuario_clinica.nombre as NombreDoctor','usuario_clinica.apellido as ApellidoDocto','clinica.nombre as usuarioClinica')
            ->join('clinica','usuario_clinica.clinica_id','=','clinica.id')


            ->get();

            return view('cuentaCobro.pago', compact('usuarioClinica','pago'));
            # code...
        }


        elseif(isset($input['s']) && isset($input['pago'])) {
            // dd($input);
            $input["estado"]=2;
            foreach ($input['s'] as $value) {

                $cuentaCobro = cuentaCobro::find($value);

                $cuentaCobro->update(['estado'=>$input['estado']]);

            }


            Notify::success('Cuentas de cobro pagadas con exito','Noticia');
            return redirect('/cuentacobro/show');

        }
        Notify::error('Por favor seleccione una cuenta de cobro','Error');
        return redirect('/cuentaCobro/show');

    }

    public function eliminarVenta (Request $request)
    {
        $input = $request->all();

        $cuentaCobroVenta = cuentaCobroVenta::find($input['id']);
        if ($cuentaCobroVenta== null) {
            return json_encode(["respuesta"=>0]);
        }else {
            $cuentaCobroVenta->delete($input['id']);
            $consulta_Venta=venta::select('venta.id as venta','servicio_tipoContrato.valor')
            ->join( 'pedido','pedido.id','=','venta.pedido_id')
            ->join( 'servicio_tipocontrato_pedido','servicio_tipocontrato_pedido.pedido_id','=','pedido.id')
            ->join( 'servicio_tipocontrato','servicio_tipocontrato.id','=','servicio_tipocontrato_pedido.servicio_tipocontrato_id')
            ->where( 'venta.id','=',$cuentaCobroVenta['venta_id'])
            ->first();

            $resta=$consulta_Venta['valor'];

            $cuentaCobro= cuentaCobro::find($cuentaCobroVenta['cuentaCobro_id']);


            $valorTotal=$cuentaCobro['valorTotal']-$resta;
            $cuentaCobro->update(['valorTotal'=>$valorTotal]);
            return json_encode(["respuesta"=>1, "valor_total"=>$valorTotal]);
        }

    }

    public function getData (Request $Request)
    {
        if (\Auth::user()->rol_id == rol::select("*")->where("nombre","=", "Doctor")->first()["id"]) {
            $cuentascobro = cuentaCobro::select("cuenta_cobro.id as id",
            "cuenta_cobro.created_at as created_at", "cuenta_cobro.valorTotal as valorTotal",
            "cuenta_cobro.estado as estado")
            ->join("cuentacobro_venta", "cuentacobro_venta.cuentaCobro_id", "=", "cuenta_cobro.id")
            ->join("venta", "cuentacobro_venta.venta_id", "=", "venta.id")
            ->join("pedido", "pedido.id", "=", "venta.pedido_id")
            ->join("usuario_clinica", "usuario_clinica.id", "=", "pedido.usuario_id")
            ->where("usuario_clinica.id", "=", \Auth::user()->id)
            ->get();

            return Datatables::of($cuentascobro)
            ->addColumn('action', function ($cuentaCobro) {
                return '<a href="/cuentacobro/'.$cuentaCobro->id.'/detalle" class="btn btn-xs "><i title="Detalle" class="fa fa-eye" aria-hidden="true"></i>&nbsp;</a>
                ';
            })
            ->addColumn('seletion', "")
            ->editColumn('estado',function($cuentaCobro){
                if ($cuentaCobro->estado=='1') {
                    $estado='Pendiente';
                }else {
                    $estado='Pagada';
                }
                return $estado;
            })

            ->make(true);

        }elseif (\Auth::user()->rol_id == rol::select("*")->where("nombre","=", "Administrador")->first()["id"]){
            $cuentascobro = cuentaCobro::all();

            return Datatables::of($cuentascobro)
            ->addColumn('action', function ($cuentaCobro) {
                return '<a href="/cuentaCobro/'.$cuentaCobro->id.'/adicionar" class="btn btn-xs "><i title="Agregar venta" class="fa fa-cart-plus" aria-hidden="true"></i>&nbsp;</a>
                <a href="/cuentacobro/'.$cuentaCobro->id.'/detalle" class="btn btn-xs "><i title="Detalle" class="fa fa-eye" aria-hidden="true"></i>&nbsp;</a>
                ';
            })
            ->addColumn('seletion', function(){
                return "admin";
            })
            ->editColumn('estado',function($cuentaCobro){
                if ($cuentaCobro->estado=='1') {
                    $estado='Pendiente';
                }else {
                    $estado='Pagada';
                }
                return $estado;
            })

            ->make(true);
        }



    }



    public function index()
    {
        return redirect('/cuentaCobro/show');
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(Request $request)
    {


    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $input=$request->all();

        foreach ($input['s'] as  $value) {
            $insert_cuenta=pedido::select( 'servicio_tipocontrato.valor','venta.id from pedido')
            ->join( 'servicio_tipocontrato_pedido','servicio_tipocontrato_pedido.pedido_id','=','pedido.id')
            ->JOIN( 'servicio_tipocontrato','servicio_tipocontrato.id','=','servicio_tipocontrato_pedido.servicio_tipocontrato_id')
            ->JOIN( 'venta','venta.pedido_id','=','pedido.id')
            ->WHERE( 'pedido.id');

            // SELECT servicio_tipocontrato.valor,venta.id from pedido
            // INNER join servicio_tipocontrato_pedido on pedido.id=servicio_tipocontrato_pedido.pedido_id
            // INNER JOIN servicio_tipocontrato on servicio_tipocontrato.id=servicio_tipocontrato_pedido.servicio_tipocontrato_id
            // INNER JOIN venta on venta.pedido_id=pedido.id
            // WHERE pedido.id=87



            $insert_cuenta=pedido::select('servicio_tipocontrato.valor','venta.usuario_id')
            // ->join('tipo_contrato','tipo_contrato.id','=','servicio_tipocontrato.tipoContrato_id')
            // ->join('clinica',)
            // ->join('usuario_clinica',)
            // ->join('cuenta_cobro',)
            ->join('servicio_tipocontrato_pedido','servicio_tipocontrato_pedido.pedido_id','=','pedido.id')
            ->join('servicio_tipocontrato','servicio_tipocontrato.id','=','servicio_tipocontrato_pedido.servicio_tipocontrato_id')
            ->join('venta','venta.pedido_id','=','pedido.id')
            ->where('pedido.id',$value)
            ->get();
            var_dump($insert_cuenta);
            exit;


            $cuenta_cobro=cuentaCobro::create($insert_cuenta);
            dd($cuenta_cobro);
        }



        echo "llego";


    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show()
    {
        //
        $cuentacobros = cuentaCobro::all();

        return view('cuentaCobro.listar');

    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit()
    {
        return view('cuentaCobro.editar');
    }
    public function adicionar($id)
    {
        $cuentaCobro = cuentaCobro::find($id);
        if ($cuentaCobro==null) {
            Notify::error('Lo siento no se encontro el dato','Noticia');
            return redirect('cuentacobro/show');
        }elseif ($cuentaCobro['estado']<>1) {
            Notify::error('Cuenta de cobro esta en un estado que no se puede editar','Noticia');
            return redirect('cuentacobro/show');
        }

        return view('cuentaCobro.editar',compact('cuentaCobro'));
    }

    public function agregar_venta(Request $request)
    {
        $input = $request->all();

        if (isset($input['s'])) {

            $suma=0;
            foreach ($input['s'] as $key => $value) {
                $consulta_Venta=venta::select('venta.id as venta','servicio_tipoContrato.valor')
                ->join( 'pedido','pedido.id','=','venta.pedido_id')
                ->join( 'servicio_tipocontrato_pedido','servicio_tipocontrato_pedido.pedido_id','=','pedido.id')
                ->join( 'servicio_tipocontrato','servicio_tipocontrato.id','=','servicio_tipocontrato_pedido.servicio_tipocontrato_id')

                ->where( 'venta.id','=',$value)
                ->first();

                $suma=$consulta_Venta['valor']+$suma;


                $consultaVenta = cuentaCobroVenta::create(['cuentaCobro_id'=>$input['id'],'venta_id'=>$value]);
            }
            $consultacuenta= cuentaCobro::find($input['id']);

            $valorTotal=$consultacuenta['valorTotal']+$suma;


            $consultacuenta->update(['valorTotal'=>$valorTotal]);


            Notify::success('Venta agregada con exito','Noticia');
            return redirect('cuentaCobro/show');
        }

        Notify::error('No se encontraron datos','Alerta');


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
        $input = $request->all();
        $cuentaCobro = cuentaCobro::find($id);
        if ($cuentaCobro == null) {
            Notify::warning('No se encontraron datos','Nota: ');
            return redirect('cuentacCbro/show');
        }
        $cuentaCobro->update($input);
        Notify::success("La cuenta de cobro  se modifico con éxito.","Modificacion exitosa");
        return redirect('cuentaCobro/show');
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
