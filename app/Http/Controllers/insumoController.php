<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\insumo;
use App\Model\insumoproveedor;
use App\Model\proveedor;
use Notify;
use Datatables;

class insumoController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function getData (Request $Request)
    {
        $insumos = insumo::all();
        return Datatables::of($insumos)
        ->addColumn('action', function ($insumo) {
            return '<a href="/insumo/'.$insumo->id.'/edit" class="" title="Editar" ><i class="glyphicon glyphicon-edit"></i>&nbsp;</a>';
        })
        ->addColumn('proveedor', function($insumo){
            $proveedor = proveedor::select("proveedor.*")
            ->join("insumo_proveedor", "proveedor.id", "=", "insumo_proveedor.proveedor_id")
            ->where("insumo_id", $insumo->id)->get();

            $p = "";
            foreach ($proveedor as $key => $value) {
                $p .= "/".$value->nombre."/";
            }
            return $p;
        })
        ->make(true);
    }

    public function index()
    {
        return  view('insumo.index');
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $proveedores = proveedor::all();
        return view ('insumo.crear', compact('proveedores'));
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $input = $request->all();
        $input1 = $request['nombre'];
        $insumos=insumo::create($input);

        foreach ($input['proveedor'] as $key => $value) {
            $input=insumoproveedor::create(["insumo_id"=>$insumos->id,"proveedor_id"=>$value]);
            // var_dump($input);
            // exit;
        }
        Notify::success("El insumo ". $input1. ", se registro con éxito.","Registro exitoso");
        return redirect('insumo/create');
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $insumos = insumo::all();
        return view('insumo.listar');
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $proveedores = proveedor::select("proveedor_id")
        ->join("insumo_proveedor", "proveedor.id", "=", "insumo_proveedor.proveedor_id")
        ->where("insumo_proveedor.insumo_id", "=", $id)
        ->distinct('insumo_proveedor.proveedor_id')
        ->get();


        $insumos = insumo::find($id);
        $proveedor = proveedor::select("proveedor.*")
        ->join("insumo_proveedor", "proveedor.id", "=", "insumo_proveedor.proveedor_id")
        ->where("insumo_id", $id)
        ->get();

        $p = [];
        foreach ($proveedor as $key => $value) {
            $p[] = $value->id;
        }
        $proveedores_select = json_encode($p);
        if ($insumos==null) {
            Notify::warning('No se encontraron datos','Espera...');
            return redirect('/insumo/show');
        } else {
            return view('insumo.editar',compact('insumos','proveedores', 'proveedor'));
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
        $input = $request->all();
        $insumos = insumo::find($id);
        //que machetazo metio puyol
        foreach ($input['proveedor'] as $value) {
            $proveedor= insumoproveedor::select('*')
            ->where('insumo_id',$id)
            ->where('proveedor_id','<>',$value)
            ->delete();

            }

        if ($insumos==null) {
            Notify::warning('No se encontraron datos','Nota: ');
            return redirect('insumo/show');
        }

        foreach ($input['proveedor'] as $value) {
            $proveedor= insumoproveedor::select('*')
            ->where('insumo_id',$id)
            ->where('proveedor_id',$value)
            ->get();


            if (count($proveedor)==0) {

                $variable=insumoproveedor::create(["insumo_id"=>$id,"proveedor_id"=>$value]);
            //insumoproveedor::create(['proveedor_id'=>$input['proveedor'],'insumo_id'=>$id['0']]);
            }
        }
        $insumos->update($input);
        Notify::success("El Insumo \"". $input['nombre'] ."\", se modifico con éxito.","Modificacion exitosa");
        return redirect('insumo/show');

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
