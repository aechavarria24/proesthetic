@extends('layouts.app') @section('titulo') Empleado @endsection @section('contenedor')
<form data-ui-jp="parsley" method="post" action="/empleado" id="frmEmpleado" >
    {{csrf_field()}}
    <div class="padding">
        <div class="box">
            <div class="box-header">
                <h2>Registrar</h2>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-4 offset-sm-2">
                        <div class="form-group">
                            <label class="control-label" label="Nombre">Nombre</label>
                            <input class="form-control" required="" data-parsley-id="136" type="text" name="nombre" id ="nombre" tabindex="1" maxlength="40">
                        </div>

                        <div class="form-group" id = "divUsuario">
                            <label class="control-label" label="Usuario" id = "lblUsuario">Usuario</label>
                            <input class="form-control" required="" data-parsley-id="136" type="text" name="username"  id ="username" tabindex="3" maxlength="45">
                        </div>

                        <div class="form-group">
                            <label class="control-label" label = "Clave">Clave</label>
                            <input class="form-control" required="" data-parsley-id="138" type="password" name="password" id = "password" tabindex="5" maxlength = "20">
                        </div>

                        <div class="form-group">
                            <label class="control-label" label = "Pregunta de seguridad">Pregunta de seguridad</label>
                            <select class="form-control c-select" name="pregunta_empleado_id" tabindex="7">
                                @foreach($preguntas as $value)
                                <option value="{{$value->id}}"> {{$value->pregunta}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" label = "Apellido">Apellido</label>
                            <input class="form-control" required="" data-parsley-id="138" type="text" name="apellido" id="apellido" tabindex="2" maxlength="40">
                        </div>
                        <div class="form-group">
                            <label class="control-label" label = "Rol de usuario">Rol de usuario</label>
                            <select class="form-control c-select" name="rol_id" tabindex="4">
                                @foreach($roles as $value)
                                <option value="{{$value->id}}"> {{$value->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label" label = "Confirmar clave">Confirmar clave</label>
                            <input class="form-control" required="" data-parsley-id="138" type="password" name = "confirmarPassword"id ="confirmarPassword" tabindex="6" maxlength="20">
                        </div>
                        <div class="form-group">
                            <label class="control-label" label = "Respuesta">Respuesta</label>
                            <input class="form-control" required="" data-parsley-id="138" type="password" name="respuesta" id="respuesta" tabindex="8" maxlength="50">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class=" p-a text-center">
                            <input class="form-control" required="" data-parsley-id="136" type="hidden" value ="{{csrf_token()}}"   id ="txToken" >
                            <button type="submit" class="btn info">Registrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
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
            validarEmpleado:true,
            user : true,
            minlength: 3,
            maxlength: 40
        },
        password: {
            required: true,
            securePassword: true,
            minlength: 8,
            maxlength: 20
        },
        confirmarPassword: {
            equalTo: "#password",
            maxlength: 20
        }
    }
});
</script>
@endsection
