@extends('layouts.App')
@section('titulo')
Cuenta de cobro: <b>{{$cuentaCobro->id}}</b>
@endsection
@section('contenedor')
<form class="" action="/agregar_venta" method="post">
  {{csrf_field()}}
  <input type="hidden" name="id" value="{{$cuentaCobro->id}}">

<div class="box">
  <div class="box-header">
    <h2>Lista de ventas</h2>
  </div>
  <div class="box-header">

  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-12">
        <table class="table table-striped b-t b-b" id="tblVentas" style="width: 100%;">
          <thead>
            <tr>
              <th  style="width:1%">Selección</th>
              <th  style="width:20%">Número Venta</th>
              <th  style="width:20%">Número Pedido</th>
              <th  style="width:20%">Usuario creación</th>
              <th  style="width:20%">Fecha creación</th>

            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
        <div class=" p-a text-center">
          <button type="submit" class="btn btn-primary">Agregar venta</button>
          <a type="button" href="/cuentacobro/show" class="btn btn-success">Regresar</a>
        </div>

      </div>

    </div>
  </div>
</div>

</form>
@endsection
@section ('script')
<script type="text/javascript">
$('#tblVentas').DataTable({
  processing: true,
  serverSide: true,
  "language": {
    "url": "/plugins/dataTables/Spanish.json"
  },
  ajax: '/venta/get',
  columns: [
    {data: 'seletion', name: 'seletion'},
    {data: 'id', name: 'id'},
    {data: 'pedido_id', name: 'pedido_id'},
    {data: 'empleado_id', name: 'empleado_id'},
    {data: 'created_at', name: 'created_at'},

  ],  "fnRowCallback": function(nRow, aData, iDisplayIndex) {

        if (aData.nombre != "Asociada") {
            var opciones = $('td:eq(0)', nRow);
            let html = '<input class="form-control" type="checkbox"  name="s[]" value="'+aData.id+'" />';
            opciones.html(html);

        }
}});
</script>
@endsection
