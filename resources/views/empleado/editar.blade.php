@extends('layouts.App')
@section('titulo') Editar empleado
@endsection
@section('contenedor')
<div class="box">
    <div class="box-header">
        <h2>Editar</h2>
    </div>
    <div class="box-body">
        {{Form::model($empleado, ['route' => ['empleado.update',$empleado->id],'method' => 'put', 'id'=>'frmEmpleado'])}}
        <div class="padding">
            <div class="row">
                <div class="col-sm-6">
                    <div class="box">
                        <div class="box-header">
                            Información de usuario
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Usuario</label>
                                        {{Form::text('username', $empleado->username, ['class'=>'form-control', 'disabled' => 'disabled'])}}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Rol</label>
                                        {{Form::select('rol_id', $roles, null, ['class'=>'form-control'])}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="box">
                        <div class="box-header">
                            Información personal
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label label = "Nombre">Nombre</label>
                                        {{Form::text('nombre', $empleado->nombre,['class'=>'form-control'])}}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label label ="Apellido">Apellido</label>
                                        {{Form::text('apellido', $empleado->apellido,['class'=>'form-control'])}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class=" p-a text-center">
                        <button type="submit" class="btn btn-warning">Modificar</button>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
@section('script')
<script>
$("#frmEmpleado").validate({
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
        apellido: {
            required: true,
            personName : true,
            minlength: 3,
            maxlength: 40
        },
        username: {
            required: true,
            minlength: 3,
            maxlength: 40
        }
    }
});
</script>

@endsection
