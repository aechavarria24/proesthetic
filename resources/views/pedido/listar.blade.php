@extends('layouts.app')
@section('titulo')
pedido
@endsection
@section('contenedor')
<div class="box">
  <div class="box-header">
    <h2>Lista de pedidos</h2>
  </div>
  <div class="box-body">
    <table class="table table-striped b-t b-b" id="tblPedido">
      <thead>
        <tr>
          <th  style="width:1%">Pedido</th>
          <th  style="width:1%">Clinica</th>
          <th  style="width:1%">Fecha solicitud</th>
          <th  style="width:1%">Fecha Entrega</th>
          <th  style="width:1%">Estado</th>
          <th  style="width:1%">Opciones</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>
@endsection
@section ('script')
<script type="text/javascript">
$('#tblPedido').DataTable({
  processing: true,
  serverSide: true,
  "language": {
    "url": "/plugins/dataTables/Spanish.json"
  },
  ajax: '/pedido/get',
  columns: [
    {data: 'id', name: 'NumeroPedido'},
    {data: 'usuario_id', name: 'UsuarioClinica'},
    {data: 'created_at', name: 'FechaSolicitud'},
    {data: 'fechaEntrega', name: 'FechaEntrega'},
    {data: 'estado_pedido_id', name: 'Estado'},
    {data: 'action', name: 'action', orderable: false,searchable: false}
  ]
});
</script>
@endsection
