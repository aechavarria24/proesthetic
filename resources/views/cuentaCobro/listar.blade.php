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
          <th  style="width:5%">Selección</th>
          <th  style="width:20%">Cuenta cobro </th>
          <th  style="width:20%">Fecha creación</th>
          <th  style="width:20%">Valor </th>
          <th  style="width:20%">Opciones</th>



        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
    <div class=" p-a text-center">
      <a href="/cuentacobro/pago" class="btn btn-primary">Confirmar pago</a>
    </div>
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
    {data: 'seletion', name: 'seletion'},
    {data: 'id', name: 'id'},
    {data: 'created_at', name: 'created_at'},
    {data: 'valorTotal', name: 'valorTotal'},
    {data: 'action', name: 'action', orderable: false,searchable: false}

  ],
  "fnRowCallback": function(nRow, aData, iDisplayIndex) {
       var opciones = $('td:eq(0)', nRow);
       let html = '<input class="form-control" type="checkbox" name="s[]" value="'+aData.valorTotal+'" />';
       opciones.html(html);
    }
});
</script>
@endsection
