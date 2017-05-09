@extends('layouts.app')
@section('titulo')
Orden de producción
@endsection
@section('contenedor')
<div class="box">
    <div class="box-header">
        <h2>Lista de ordenes de producción</h2>
    </div>
    <div class="box-body">
        <table class="table table-striped b-t b-b" id="tblordenProduccion">
            <thead>
                <tr>
                    <th  style="width:1%">Número de pedido</th>
                    <th  style="width:1%">Número orden</th>
                    <th  style="width:1%">Fecha creación</th>
                    <th  style="width:1%">Fecha finalizacion</th>
                    <th  style="width:1%">Estado</th>
                    <th  style="width:1%">Opciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
<div class="modal fade" tabindex="-1" role="dialog" id="mdlEstado">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <label for="">Su estado actual es: <span id="estadoActual"></span> </label>
                <select class="form-control" ="" id="ddlEstados">

                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@section ('script')
<script type="text/javascript">

function detalle(id){
    $.ajax({
        'dataType':'json',
        'type':'get',
        'url':'/produccion/detalle/'+id
    }).done(function (e){
        if(e.data ==1){
            new PNotify ({
                title: 'Espera',
                text: 'No hay datos para mostrar',
                type: 'error'
            });

        }else{
            $("#estadoActual").text(e.estado);
            $.each(e.data[0], function(i, e){
                $("#ddlEstados").append("<option value='"+e.id+"'>"+e.nombre+"</option>");
            })
            $("#ddlEstados").removeAttr('hidden');
            // $("#mdlEstado").modal();
        }

    })};


    var tabla = $('#tblordenProduccion').DataTable({
        processing: true,
        serverSide: true,
        "language": {
            "url": "/plugins/dataTables/Spanish.json"
        },
        ajax: '/produccion/get',
        columns: [
            {data: 'pedido_id', name: 'pedido_id'},
            {data: 'id', name: ' id'},
            {data: 'created_at', name: 'created_at'},
            {data: 'fechaFin', name: 'fechaFin'},
            {data: 'estado_orden_produccion', name: 'estado_orden_produccion'},
            {data: 'action', name: 'action', orderable: false,searchable: false}
        ]
    });

    function cambiar_estado(orden_produccíon, estado){
        var acciones = {
            cambiar_estado : function(){
                $.ajax({
                    type : "post",
                    dataType : "json",
                    data : {"orden_produccion" : orden_produccíon, "estado": estado, "_token":$("#_token").val()},
                    url : "/produccion/estado/editar"
                }).done(function (result){
                    console.log(result.respuesta.venta);
                    if (result.respuesta =='1') {
                        new PNotify({
                            title: 'Cambio de estado',
                            text: ' Se cambiado el estado de la orden de produccion con éxito.',
                            type: 'success'
                        });
                        tabla.ajax.reload();
                    }else if (result.respuesta == '3') {
                        new PNotify({
                            title: 'Cambio de estado',
                            text: ' Ocurrio un error en el proceso, por favor \n\
                            vuelva a intentarlo',
                            type: 'error'
                        });
                    }else if(result.respuesta.venta == 'venta'){
                        acciones.mensaje_venta(result.respuesta.venta_generada.id);
                    }
                });
            },
            mensaje_venta : function(codigo_venta) {
                var cur_value = 1,
                progress;

                // Make a loader.
                var loader = new PNotify({
                    title: "Buscando pedido",
                    text: '<div class="progress progress-striped active" style="margin:0">\
                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0">\
                    <span class="sr-only">0%</span>\
                    </div>\
                    </div>',
                    //icon: 'fa fa-moon-o fa-spin',
                    icon: 'fa fa-cog fa-spin',
                    hide: false,
                    buttons: {
                        closer: false,
                        sticker: false
                    },
                    history: {
                        history: false
                    },
                    before_open: function(notice) {
                        progress = notice.get().find("div.progress-bar");
                        progress.width(cur_value + "%").attr("aria-valuenow", cur_value).find("span").html(cur_value + "%");
                        // Pretend to do something.
                        var timer = setInterval(function() {
                            if (cur_value == 40) {
                                loader.update({
                                    title: "Generando venta",
                                    icon: "fa fa-circle-o-notch fa-spin"
                                });
                            }
                            if (cur_value == 60) {
                                loader.update({
                                    title: "Creando Venta",
                                    icon: "fa fa-refresh fa-spin"
                                });
                            }
                            if (cur_value == 75) {
                                new PNotify({
                                    title: 'Venta creada con éxito',
                                    text: ' Código de la venta: ' + codigo_venta,
                                });
                            }
                            if (cur_value >= 100) {
                                // Remove the interval.
                                window.clearInterval(timer);
                                loader.remove();
                                return;
                            }
                            cur_value += 1;
                            progress.width(cur_value + "%").attr("aria-valuenow", cur_value).find("span").html(cur_value + "%");
                        }, 65);
                    }
                });
                tabla.ajax.reload(false, null);
            }

        }
        if (estado === 5) {
            new PNotify({
                title: '¿Desea enviar o generar una venta?',
                icon: 'fa fa-hand-paper-o',
                hide: false,
                confirm: {
                    confirm: true,
                    buttons: [{
                        text: 'Enviar'
                    }, {
                        text: 'Generar venta',
                    }]
                },
                buttons: {
                    closer: false,
                    sticker: false
                },
                history: {
                    history: false
                },
                addclass: 'stack-modal',
                stack: {
                    'dir1': 'down',
                    'dir2': 'right',
                    'modal': true
                }
            }).get().on('pnotify.confirm', function() {
                estado = 4;
                acciones.cambiar_estado();
            }).on('pnotify.cancel', function() {
                estado = 1;
                acciones.cambiar_estado();
            });
        }else{
            acciones.cambiar_estado();
        }
    }
    </script>
    @endsection
