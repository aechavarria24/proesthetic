@extends('layouts.app')
@section('titulo') Editar clinica
@endsection
@section('contenedor')
<div class="box">
  <div class="box-header">
    <h2>Editar</h2>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-4 offset-sm-4">
        {{Form::model($clinica, ['route' => ['clinica.update',$clinica->id],'method' => 'put'])}}

        <div class="form-group">
          <label>Nombre</label>
          {{Form::text('nombre', null,['class'=>'form-control'])}}
        </div>
        <div class="form-group">
          <label>Telefono</label>
          {{Form::text('telefono', null,['class'=>'form-control'])}}
        </div>
        <div class="form-group">
          <label>Dirección</label>
          {{Form::text('direccion', null,['class'=>'form-control'])}}
        </div>
          <div class="form-group">
                <label>Tipo Contrato</label>
                <select class="form-control c-select" name="tipo_contrato_id">
                 @foreach($tipoContrato as $values)
                  <option value="{{$values->id}}"> {{$values->nombre}}</option>
                  @endforeach
                </select>
              </div>
        
        <div class=" p-a text-center">
          <button type="submit" class="btn btn-warning">Modificar</button>
           <a href="/clinica/show" class="btn btn-info" type="button">Salir</a>
        </div>

        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
