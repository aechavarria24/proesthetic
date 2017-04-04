
@extends('layouts.app') @section('titulo') Proveedor @endsection @section('contenedor')
<div class="box">
  <div class="box-header">
    <h2>Registrar</h2>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-4 offset-sm-4">
        <form data-ui-jp="parsley" novalidate="" method="post" action="/proveedor" id="frmproveedor">
          {{csrf_field()}}
          <div class="form-group">
            <label>Nombre</label>
            <input class="form-control" required="" data-parsley-id="136" type="text" name="nombre" id="nombre">
          </div>
          <div class="form-group">
            <label>Telefono</label>
            <input class="form-control" required="" data-parsley-id="136" type="text" name="telefono" id="telefono">
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

$("#frmproveedor").validate({
  rules: {
    nombre: {
      required: true
    },
    telefono: {
      required: true

    }

  }
});

</script>
@endsection
