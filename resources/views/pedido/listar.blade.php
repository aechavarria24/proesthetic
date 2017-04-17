@extends('layouts.app')
@section('titulo')
pedido
@endsection
@section('contenedor')
<div class="box">
    <div class="box-header">
        <h2>Lista de pedidos</h2>
    </div>
    <div class="box-body">
        <table class="table table-striped b-t b-b" id="tblPedido">
            <input id="_token" name="_token" type="hidden" value="{{csrf_token()}}">
            <thead>
                <tr>
                    <th  style="width:1%">Pedido</th>
                    <th  style="width:1%">Clinica</th>
                    <th  style="width:1%">Fecha solicitud</th>
                    <th  style="width:1%">Fecha Entrega</th>
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
var table = $('#tblPedido').DataTable({
    processing: true,
    serverSide: true,
    "language": {
        "url": "/plugins/dataTables/Spanish.json"
    },
    ajax: '/pedido/get',
    columns: [
        {data: 'id', name: 'NumeroPedid'},
        {data: 'usuario_id', name: 'usuario_id'},
        {data: 'created_at', name: 'created_at'},
        {data: 'fechaEntrega', name: 'fechaEntrega'},
        {data: 'estado_pedido_id', name: 'estado_pedido_id'},
        {data: 'action', name: 'action', orderable: false,searchable: false}
    ]
});
function cancelarPedido(e){
    var id = $(e).attr("id");
    $.ajax({
        url:'/pedido/cancelarPedido',
        dataType:'json',
        data: {'id':id,
        '_token': $("#_token").val()
    },
    type:'post'
}).done(function(r){
    // $("#valor").val(r.valor);

    if (r.respuesta == 1) {


        new PNotify({
            title: 'Notificación',
            type : 'success',
            text: 'Estado actualizado con éxito.',
            icon : false
        })

        table.ajax.reload(null,false);

    }else if (r.respuesta == 0){
        new PNotify({
            title: 'Notificación',
            type : 'error',
            text: 'No se puede cancelar el pedido.',
            icon : false
        })
    }
});
}
function aprobarPedido(e){
    var id = $(e).attr("id");
    $.ajax({
        url:'/pedido/aprobarPedido',
        dataType:'json',
        data: {'id':id,
        '_token': $("#_token").val()

    },
    type:'post'
}).done(function(r){
    // $("#valor").val(r.valor);

    if (r.respuesta == 1) {
        new PNotify({
            title: 'Notificación',
            type : 'success',
            text: 'pedido Aprobado con éxito',
            icon : false
        })
        table.ajax.reload(null,false);
    }else if (r.respuesta == 0){
        new PNotify({
            title: 'Notificación',
            type : 'error',
            text: 'Pedido se encuantra en un estado que no se puede aprobar',
            icon : false
        })
    }else if (r.respuesta == 2){
        new PNotify({
            title: 'Ooops',
            type : 'error',
            text: 'Ha ocurrido una excepción, por favor reintente',
            icon : false
        })
    }
});
}
</script>
@endsection
