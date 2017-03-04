@extends('layouts.app')
@section('titulo') Detalle orden de producción
@endsection
@section('contenedor')
<div class="box">
  <div class="box-header">
    <h2>Orden de producción</h2>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-4 offset-sm-4">
        {{csrf_field()}}
        <div class="form-group">
          <label>Número orden </label>
          <input class="form-control" required="" data-parsley-id="136" type="text" name="id" readonly="">
        </div>
        <div class="form-group">
          <label>usuario creación</label>
          <input class="form-control" required="" data-parsley-id="136" type="text" name="idusuario" readonly="">
        </div>
        <div class="form-group">
          <label>Observación</label>
          <textarea class="form-control"  data-parsley-id="136" type="text" name="observacion" readonly=""> </textarea>
        </div>
        <div class="form-group">
          <label>Número Pedido</label>
          <input class="form-control" required="" data-parsley-id="136" type="text" name="pedidoid" readonly="">
        </div>

        <div class=" p-a text-center">
          <a class="btn btn-info" href="/produccion">Regresar</a>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
