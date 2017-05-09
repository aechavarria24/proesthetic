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
                {{Form::model($insumos, ['route' => ['insumo.update',$insumos->id],'method' => 'put', 'id'=>'frmInsumo'])}}

                <div class="form-group">
                    <label label ="Nombre">Nombre</label>
                    {{Form::text('nombre', null,['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label label ="Unidad de Medida">Unidad de Medida</label>
                    {{Form::text('unidadMedida', null,['class'=>'form-control'])}}
                </div>
                <div class="form-group">

                    <label label = "Proveedor">Proveedor</label>
                    <select  class="form-control c-select" required  name="proveedor[]"  multiple="multiple" id="proveedor">
                        @foreach($proveedor as $value)
                        <option value="{{$value->id}}" selected=""> {{$value->nombre}}</option>
                        @endforeach
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
