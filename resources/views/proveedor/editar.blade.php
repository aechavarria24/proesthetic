@extends('layouts.app')
@section('titulo') Editar Proveedor
@endsection
@section('contenedor')
<div class="box">
  <div class="box-header">
    <h2>Editar</h2>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-4 offset-sm-4">
        {{Form::model($proveedor, ['route' => ['proveedor.update',$proveedor->id],'method' => 'put', 'id'=>'frmProveedor'])}}

        <div class="form-group">
          <label label = "Nombre">Nombre</label>
          {{Form::text('nombre', null,['class'=>'form-control'])}}
      </div>
        <div class="form-group">
          <label label ="Télefono">Télefono</label>
          {{Form::text('telefono', null,['class'=>'form-control'])}}

          <!-- <textarea name="descripcion" class="form-control" rows="8" cols="80"></textarea> -->
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
$("#frmProveedor").validate({
    errorElement: 'span',
    errorPlacement: function(error, e) {
        let label = jQuery(e).parents('.form-group').find("label").attr("label");
        jQuery(e).parents('.form-group').find("label").text(label+". ").append(error);
    },
    highlight: function(e) {
        var elem = jQuery(e);
        elem.closest('.form-group').removeClass('has-error').addClass('has-error');
        elem.closest('.help-block').remove();
    },
    success: function(e) {
        var elem = jQuery(e);
        elem.closest('.form-group').removeClass('has-error').addClass('has-success');
        elem.closest('.help-block').remove();
    },
    rules: {
        nombre :{
            required: true,
            lettersAndNumbers : true,
            minlength: 3,
            maxlength: 40
        },
        telefono: {
            required: true,
            digits : true,
            minlength: 8,
            maxlength: 40
        }
    }
});
</script>
@endsection
