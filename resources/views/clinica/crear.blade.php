@extends('layouts.app')

@section('titulo')

Clínica

@endsection

@section('contenedor')

<div class="box">
    <div class="box-header">
        <h2>Registrar</h2>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-4 offset-sm-4">
                <form data-ui-jp="parsley" novalidate="" method="post" action="/clinica" id="frmclinica">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label label = "NIT">NIT</label>
                        <input class="form-control" required="" data-parsley-id="136" type="text" name="NIT" maxlength="10" id="NIT">
                    </div>
                    <div class="form-group">
                        <label label = "Nombre">Nombre</label>
                        <input class="form-control" required="" data-parsley-id="136" type="text" name="nombre" id = "nombre" maxlength="40">
                    </div>
                    <div class="form-group">
                        <label label = "Dirección">Dirección</label>
                        <input class="form-control" required="" data-parsley-id="138" type="text" name="direccion" id="direccion">
                    </div>
                    <div class="row m-b">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label label = "Teléfono">Teléfono</label>
                                <input class="form-control" required="" data-parsley-id="138" type="phone" name="telefono" id="telefono">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label label = "Tipo Contrato">Tipo Contrato</label>
                            <select class="form-control c-select" name="tipo_contrato_id">
                                @foreach($tipoContrato as $values)
                                <option value="{{$values->id}}"> {{$values->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row m-b">
                        <div class="col-sm-6">
                            <label label = "Fecha de Corte">Fecha de Corte</label>
                            <input class="form-control" required="" name= "diaCorte"  id= "diaCorte"  type="number"><br>
                        </div>
                        <div class=" p-a text-center">
                            <button type="submit" class="btn info">Registrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
$("#frmclinica").validate({
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
            minlength: 3,
            maxlength: 40
        },
        NIT :{
            required: true,
            minlength: 10,
            maxlength: 10
        },
        direccion: {
            required: true,
            minlength: 3,
            maxlength: 20
        },
        telefono: {
            required: true,
            minlength: 8,
            maxlength: 40
        },
        diaCorte : {
            required: true,
            minlength: 1,
            maxlength: 2
        }
    }
});


</script>

@endsection
