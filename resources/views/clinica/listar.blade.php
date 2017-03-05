@extends('layouts.app')
@section('titulo')
clinica
@endsection
@section('contenedor')
<div class="box">
  <div class="box-header">
    <h2>Lista clinica</h2>
  </div>
  <div class="box-body">
    <table class="table table-striped b-t b-b" id="tblclinica">
      <thead>
        <tr>
          <th  style="width:20%">NIT</th>
          <th  style="width:25%">Nombre</th>
          <th  style="width:25%">Teléfono</th>
          <th  style="width:25%">Dirección</th>
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
$('#tblclinica').DataTable({
  processing: true,
  serverSide: true,
  "language": {
    "url": "/plugins/dataTables/Spanish.json"
  },

  ajax: '/clinica/get',
  columns: [
    {data: 'nombre', name: 'nombre'},
    {data: 'descripcion', name: 'descripcion'},
    {data: 'action', name: 'action', orderable: false,searchable: false}
  ]
});
</script>
@endsection
