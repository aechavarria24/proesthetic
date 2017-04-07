@extends('layouts.app')
@section('titulo')
Empleado
@endsection
@section('contenedor')
<div class="box">
    <div class="box-header">
        <h2>Lista de empleados</h2>
    </div>
    <input type="hidden" name="token" id="token" value="{{csrf_token()}}">
    <div class="box-body">
        <table class="table table-striped b-t b-b" id="tblEmpleado">
            <thead>
                <tr>
                    <th  style="width:1%">Usuario</th>
                    <th  style="width:1%">Rol</th>
                    <th  style="width:1%">Nombre</th>
                    <th  style="width:1%">Apellido</th>
                    <th  style="width:1%">Estado</th>
                    <th  style="width:1%">Opciones</th>
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
var tabla = $('#tblEmpleado').DataTable({
    processing: true,
    serverSide: true,
    "language": {
        "url": "/plugins/dataTables/Spanish.json"
    },
    ajax: '/empleado/get',
    columns: [
        {data: 'username', name: 'username'},
        {data: 'rol', name: 'rol'},
        {data: 'nombre', name: 'nombre'},
        {data: 'apellido', name: 'apellido'},
        {data: 'estado', name: 'estado'},
        {data: 'action', name: 'action', orderable: false,searchable: false}
    ]
});


function cambiar_estado(empleado_id, estado){
    $.ajax({
        type : "post",
        dataType : "json",
        data : {"empleado_id" : empleado_id, "estado": estado, "_token":$("#token").val()},
        url : "/empleado/estado/editar"
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

</script>
@endsection
