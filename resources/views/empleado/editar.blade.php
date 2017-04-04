@extends('layouts.app')
@section('titulo') Editar empleado
@endsection
@section('contenedor')
<div class="box">
  <div class="box-header">
    <h2>Editar</h2>
  </div>
  <div class="box-body">
    {{Form::model($empleado, ['route' => ['empleado.update',$empleado->id],'method' => 'put'])}}
    <div class="padding">
      <div class="row">
        <div class="col-sm-6">
          <div class="box">
            <div class="box-header">
              Información de usuario
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Usuario</label>
                    {{Form::text('username', $empleado->username, ['class'=>'form-control', 'disabled' => 'disabled'])}}
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Rol</label>
                    {{Form::select('rol_id', $roles, null, ['class'=>'form-control'])}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="box">
            <div class="box-header">
              Información personal
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Nombre</label>
                    {{Form::text('nombre', $empleado->nombre,['class'=>'form-control'])}}
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Apellido</label>
                    {{Form::text('apellido', $empleado->apellido,['class'=>'form-control'])}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-8 offset-sm-2">
          <div class="box">
            <div class="box-header">
              Seguridad
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Pregunta de seguridad</label>
                    {{Form::text('apellido', $pregunta->pregunta,['class'=>'form-control', 'disabled'=>'disabled'])}}
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Respuesta</label>
                    {{Form::input('password','respuesta',$empleado->respuesta,['class'=>'form-control', 'disabled'=>'disabled'])}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12">
          <div class=" p-a text-center">
            <button type="submit" class="btn btn-warning">Modificar</button>
          </div>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection
