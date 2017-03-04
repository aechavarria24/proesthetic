@extends('layouts.app') @section('titulo') Contrato @endsection @section('contenedor')
<div class="box">
  <div class="box-header">
    <h2>Registrar</h2>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-4 offset-sm-4">
        <form data-ui-jp="parsley" novalidate="" method="post" action="/contrato" id="frmContrato">
          {{csrf_field()}}
          <div class="form-group">
            <label>Nombre</label>
            <input class="form-control" required="" data-parsley-id="136" type="text" name="nombre" id="nombre">
          </div>
          <div class="form-group">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control" rows="8" cols="80"></textarea>
          </div>
          <div class=" p-a text-center">
            <button type="submit" class="btn info">Registrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


@endsection
@section('script')
<script>
$("#frmContrato").validate({
  rules: {
    nombre: {
      required: true,
      minlength: 3
    }
  }
});

</script>
@endsection
