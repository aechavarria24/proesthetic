@extends('layouts.app')
@section('titulo') Editar Insumo
@endsection
@section('contenedor')
<div class="box">
  <div class="box-header">
    <h2>Editar</h2>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-4 offset-sm-4">
        {{Form::model($insumos, ['route' => ['insumo.update',$insumos->id],'method' => 'put'])}}

        <div class="form-group">
          <label>Nombre</label>
          {{Form::text('nombre', null,['class'=>'form-control'])}}
        </div>
        <div class="form-group">
          <label>Unidad de Medida</label>
          {{Form::text('unidadMedida', null,['class'=>'form-control'])}}
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
          <button type="submit" class="btn btn-warning">Modificar</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
var sproveedor = $("#proveedor").select2();
sproveedor.val(<?= $proveedores_select ?>).trigger("change");
$("#frmInsumo").validate({
  rules: {
    nombre: {
      required: true,
      minlength: 5
    }
  }
});

</script>
@endsection
