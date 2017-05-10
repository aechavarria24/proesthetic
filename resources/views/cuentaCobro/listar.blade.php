@extends('layouts.App')
@section('titulo')
Cuenta cobro
@endsection
@section('contenedor')
<form class="" action="/cuentacobro/pagarCuenta" method="post">
{{ csrf_field() }}
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
          <th  style="width:20%">Estado </th>
          <th  style="width:20%">Opciones</th>



        </tr>
      </thead>
      <tbody>

      </tbody>

    </table>

        <div class=" p-a text-center">

            <button  class="btn primary" type="submit" name="pago" value="pago">Confirmar pago</button>
            <button  class="btn primary" onclick="sumar();" type="submit" name="suma" value="suma">Suma total</button>
        </div>



  </div>

</div>
</form>
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
    {data: 'estado', name: 'estado'},
    {data: 'action', name: 'action', orderable: false,searchable: false}

  ],
  "fnRowCallback": function(nRow, aData, iDisplayIndex) {
       var opciones = $('td:eq(0)', nRow);
       let html = '<input class="form-control" type="checkbox" name="s[]" value="'+aData.id+'" />';
       opciones.html(html);
    }
});
</script>
@endsection
