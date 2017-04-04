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
                <form data-ui-jp="parsley" novalidate="" method="post" action="/servicio" id="frmServicio" onsubmit="return registrar_servicio()">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label label = "Nombre" id = "lblNombre" >Nombre</label>
                        <input class="form-control" required="" data-parsley-id="136" type="text" name="nombre" id="txtNombre" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label label = "Descripción" id  = "lblDescripcion">Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="8" cols="80"></textarea>
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

function registrar_servicio(){
    var validar = false;
    $.ajax({
        type : 'POST',
        datatype : 'json',
        data : {"_token" : $("#_token").val() , id : $("#txtNombre").val() },
        url : '/servicio/validar_servicio',
        async : false
    }).done(function(result){
        if (result.respuesta == 1) {
            $("#lblNombre").css("color", "red");
            //$("#lblNombre").css("border", "1px solid red");
            $("#lblNombre").text("Nombre, servicio ya existe(*)");
            validar = false;
        }else{
            $("#lblNombre").css("color", "");
            $("#lblNombre").css("border", "");
            $("#lblNombre").text("Nombre");
            validar = true;
        }

    });
    return validar;
}

$("#txtNombre").change(function(){
    return registrar_servicio();
});

</script>
@endsection
