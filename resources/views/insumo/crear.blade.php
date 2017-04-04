@extends('layouts.app') @section('titulo') Insumo @endsection @section('contenedor')
<div class="box">
  <div class="box-header">
    <h2>Registrar</h2>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-4 offset-sm-4">
        <form data-ui-jp="parsley" novalidate="" method="post" action="{{ route('insumo.store') }}" id="frmInsumo">
          {{csrf_field()}}
          <br>
          <div class="form-group">
            <label>Nombre</label>
            <input class="form-control" required="" data-parsley-id="136" type="text" name="nombre" id="nombre">
          </div>
          <div class="form-group">
            <label>Unidad de Medida</label>
            <input class="form-control" required="" data-parsley-id="136" type="text" name="unidadMedida">
          </div>
          <div class="form-group">
            <label>Proveedor</label>
            <select  class="form-control c-select"   name="proveedor[]"  multiple="multiple" id="proveedor">
              @foreach($proveedores as $values)
              <option value="{{$values->id}}"> {{$values->nombre}}</option>
              @endforeach
            </select>
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
  $("#proveedor").select2();
$("#frmInsumo").validate({
  rules: {
    nombre: {
      required: true

    }

  }
});

</script>
@endsection
