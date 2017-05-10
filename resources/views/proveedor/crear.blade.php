
@extends('layouts.App') @section('titulo') Proveedor @endsection @section('contenedor')
<div class="box">
    <div class="box-header">
        <h2>Registrar</h2>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-4 offset-sm-4">
                <form data-ui-jp="parsley" novalidate="" method="post" action="/proveedor" id="frmProveedor">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label label = "Nombre">Nombre</label>
                        <input class="form-control" required="" data-parsley-id="136" type="text" name="nombre" id="nombre" maxlength="45">
                    </div>
                    <div class="form-group">
                        <label label ="Télefono">Télefono</label>
                        <input class="form-control" required="" data-parsley-id="136" type="text" name="telefono" id="telefono" maxlength="15">
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
            personName : true,
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
