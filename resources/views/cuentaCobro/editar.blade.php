@extends('layouts.app')
@section('titulo') Editar Cuenta De Cobro
@endsection
@section('contenedor')
<div class="box">
  <div class="box-header">
    <h2>Editar</h2>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-4 offset-sm-4">
        {{Form::model($cuentaCobro, ['route' => ['cuentacobro.update',$cuentaCobro->id],'method' => 'put'])}}
      
        <div class="form-group">
          <label>Valor</label>
          {{Form::text('valorTotal', null,['class'=>'form-control'])}}
        </div>

        <div class=" p-a text-center">
          <button type="submit" class="btn btn-warning">Modificar</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
