@extends('layouts.app')
@section('titulo') Detalle pedido
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
            @foreach ($pedido as $valor)
            @endforeach
          <label>Número pedido </label>
          <input class="form-control" required="" data-parsley-id="136" type="text" name="id" readonly="" value="{{$valor->id}}">
        </div>
        <div class="form-group">
          <label>Clinica</label>
          <input class="form-control" required="" data-parsley-id="136" type="text" name="idusuario" readonly="" value="{{$valor->nombre}}">
        </div>
        <div class="form-group">
          <label>Fecha entrega</label>
          <input class="form-control" required="" data-parsley-id="136" type="text" name="pedidoid" readonly="" value="{{$valor->fechaEntrega}}">
        </div>
        <div class="form-group">
          <label>Paciente</label>
          <input class="form-control" required="" data-parsley-id="136" type="text" name="pedidoid" readonly="" value="{{$valor->pacienteNombre}}">
        </div>
        <div class="form-group">
          <label>Cedula paciente</label>
          <input class="form-control" required="" data-parsley-id="136" type="text" name="pedidoid" readonly="" value="{{$valor->cedula}}">
        </div>
        <div class="form-group">
          <label>Estado Pedido</label>
          <input class="form-control" required="" data-parsley-id="136" type="text" name="pedidoid" readonly="" value="{{$valor->estadoPedido}}">
        </div>
        <div class=" p-a text-center">
          <a class="btn btn-info" href="/pedido/show">Regresar</a>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
