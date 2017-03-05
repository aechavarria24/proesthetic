@extends('layouts.app')
@section('titulo') Editar usuario
@endsection
@section('contenedor')
<div class="box">
  <div class="box-header">
    <h2>Editar</h2>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-4 offset-sm-4"
        <div class="form-group">
          <label>Usuario</label>
          {{Form::text('nombre', null,['class'=>'form-control'])}}
          <label>Nombre</label>
          {{Form::text('nombre', null,['class'=>'form-control'])}}
          <label>Clinica</label>
          {{Form::text('nombre', null,['class'=>'form-control'])}}
        </div>
        
        {!! Form::close() !!}
      </div>
      <div class=" p-a text-center">
          <button type="submit" class="btn btn-warning">Modificar</button>
        </div>
    </div>  
  </div>
</div>
@endsection