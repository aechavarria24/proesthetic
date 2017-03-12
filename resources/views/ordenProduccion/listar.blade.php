@extends('layouts.app')
@section('titulo')
Orden de producción
@endsection
@section('contenedor')
<div class="box">
  <div class="box-header">
    <h2>Lista de ordenes de producción</h2>
  </div>
  <div class="box-body">
    <table class="table table-striped b-t b-b" id="tblordenProduccion">
      <thead>
        <tr>
          <th  style="width:20%">Número orden</th>
          <th  style="width:25%">Fecha creación</th>
          <th  style="width:25%">Fecha finalización</th>
          <th  style="width:25%">Estado</th>
          <th  style="width:25%">Opciones</th>
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
$('#tblordenProduccion').DataTable({
  processing: true,
  serverSide: true,
  "language": {
    "url": "/plugins/dataTables/Spanish.json"
  },

  ajax: '/produccion/get',
  columns: [
    {data: 'id', name: 'Numero orden'},
    {data: 'create_at', name: 'Fecha creación'},
    {data: 'fechaFin', name: 'Fecha finalizacion'},
    {data: 'estado_orden_produccion', name: 'Estado'},
    {data: 'action', name: 'action', orderable: false,searchable: false}
  ]
});
</script>
@endsection
