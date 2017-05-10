@extends('layouts.App')
@section('titulo')
usuario
@endsection
@section('contenedor')
<div class="box">
  <div class="box-header">
    <h2>Lista de usuarios</h2>
  </div>
  <input type="hidden" name="token" id="token" value="{{csrf_token()}}">
  <div class="box-body">
    <table class="table table-striped b-t b-b" id="tblusuario_clinica">
      <thead>
        <tr>
          <th  style="width:20%">Usuario</th>
          <th  style="width:20%">Nombre</th>
          <th  style="width:25%">Clinica</th>
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
 var table=$('#tblusuario_clinica').DataTable({
  processing: true,
  serverSide: true,
  "language": {
    "url": "/plugins/dataTables/Spanish.json"
  },

  ajax: '/usuarioClinica/get',
  columns: [
    {data: 'username', name: 'username'},
    {data: 'nombre', name: 'nombre'},
    {data: 'apellido', name: 'clinica'},
    {data: 'estado', name: 'estado'},
    {data: 'action', name: 'action', orderable: false,searchable: false}
  ]
});
function cambiar_estado(usuario, estado){
    $.ajax({

        type : "post",
        dataType : "json",
        data : {"usuario_id" : usuario, "estado": estado, "_token":$("#token").val()},
        url : "/usuarioClinica/estado/editar"
    }).done(function (result){

        if (result.respuesta ==1) {
            new PNotify({
                title: 'Notificación',
                type : 'success',
                text: 'Actualización exitosa.',
                icon : false
            })
            table.ajax.reload(null,false);
        }
    });
}
</script>
@endsection
