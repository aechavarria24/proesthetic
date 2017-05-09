@extends('layouts.app')
@section('titulo') Editar clinica
@endsection
@section('contenedor')
<div class="box">
    <div class="box-header">
        <h2>Editar</h2>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-4 offset-sm-4">
                {{Form::model($clinica, ['route' => ['clinica.update',$clinica->id],'method' => 'put', 'id'=>'frmclinica'])}}

                <div class="form-group">
                    <label label = "Nombre">Nombre</label>
                    {{Form::text('nombre', null,['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label label = "Télefono">Télefono</label>
                    {{Form::text('telefono', null,['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label label ="Dirección">Dirección</label>
                    {{Form::text('direccion', null,['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label>Tipo Contrato</label>
                    <select class="form-control c-select" name="tipo_contrato_id">
                        @foreach($tipoContrato as $values)
                        <option value="{{$values->id}}"> {{$values->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label label ="Día de corte">Día de corte</label>
                    {{Form::text('diaCorte', null,['class'=>'form-control', 'maxlength'=>'2'])}}
                </div>

                <div class=" p-a text-center">
                    <button type="submit" class="btn btn-warning">Modificar</button>
                    <a href="/clinica/show" class="btn btn-info" type="button">Salir</a>
                </div>

                {!! Form::close() !!}
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
            lettersAndNumbers : true,
            minlength: 3,
            maxlength: 40
        },
        direccion: {
            required: true,
            address: true,
            minlength: 3,
            maxlength: 20
        },
        telefono: {
            required: true,
            digits : true,
            minlength: 8,
            maxlength: 40
        },
        diaCorte : {
            required: true,
            digits : true,
            minlength: 1,
            maxlength: 2
        }
    }
});
</script>
@endsection
