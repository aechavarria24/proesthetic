@extends('layouts.app')
@section('titulo')
Usuario
@endsection
@section('contenedor')
<div class="padding">
  <div class="row">
    <div class="col-sm-3">
      <div class="box">
        <div class="box-header">
          <a name="button" class="btn btn-link" href="/usuario/create">Crear</a>
        </div>
      </div>
    </div>
    <div class="col-sm-3">
        <div class="box">
          <div class="box-header">
            <a name="button" class="btn btn-link" href="usuario/show">Listar</a>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection
