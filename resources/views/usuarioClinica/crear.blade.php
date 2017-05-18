@extends('layouts.App') @section('titulo') Usuario @endsection @section('contenedor')
    <form data-ui-jp="parsley" novalidate="" method="post" action="/usuario" id = "frmUsuario">
        {{csrf_field()}}
        <div class="padding">
            <div class="box">
                <div class="box-header">
                    <h2>Registrar</h2>
                </div>
                <input type="hidden" name="token" id="token" value="{{csrf_token()}}">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-4 offset-sm-2">
                            <div class="form-group">
                                <label label="Nombre">Nombre</label>
                                <input class="form-control" required="" data-parsley-id="136" type="text" name="nombre" tabindex="1">
                            </div>

                            <div class="form-group">
                                <label label="Usuario">Usuario</label>
                                <input class="form-control" required="" data-parsley-id="136" type="text" name="username" id ="username" tabindex="3">
                            </div>
                            <div class="form-group">
                                <label label="Correo electrónico">Correo electrónico</label>
                                <input class="form-control" required="" data-parsley-id="138" type="text" name="email" id="email" maxlength="50" minlength="10" tabindex="5">
                            </div>
                            <div class="form-group">
                                <label label="Clave">Clave</label>
                                <input class="form-control" required="" data-parsley-id="138" type="password" name="password" tabindex="7">
                            </div>
                            <div class="col-sm-12">
                                <div class=" p-a text-center">
                                    <input type="hidden" value = "{{csrf_token()}}" name ="_token" id ="_token" >
                                    <button type="submit" class="btn info">Registrar</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label Label="Apellido">Apellido</label>
                                <input class="form-control" required="" data-parsley-id="138" type="text" name="apellido" tabindex="2">
                            </div>
                            <div class="form-group">
                                <label labe="Rol de Usuario">Rol de usuario</label>
                                <select class="form-control c-select" name="rol_id" tabindex="4">
                                    @foreach($roles as $value)
                                        @if ($value->nombre == "Doctor")
                                            <option value="{{$value->id}}">{{$value->nombre}}</option>
                                        @endif

                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label Label="Nombre de la Clínica">Nombre de la Clínica</label>
                                <select class="form-control c-select" name="clinica_id" tabindex="6">
                                    @foreach($clinica as $clinica)
                                        <option value="{{$clinica->id}}">{{$clinica->nombre}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label label="Confirma clave">Confirmar clave</label>
                                <input class="form-control" required="" data-parsley-id="138" type="password" name="clave_1" tabindex="8">
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
    $("#username1").change(function(){
        $.ajax({
            url : '/usuarioClinica/validar_usuario',
            datatype : 'json',
            data : { usuario : $("#username").val(),
            "_token":$("#token").val() },
            type : 'post',
        }).done(function(r){
            if(r.respuesta==1) {
                $("#lblUsuario").css("color", "red");
                $("#username").css("border", "1px solid red");
                $("#lblUsuario").text("Usuario, Usuario ya existe(*)");
            }else{

                $("#lblUsuario").css("color", "");
                $("#username").css("border", "");
                $("#lblUsuario").text("Usuario");
            }

        });
    });
    $("#frmUsuario").validate({
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
                validarUsuario : true,
                minlength: 3,
                maxlength: 40
            },
            email : {
                required: true,
                email: true,
                validarEmailDoctor: true,
                minlength: 10
            },
            password: {
                required: true,
                securePassword : true,
                minlength: 8
            },
            confirmarPassword: {
                equalTo: "#password"
            }
        }
    });
    </script>
@endsection
