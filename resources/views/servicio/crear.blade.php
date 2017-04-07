@extends('layouts.app')
@section('titulo') Servicio
@endsection
@section('contenedor')
<div class="box">
    <div class="box-header">
        <h2>Registrar</h2>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-4 offset-sm-4">
                <form data-ui-jp="parsley" novalidate="" method="post" action="/servicio" id="frmServicio">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label label = "Nombre" id = "lblNombre" >Nombre</label>
                        <input class="form-control" required="" data-parsley-id="136" type="text" name="nombre" id="nombre" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label label = "Descripción" id  = "lblDescripcion">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" rows="8" cols="80"></textarea>
                    </div>
                    <div class=" p-a text-center">
                        <input id ="_token" name = "_token" type="hidden" value = "{{ csrf_token() }}"   >
                        <button type="submit" class="btn info">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type = "text/javascript">

$("#frmServicio").validate({
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
            validarServicio : true,
            minlength: 3,
            maxlength: 40
        },
        descripcion :{
            required: true,
            lettersAndNumbers : true,
            minlength: 3,
            maxlength: 40
        }
    }
});
</script>
@endsection
