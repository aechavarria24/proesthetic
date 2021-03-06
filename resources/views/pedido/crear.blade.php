@extends('layouts.App')
@section('titulo')
Pedido
@endsection
@section('contenedor')
<div class="box">
    <div class="box-header">
        <h2>Registrar</h2>
    </div>
    <div class="box-body">
        <div class="padding">
            <div class="row">
                <form data-ui-jp="parsley" novalidate="" method="POST" action="/pedido" onclick="return false" id="frmCrearPedido">
                    {{ csrf_field() }}
                    <div class="col-sm-6">
                        <div class="col-lg-12">
                            <div class="box">
                                <div class="box-header">
                                    Paciente
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label" label = "Cedula paciente" >Cedula del paciente</label>
                                                <input id="_token" name="_token" type="hidden" value="{{csrf_token()}}">
                                                <input class="form-control" required="" placeholder="123456789" data-parsley-id="136" type="text" id="cedula" name="cedula" onchange="traer_nombre_paciente(this);">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label" label="Nombre Paciente">Nombre Paciente</label>
                                                <input class="form-control" required="" data-parsley-id="136" type="text" name="nombre" id="nombre">
                                                <input type="hidden" name="paciente_id" id="paciente_id"  >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="box">
                                <div class="box-header">
                                    Datos clínica
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Nombre Doctor</label>
                                        @foreach($usuarioClinica as $values)
                                        <input class="form-control" required="" data-parsley-id="136" type="text" name="usuarioClinica" disabled="false" value="{{$values->NombreDoctor}} {{$values->ApellidoDocto}}">
                                        <input type="hidden" id = "usuario_id" name="usuario_id" value="{{$values->id}}">
                                        @endforeach

                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Cínica</label>
                                            @foreach($usuarioClinica as $values)
                                            <input class="form-control" required="" data-parsley-id="136" type="text" name="nombre"   disabled="false" value="{{$values->usuarioClinica}}">
                                            @endforeach
                                            <input class="form-control" type="hidden" name="empleado_id"  value="">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label label="Descripción">Descripción</label>
                                            <textarea name="observacion" required="" placeholder="Observación del pedido" class="form-control" rows="12" cols="80"></textarea>
                                        </div>
                                    </div>
                                    <h6>Fecha entrega</h6>
                                    <div class="input-group date">
                                        <input type="text" class="form-control" id="fechaEntrega" name="fechaEntrega" placeholder="2040-12-31">
                                        <div class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class=" p-a text-center">
                                <button type="button" onclick="guardar_pedido()" class="btn info">Registrar</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-sm-12">
                            <div class="box">
                                <div class="box-header">

                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Servicio</label>
                                                <select class="form-control c-select" name="servicio_tipocontrato_id" id="cbxServicio"  onchange="cambiar_valor_servicio(this)">
                                                    <option value=""></option>
                                                    @foreach($servicio as $values)
                                                    <option value="{{$values->id}}" id=""> {{$values->nombre}}</option>
                                                    <br type="text"  id="optServicio" hidden="true" value="{{$values->nombre}}">
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Valor</label>
                                                <input class="form-control" required="" data-parsley-id="136" type="text" id="valor" disabled="">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class=" p-a text-center">
                                                <button type="button" onclick = "AgregarServicio();" class="btn info">Agregar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12" id="containerMedidaPieza">
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>
@endsection

@section ('script')
<script type="text/javascript">
$(function(){
    $.ajax({
        type : "get",
        dataType: "json",
        url : "/pedido/eliminar_session",
        data : {}
    });
});
$('#cbxServicio').select2();
$('#fechaEntrega').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '0d',
    endDate: '+3m'

});

