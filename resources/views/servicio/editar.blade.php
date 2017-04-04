@extends('layouts.app')
@section('titulo') Editar servicio
@endsection
@section('contenedor')
<div class="box">
  <div class="box-header">
    <h2>Editar</h2>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-4 offset-sm-4">
        {{Form::model($servicios, ['route' => ['servicio.update',$servicios->id],'method' => 'put'])}}

        <div class="form-group">
          <label>Nombre</label>
          {{Form::text('nombre', null,['maxlength'=>'50','class'=>'form-control'])}}
        </div>
        <div class="form-group">
          <label>Descripción</label>
          {{Form::textarea('descripcion', null,['class'=>'form-control'])}}

          <!-- <textarea name="descripcion" class="form-control" rows="8" cols="80"></textarea> -->
        </div>
        <div class=" p-a text-center">
          <button type="submit" class="btn btn-warning">Modificar</button>
          <a href="/servicio/show" class="btn btn-primary">Volver</a>
        </div>
        {!! Form::close() !!}
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
