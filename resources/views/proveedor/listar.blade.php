@extends('layouts.app')
@section('titulo')
Proveedor
@endsection
@section('contenedor')
<div class="box">
  <div class="box-header">
    <h2>Lista de porveedores</h2>
    <a target="_blank" href="/proveedor/pdf" class="btn btn-primary">Generar PDF</a>
  </div>
  <div class="box-body">
    <table class="table table-striped b-t b-b" id="tblProveedor">
      <thead>
        <tr>
          <th  style="width:20%">Nombre</th>
          <th  style="width:25%">Teléfono</th>
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
$('#tblProveedor').DataTable({
  processing: true,
  serverSide: true,
  "language": {
    "url": "/plugins/dataTables/Spanish.json"
  },

  ajax: '/proveedor/get',
  columns: [
    {data: 'nombre', name: 'nombre'},
    {data: 'telefono', name: 'telefono'},
    {data: 'action', name: 'action', orderable: false,searchable: false}
  ]
});
</script>
@endsection
