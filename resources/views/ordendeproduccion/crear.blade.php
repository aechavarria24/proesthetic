@extends('layouts.app') @section('titulo') Orden de produccion @endsection @section('contenedor')
<form data-ui-jp="parsley" novalidate="" method="post" action="/ordendeproduccion">
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
              <label>Usuario</label>
              <select class="form-control c-select" name="clinica_id">

              </select>
            </div>
            <div class="form-group">
              <label>Pedido</label>
              <select class="form-control c-select" name="clinica_id">

              </select>
            </div>
            <div class="form-group">
              <label>Descripción</label>
              <textarea name="descripcion" class="form-control" rows="8" cols="80"></textarea>
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
