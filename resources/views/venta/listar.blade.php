@extends('layouts.app')
@section('titulo')
Venta
@endsection
@section('contenedor')
<form class="" action="/venta" method="post">
  {{csrf_field()}}

<div class="box">
  <div class="box-header">
    <h2>Lista de ventas</h2>
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
              <th  style="width:20%">Estado</th>
              <th  style="width:20%">Opciones</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
        <div class=" p-a text-center">
          <button type="submit" class="btn btn-primary">Generar cuenta de cobro</button>
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
    {data: 'username', name: 'username'},
    {data: 'created_at', name: 'created_at'},
    {data: 'nombre', name: 'nombre'},
    {data: 'action', name: 'action', orderable: false,searchable: false}
],
    "fnRowCallback": function(nRow, aData, iDisplayIndex) {

        if (aData.nombre != "Asociada") {
            var opciones = $('td:eq(0)', nRow);
            let html = '<input class="form-control" type="checkbox"  name="s[]" value="'+aData.id+'" />';
            opciones.html(html);

        }
}});
</script>
@endsection
