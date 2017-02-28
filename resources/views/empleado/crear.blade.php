@extends('layouts.app') @section('titulo') Usuario @endsection @section('contenedor')
<form data-ui-jp="parsley" novalidate="" method="post" action="/usuario">
  {{csrf_field()}}
  <div class="padding">
    <div class="box">
      <div class="box-header">
        <h2>Registrar</h2>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-sm-4 offset-sm-2">
            <div class="form-group">
              <label>Cedula</label>
              <input class="form-control" required="" data-parsley-id="136" type="text" name="cedula">
            </div>
              <div class="form-group">
                <label>Nombre</label>
                <input class="form-control" required="" data-parsley-id="136" type="text" name="nombre">
              </div>
              <div class="form-group">
                <label>Apellido</label>
                <input class="form-control" required="" data-parsley-id="138" type="text" name="apellido">
              </div>
              <div class="form-group">
                <label>Nombre de la Clínica</label>
                <select class="form-control c-select" name="clinica_id">
                  @foreach($clinica as $value)
                  <option value="{{$value->id}}"> {{$value->nombre}}</option>
                  @endforeach
                </select>
              </div>

          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Usuario</label>
              <input class="form-control" required="" data-parsley-id="136" type="text" name="usuario">
            </div>
            <div class="form-group">
              <label>Rol de usuario</label>
              <select class="form-control c-select" name="rol_id">
                @foreach($roles as $value)
                <option value="{{$value->id}}"> {{$value->nombre}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Clave</label>
              <input class="form-control" required="" data-parsley-id="138" type="password" name="password">
            </div>
            <div class="form-group">
              <label>Confirmar clave</label>
              <input class="form-control" required="" data-parsley-id="138" type="password" name="password_1">
            </div>
            <div class="form-group">
              <label>Pregunta de seguridad</label>
              <select class="form-control c-select" name="pregunta_id">
                @foreach($preguntas as $value)
                <option value="{{$value->id}}"> {{$value->pregunta}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Respuesta</label>
              <input class="form-control" required="" data-parsley-id="138" type="password" name="respuesta">
            </div>
          </div>
          <div class="col-sm-12">
            <div class=" p-a text-center">
              <button type="submit" class="btn info">Registrar</button>
            </div>
          </div>
        </div>
      </div>
    </div>







  </div>
</form>

@endsection
