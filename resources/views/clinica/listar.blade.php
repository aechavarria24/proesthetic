@extends('layouts.App')
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
                    <th  style="width:1%">Nombre</th>
                    <th  style="width:1%">Nit</th>
                    <th  style="width:1%">Drirección</th>
                    <th  style="width:1%">Télefono</th>
                    <th  style="width:1%">Día corte</th>
                    <th  style="width:1%">Fecha creación</th>
                    <th  style="width:1%">Estado</th>
                    <th  style="width:1%">Acción</th>
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

var tabla = $('#tblclinica').DataTable({
    processing: true,
    serverSide: true,
    "language": {
        "url": "/plugins/dataTables/Spanish.json"
    },
    ajax: '/clinica/get',
    columns: [
        {data: 'nombre', name: 'nombre'},
        {data: 'NIT', name: 'NIT'},
        {data: 'direccion', name: 'direccion'},
        {data: 'telefono', name: 'telefono'},
        {data: 'diaCorte', name: 'diaCorte'},
        {data: 'created_at', name: 'created_at'},
        {data: 'estadoClinica', name: 'estadoClinica'},
        {data: 'action', name: 'action', orderable: false,searchable: false}
    ]
});


function cambiar_estado(id_clinica, estado){
    $.ajax({

        type : "post",
        dataType : "json",
        data : {"clinica_id" : id_clinica,
        "estado": estado,
        "_token":$("#token").val()},
        url : "/clinica/estado/editar"
    }).done(function (result){

        if (result.respuesta == '1') {
            new PNotify({
                title: 'Notificación',
                type : 'success',
                text: 'Actualización exitosa.',
                icon : false
            })
            tabla.ajax.reload(null,false);
        }
    });
}
</script>
@endsection
