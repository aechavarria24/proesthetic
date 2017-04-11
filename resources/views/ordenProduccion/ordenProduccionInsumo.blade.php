@extends('layouts.app') @section('titulo') Insumo Orden De Produccion @endsection @section('contenedor')

<div class="Pading">
  <div class="box">
    <div class="box-header" style="text-align: center;">
      <h2>Asociar Insumos</h2>
    </div>
    <div class="box-body">
      <div class="row">

        <div class="col-sm-5 offset-sm-1 ">
          {{Form::model($pedido,[])}}
          <br>
          <div class="form-group">
            <label>Pedido</label>
            {{Form::text('jhkjh ', $pedido[0]["idt"],['class'=>'form-control', 'readonly'])}}

          </div>
          <div class="form-group">
            <label>Orden de Producción</label>
            {{Form::text('telefono', $pedido[0]["idp"],['class'=>'form-control', 'readonly'])}}
          </div>
          <div class="box">

            <div class="box-body">
              <div class="form-inline">

                <div class="form-group">
                  <label>Insumos</label>
                  <select class="form-control c-select" name="insumo_id" id="insumo_id">
                    <option value="">Seleccionar</option>
                    @foreach($insumoProduccion as $value)
                    <option value="{{ $value->id }}">{{ $value->nombre }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label class="sr-only" for="exampleInputEmail2">Cantidad</label>
                  <input class="form-control" id="cantidad" placeholder="Cantidad" type="text">
                </div>
                &nbsp;
                &nbsp;
                <div class="form-group">
                  <button id=¨"btnagregar" type ="button" onclick="addInsumo()" class="btn btn-icon white">
                    <i class="fa fa-plus"></i>
                  </button>
                </div>

              </div>
              <br>
              <div class="box-divider m-a-0"></div>

            </div><br>
            <div class="">
              <table class="table table-striped b-t">
                <thead>
                  <tr>
                    <th>Insumo</th>
                    <th>Cantidad</th>
                  </tr>
                </thead>
                <tbody id ="tbl_asociar_insumo"></tbody>
              </table>
            </div>
          </div>

          <div class=" p-a text-center">
            <input type = "hidden" value ="{{csrf_token()}}" id="_token" name = "_token"/>
            <button type="submit" class="btn info">Asociar Insumos</button>
          </div>
          {!! Form::close()!!}
        </div>

        <div class="col-sm-6">

          <div style = "padding-top: 2%;">
            <div class="form-group">
              <label>Medidas de la pieza $nombre_pieza</label>
              <table class="table table-striped b-t">
                <thead>
                  <tr>
                    <th>Cantidad</th>
                    <th>Dimensión</th>
                    <th>Unidad de medida</th>
                  </tr>
                </thead>
                <tbody id="t-'+id_pieza+'">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script type ="text/javaScript">

  $(function(){
    $.ajax({
      data : "GET",
      dataType : "JSON",
      data : {
       // _token : $("#_token").val()
     },
     url : "/insumo/eliminar_tabla_asociar"
   });
  });

  $("#insumo").select2();
  $("#frmInsumoOrdenProduccion").validate({
    rules: {
      nombre: {
        required: true,
        minlength: 5
      }
    }
  });


  function addInsumo(){
    insumo = $("#insumo_id").val()
    cantidad = $("#cantidad").val()

    $.ajax({
      type:'get',
      dataType:'json',
      url:'/insucant/addInsumo',
      data : {
        insumo : insumo,
        cantidad : cantidad,
        _token : $("#_token").val()
      }

    }).done(function(r){
        $("#tbl_asociar_insumo").empty();
       $.each(r, function(i, v){
        $("#tbl_asociar_insumo").append("<tr><td>"+v.insumo+"</td><td>"+v.cantidad+"</td></tr>");
      });



   })
  }



</script>
@endsection