@extends('layouts.app')
@section('titulo')
Venta
@endsection
@section('contenedor')
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
              <th  style="width:20%">Número pedido</th>
              <th  style="width:25%">Doctor</th>
              <th  style="width:25%">Clínica</th>
              <th  style="width:25%">Fecha de venta</th>
              <th  style="width:25%">Estado</th>
              <th  style="width:25%">Opciones</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>

      </div>

    </div>
  </div>
</div>
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
    {data: 'nombre', name: 'nombre'},
    {data: 'descripcion', name: 'descripcion'},
    {data: 'descripcion', name: 'descripcion'},
    {data: 'descripcion', name: 'descripcion'},
    {data: 'descripcion', name: 'descripcion'},
    {data: 'action', name: 'action', orderable: false,searchable: false}
  ]
});
</script>
@endsection
