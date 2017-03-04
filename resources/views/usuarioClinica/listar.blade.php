@extends('layouts.app')
@section('titulo')
usuario
@endsection
@section('contenedor')
<div class="box">
  <div class="box-header">
    <h2>Lista de usuario</h2>
  </div>
  <div class="box-body">
    <table class="table table-striped b-t b-b" id="tblusuario_clinica">
      <thead>
        <tr>
          <th  style="width:20%">Usuario</th>
          <th  style="width:20%">Nombre</th>
          <th  style="width:25%">Clinica</th>
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
$('#tblusuario_clinica').DataTable({
  processing: true,
  serverSide: true,
  "language": {
    "url": "/plugins/dataTables/Spanish.json"
  },

  ajax: '/usuarioClinica/get',
  columns: [
    {data: 'usuario', name: 'usuario'},
    {data: 'nombre', name: 'nombre'},
    {data: 'apellido', name: 'clinica'},
    {data: 'action', name: 'action', orderable: false,searchable: false}
  ]
});
</script>
@endsection