var id_pieza=0;
function AgregarServicio(e){
    var servicio = $("#cbxServicio option:selected").html();

    if (servicio!="") {

        var servicio_tipo_id =$("#cbxServicio").val();
        // alert(servicio_tipo_id);

        $("#containerMedidaPieza").append(
            '<div class="box" name="containerMedidaPieza">'
            +'<div class="box-header" >'
            +'Medidas de la pieza de: '+' '+servicio+''
            +'</div>'
            +'<div class="box-body">'
            +'<div class="row">'
            +'<div class="col-xs-3">'
            +'<input class="form-control" type="hidden"  id="servi-'+id_pieza+'" name="servicio_tipo_id" type="number" value="'+servicio_tipo_id+'">'
            +'<input class="form-control" name="cantidad" id="txtCant-'+id_pieza+'" placeholder="Cantidad" maxlength="3"  type="text" maxlength=2 value="">'
            +	'</div>'
            +'<div class=" col-xs-4">'
            +'<select class="form-control c-select" name="unidadMedida" id="selectUnidadMedida-'+id_pieza+'" value="">'
            +'<option value="MM">MM</option>'
            +'<option value="CM">CM</option>'
            +'</select>'
            +'</div>'
            +'<div class="col-xs-3">'
            +'<select class="form-control c-select" name="dimension" id="selectDimension-'+id_pieza+'" value="">'
            +'<option value="ALTO">ALTO</option>'
            +'<option value="LARGO">LARGO</option>'
            +'<option value="ANCHO">ANCHO</option>'
            +'<option value="RADIO">RADIO</option>'
            +'</select>'
            +'</div>'
            +'<div>'
            +'<div class="col-xs-1">'
            +'<button id="'+id_pieza+'-btn" title="Adicionar" value="'+id_pieza+'" onclick="AgregarMedidaPieza(this);" class="btn btn-icon white" type="button">'
            // + '<input id="_token" name="_token" type="hidden" value="{{csrf_token()}}">'
            +'<i class="fa fa-plus" href="#"></i>'
            +'</button>'
            +'</div>'
            +'</div>'
            +'<div class="box-divider m-a-0"></div>'

            +'</div>'
            +'<div style = "padding-top: 2%;">'
            +'<table class="table table-striped b-t">'
            +'<thead>'
            +'<tr>'
            +'<th>Cantidad</th>'
            +'<th>Dimensión</th>'
            +'<th>Unidad de medida</th>'
            +'<th>Opción</th>'
            +'</tr>'
            +'</thead>'
            +'<tbody id="t-'+id_pieza+'">'
            +'</tbody>'
            +'</table>'
            +'</div>'
            +'</div>'
            +'</div>'
        );
        id_pieza++;
    } else {


        new PNotify({
            title : 'Atención...',
            text : 'Por favor seleccione un servicio',
            type : 'error'
        });}

    }
    function traer_nombre_paciente(e){
        var cedula=$(e).val();

        $.ajax({
            type: "POST",
            datatype : "json",
            url: "/pedido/traer_nombre_paciente",
            data:{
                "_token" : $("#_token").val(),
                "cedula" : cedula
            }
        }).done(function(nombre){
            var json = JSON.parse(nombre);
            console.log(":)");
            $("#nombre").val(json[0].nombre);

        });

    }
    var contador=0;
    var contador_session=0;
    function AgregarMedidaPieza(e){

        var id=$(e).val();
        // alert(id);
        var idTabla=id.split('-');
        var cantidad=($("#txtCant-"+idTabla[0]).val());
        if (cantidad.length==0||cantidad<=0 || isNaN(cantidad)) {

            new PNotify({
                title : 'Atención...',
                text : 'Por favor ingrese una cantidad valida en la medida de la pieza',
                type : 'error'
            });
        }else {
            var unidad=($("#selectUnidadMedida-"+idTabla[0]).val());
            var dimension=($("#selectDimension-"+idTabla[0]).val());
            var servicio_tipo_id=($("#servi-"+idTabla[0]).val());
            var oID = $(this).attr("tbody");

            $.ajax({
                type: "post",
                datatype : "json",
                url: "/pedido/agregarPieza",
                data:{
                    "_token" : $("#_token").val(),
                    "cantidad" : cantidad,
                    "unidad" : unidad,
                    "dimension" : dimension,
                    "id" : id,
                    "servicio_tipo_id" : servicio_tipo_id,
                    "contador_session" : contador_session

                }
            }).done(function(result){
                //Por programar :)
                contador=0;
                $('#t-'+id).empty();
                $.each(result, function(index_value, valor_pieza){
                    //console.log(id, valor_pieza);
                    if (id == valor_pieza.id_tabla) {
                        $('#t-'+id).append('<tr id="#t-'+contador_session+'"><td>'+valor_pieza.cantidad+'</td><td>'+valor_pieza.dimension+'</td><td>'+valor_pieza.unidad+'</td><td><button class="btn btn-icon white" title="Eliminar"   onclick="EliminarMedidaPieza(this);" type="button" value="'+contador_session+'" id="#t-'+contador_session+'" ><i class="fa fa-trash" href="#"></i></button></td></tr>');
                        //alert(valor_pieza.cantidad);
                        //alert(valor_pieza.dimension);
                    }
                    contador++;
                    //console.log(valor_pieza);
                });
                contador_session++;
                //console.log(result.respuesta);
            });
            contador++;

        }

    }

    function EliminarMedidaPieza(e){
        var contador=$(e).val();

        $.ajax({
            type: "post",
            dataType : "json",
            url: "/pedido/eliminarPieza",
            data:{
                "_token" : $("#_token").val(),
                // "cantidad" : cantidad,
                // "unidad" : unidad,
                // "dimension" : dimension,
                "contador" : contador
            }
        }).done(function(result){
            // console.log(result);
            if (result.respuesta==1) {
                var tr = $(e).closest("tr");
                tr.remove();
                //alert(valor_pieza.dimension);
            }


        });
    }


    // $('#tabla > tbody:last').append('<tr id="ultima"><td>Ultima fila</td></tr>');
    //  $('#tabla > tbody:last').append('<tr id="ultima"><td>Ultima fila</td></tr>');
    function cambiar_valor_servicio(e){
        var id = $(e).val();
        $.ajax({
            url:'/pedido/traer/valor/'+id,
            dataType:'json',
            type:'get'
        }).done(function(r){
            $("#valor").val(r.valor);
        })
    }

    function guardar_pedido(){


        $("#frmCrearPedido").submit()

    }

    $("#frmCrearPedido").validate({
        errorElement: 'span',
        errorPlacement: function(error, e) {
            let label = jQuery(e).parents('.form-group').find("label").attr("label");
            jQuery(e).parents('.form-group').find("label").text(label+". ").append(error);
        },
        highlight: function(e) {
            var elem = jQuery(e);
            elem.closest('.form-group').removeClass('has-error').addClass('has-error');
            elem.closest('.help-block').remove();
        },
        success: function(e) {
            var elem = jQuery(e);
            elem.closest('.form-group').removeClass('has-error').addClass('has-success');
            elem.closest('.help-block').remove();
        },
        rules: {
            nombre: {
                required: true,
                personName:true,
                minlength: 3,
                maxlength: 45
            },
            cedula: {
                required: true,
                minlength: 7,
                maxlength: 13,
                number: true
            },
            fechaEntrega: {
                required: true,
                minlength: 10,
                maxlength: 10
            },
            observacion: {
                required: true,
                minlength: 10,
                maxlength: 200
            },
            containerMedidaPieza: {
                required: true,
                minlength: 10,
                maxlength: 10
            }
        }
    });


    </script>
    @endsection
