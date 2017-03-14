@extends('layouts.app')
@section('titulo')
Insumo
@endsection
@section('contenedor')
<div class="box">
  <div class="box-header">
    <h2>Lista De Insumos</h2>
    <a target="_blank" href="/proveedor/pdf" class="btn btn-primary">Generar PDF</a>
  </div>
  <div class="box-body">
    <table class="table table-striped b-t b-b" id="tblInsumo">
      <thead>
        <tr>
          <th  style="width:20%">Nombre</th>
          <th  style="width:25%">Unidad De Medida</th>
          <th  style="width:25%">Proveedor</th>
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

$('#tblInsumo').DataTable({
  processing: true,
  serverSide: true,
  "language": {
    "url": "/plugins/dataTables/Spanish.json"
  },

  ajax: '/insumo/get',
  columns: [
    {data: 'nombre', name: 'nombre'},
    {data: 'unidadMedida', name: 'unidadMedida'},
    {data: 'proveedor', name: 'proveedor' , orderable: false,searchable: false},
    {data: 'action', name: 'action', orderable: false,searchable: false}
  ]


  });


</script>

@endsection
