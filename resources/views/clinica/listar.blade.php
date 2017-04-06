@extends('layouts.app')
@section('titulo')
clinica
@endsection
@section('contenedor')
<div class="box">
    <div class="box-header">
        <h2>Lista clinica</h2>
    </div>
    <input type="hidden" name="token" id="token" value="{{csrf_token()}}">
    <div class="box-body">
        <table class="table table-striped b-t b-b" id="tblclinica">
            <thead>
                <tr>
                    <th  style="width:1%">NIT</th>
                    <th  style="width:1%">Nombre</th>
                    <th  style="width:1%">Teléfono</th>
                    <th  style="width:1%">Dirección</th>
                    <th  style="width:1%">Estado</th>
                    <th  style="width:1%">Accion</th>
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
  $(function(){
    var tabla = $('#tblclinica').DataTable({
      processing: true,
      serverSide: true,
      "language": {
        "url": "/plugins/dataTables/Spanish.json"
      },
      ajax: '/clinica/get',
      columns: [
      {data: 'NIT', name: 'NIT'},
      {data: 'nombre', name: 'nombre'},
      {data: 'telefono', name: 'telefono'},
      {data: 'direccion', name: 'direccion'},
      {data: 'estadoClinica', name: 'estadoClinica'},
      {data: 'action', name: 'action', orderable: false,searchable: false}
      ]
    });


    function cambiar_estado(id_clinica, estado){
      $.ajax({
        type : "post",
        dataType : "json",
        data : {"clinica_id" : id_clinica, "estado": estado, "_token":$("#token").val()},
        url : "/clinica/estado/editar"
      }).done(function (result){

        if (result.respuesta == '1') {

          tabla.ajax.reload();
        }
      });
    } 


var tabla = $('#tblclinica').DataTable({
    processing: true,
    serverSide: true,
    "language": {
        "url": "/plugins/dataTables/Spanish.json"
    },
    ajax: '/clinica/get',
    columns: [
        {data: 'NIT', name: 'NIT'},
        {data: 'nombre', name: 'nombre'},
        {data: 'telefono', name: 'telefono'},
        {data: 'direccion', name: 'direccion'},
        {data: 'estadoClinica', name: 'estadoClinica'},
        {data: 'action', name: 'action', orderable: false,searchable: false}
    ]
});


function cambiar_estado(id_clinica, estado){
    $.ajax({
        type : "post",
        dataType : "json",
        data : {"clinica_id" : id_clinica, "estado": estado, "_token":$("#token").val()},
        url : "/clinica/estado/editar"
    }).done(function (result){

        if (result.respuesta == '1') {
            new PNotify({
                title: 'Notificación',
                type : 'success',
                text: 'Actualización exitosa.',
                icon : false
            })
            tabla.ajax.reload();
        }
    });

}





  });
  


</script>
@endsection
