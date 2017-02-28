@extends('layouts.app')
@section('titulo') Relacion de valor de servicio y contrato
@endsection
@section('contenedor')
<div class="box">
  <div class="box-header">
    <h2>Registrar</h2>
  </div>
  <div class="box-body">
    <div class="row">
      <div style="padding-top: 5%;">
        <div class="col-sm-6 offset-sm-4">
          <form data-ui-jp="parsley" novalidate="" method="post" action="/contrato">
            {{csrf_field()}}
            <div class="col-sm-8">
              <div class="form-group">
                <label>Servicio</label>
                <select class="form-control c-select" name="tipo_contrato_id">
                  @foreach($servicio as $values)
                  <option value="{{$values->id}}"> {{$values->nombre}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-sm-8">
              <div class="form-group">
                <label>Tipo Contrato</label>
                <select class="form-control c-select" name="tipo_contrato_id">
                  @foreach($tipoContrato as $values)
                  <option value="{{$values->id}}"> {{$values->nombre}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class=" col-sm-8">
              <div class="form-group">
                <label>Valor</label>
                <input type="text" name="valor" value="" class="form-control" placeholder="Valor del servicio" required="">
              </div>
            </div>
            <div class="col-sm-8">
              <div class=" p-a text-center">
                <button type="submit" class="btn info">Registrar</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
