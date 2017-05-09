@extends('layouts.app')
@section('titulo') Editar usuario
@endsection
@section('contenedor')
<div class="box">
    <div class="box-header">
        <h2>Editar</h2>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-4 offset-sm-4">
                <div class="">
                    {{Form::model($usuarioClinica, ['route' => ['usuario.update',$usuarioClinica->id],'method' => 'put', 'id'=>'frmUsuario'])}}
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$usuarioClinica->id}}">
                    <div class="form-group">
                        <div class="form-group">
                            <label label="Usuario">Usuario</label>
                            {{Form::text('username', $usuarioClinica->username,['class'=>'form-control','readonly'=>'true'])}}

                        </div>

                    </div>
                    <div class="form-group">
                        <label label = "Nombre">Nombre</label>
                        {{Form::text('nombre', $usuarioClinica->nombre,['class'=>'form-control','id'=>"nombre",'tabindex'=>"1"])}}
                    </div>
                    <div class="form-group">
                        <label label = "Contraseña">Contraseña</label>
                        {{Form::input('password','password', null,['class'=>'form-control','id'=>"password",'required'=>"",'tabindex'=>"2"])}}
                    </div>
                    <div class="form-group">
                        <label label = "Confirmar Contraseña">Confirmar contraseña</label>
                        {{Form::input('password','confirmarPassword', null,['class'=>'form-control','id'=>"confirmarPassword",'required'=>"",'tabindex'=>"3"])}}
                    </div>
                    <label>Clinica</label>
                    {{Form::text('nombre_clinica', $usuarioClinica->clinica_nombre,['class'=>'form-control','readonly'])}}
                </div>
                <div class=" p-a text-center">
                    <button type="submit" class="btn btn-warning">Modificar</button>
                    <a href="/usuario/show" type="button" class="btn btn-success">Regresar</a>
                </div>

                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
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
            minlength: 3,
            maxlength: 40
        },
        password: {
            required: true,
            securePassword: true,
            minlength: 8
        },
        confirmarPassword: {
            equalTo: "#password"
        }
    }
});
</script>

@endsection
