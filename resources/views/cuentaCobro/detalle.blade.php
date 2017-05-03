@extends('layouts.app')
@section('titulo') Detalle cuenta cobro
@endsection
@section('contenedor')
@foreach ($cuentaCobro as $valor)
@endforeach
<form class="" action="" method="post" id="frmDetallePedido">


<div class="box">
  <div class="box-header">

    <h2>Cuenta de cobro: {{$valor->cuentaCobro}}</h2>

  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-12 offset-sm-12">
        {{csrf_field()}}
        <div class="form-group">

          <label>Valor</label>
          <label for="" id="lblValorTotal">{{$valor->valorTotal}}</label>

        </div>
        <div class="box">
          <div class="box-header">
            <h2>Lista de ventas</h2>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-sm-12">
                <table class="table table-striped b-t b-b" id="tblVentas" style="width: 100%;">
                    <input id="_token" name="_token" type="hidden" value="{{csrf_token()}}">
                  <thead>
                    <tr>
                      <th  style="width:20%">#</th>
                      <th  style="width:20%">Número Venta</th>
                      <th  style="width:20%">Número Pedido</th>
                      <th  style="width:20%">Usuario creación</th>
                      <th  style="width:20%">Fecha creación</th>
                      <th  style="width:20%">Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
             $tabla="";
             $acumulador=1;
             foreach ($cuentaCobro as $value) {
               $tabla.='<tr id ="F-'.$acumulador.'" class = "desmarcado">';

               $tabla.='<td>'.$acumulador.' </td>';
               $tabla.='<td>'.$value['numventa'].' </td>';
               $tabla.='<td>'.$value['pedido_id'].' </td>';
               $tabla.='<td>'.$value['empleado_id'].' </td>';
               $tabla.='<td>'.$value['fechaCreacion'].' </td>';
               $tabla.='<td>'.'<a><i class="fa fa-trash" onclick="eliminarVenta(this, '.$acumulador.');" id='.$value['cobroVentaId'].' title="Eliminar" value='.$value['numventa'].'></i></a>';
               $tabla.='</tr>';
               $acumulador++;
             }
             echo $tabla;
             ?>

                  </tbody>
                </table>

              </div>

            </div>
          </div>
        </div>
        <div class=" p-a text-center">
          <a class="btn btn-info" href="/cuentacobro/show">Regresar</a>
          <a href="/cuentacobro/{{$valor->cuentaCobro}}/adicionar" class="btn btn-success " type="button">Agregar venta</a>
          <a target="_blanck" href="/cuentacobro/{{$valor->cuentaCobro}}/pdf" class="btn btn-info " type="button">Exportar PDF</a>
        </div>
      </div>
    </div>
  </div>
</div>
</form>


@endsection
@section('script')
<script type="text/javascript">
function eliminarVenta(e, contador) {
    var id = $(e).attr('id');

    $.ajax({
        url:'/cuentaCobro/eliminarVenta',
        dataType:'json',
        data: {'id':id,
        '_token': $("#_token").val()

    },
    type:'post'
}).done(function(r){
    // $("#valor").val(r.valor);

    if (r.respuesta == 1) {

        new PNotify({
            title: 'Notificación',
            type : 'success',
            text: 'Venta eliminada con éxito',
            icon : false
        })

        $("#F-"+contador).remove();
        $("#lblValorTotal").text(r.valor_total);

    }else if (r.respuesta == 0){
        new PNotify({
            title: 'Notificación',
            type : 'error',
            text: 'Pedido se encuantra en un estado que no se puede aprobar',
            icon : false
        })
    }
});
}

</script>
@endsection
