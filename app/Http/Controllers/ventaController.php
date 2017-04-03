<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\venta;
use Datatables;

class ventaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function detalle(){

        return view('venta.detalleVenta');

     }


     public function getData (Request $Request)
     {
       $venta = venta::all();
       return Datatables::of($venta)
       ->addColumn('action', function ($venta) {
         return '<a href="/venta/'.$venta->id.'/edit" class="btn btn-xs "><i class="glyphicon glyphicon-edit"></i>&nbsp;</a>
         <a href="/venta/'.$venta->id.'/detalle" class="btn btn-xs ">&nbsp;Detalle</a>';
       })
       ->addColumn('seletion', "")
       ->make(true);
     }



    public function index()
    {
      return redirect('venta/show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('venta.detalleVenta');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $venta = venta::all();
      return view('venta.listar');
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
}
