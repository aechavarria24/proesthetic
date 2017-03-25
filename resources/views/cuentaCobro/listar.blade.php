@extends('layouts.app')
@section('titulo')
Cuenta cobro
@endsection
@section('contenedor')
<div class="box">
  <div class="box-header">
    <h2>Lista cuentas de cobro</h2>

  </div>
  <div class="box-body">
    <table class="table table-striped b-t b-b" id="tblCuentaCobro">
      <thead>
        <tr>
          <th  style="width:20%"># Cuenta Cobro</th>
          <th  style="width:25%">Fecha creación</th>
          <th  style="width:25%">Valor Total</th>
          <th  style="width:25%">Opciones</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
    <a target="_blank" href="/proveedor/pdf" class="btn btn-primary">Generar PDF</a>
  </div>
</div>
@endsection
@section ('script')
<script type="text/javascript">
$('#tblCuentaCobro').DataTable({
  processing: true,
  serverSide: true,
  "language": {
    "url": "/plugins/dataTables/Spanish.json"
  },

  ajax: '/cuentacobro/get',
  columns: [
    {data: 'id', name: 'id'},
    {data: 'created_at', name: 'created_at'},
    {data: 'valorTotal', name: 'valorTotal'},
    {data: 'action', name: 'action', orderable: false,searchable: false}
  ]
});
</script>
@endsection
