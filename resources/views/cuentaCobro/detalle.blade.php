@extends('layouts.app')
@section('titulo') Detalle cuenta cobro
@endsection
@section('contenedor')
<div class="box">
  <div class="box-header">
    <h2>Pedido</h2>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-4 offset-sm-4">
        {{csrf_field()}}
        <div class="form-group">
            @foreach ($cuentaCobro as $valor)
            @endforeach
          <label>Cuenta Cobro </label>
          <input class="form-control" required="" data-parsley-id="136" type="text" name="id" readonly="" value="{{$cuentaCobro.id}}">
        </div>





        <div class=" p-a text-center">
          <a class="btn btn-info" href="/cuentaCobro/show">Regresar</a>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
