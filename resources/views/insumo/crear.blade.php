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
                        <label label = "Nombre">Nombre</label>
                        <input class="form-control" required="" data-parsley-id="136" type="text" name="nombre" id="nombre" maxlength="40">
                    </div>
                    <div class="form-group">
                        <label label ="Unidad de Medida">Unidad de Medida</label>
                        <input class="form-control" required="" data-parsley-id="136" type="text" name="unidadMedida" id="unidadMedida" maxlength="10">
                    </div>
                    <div class="form-group">
                        <label label ="Proveedor" >Proveedor</label>
                        <select  class="form-control c-select"   name="proveedor[]"  multiple="multiple" required id="proveedor">
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
        unidadMedida: {
            required: true,
            lettersonly : true,
            minlength: 4,
            maxlength: 10
        },
        proveedor: {
            required: true
        }
    }
});
</script>
@endsection
