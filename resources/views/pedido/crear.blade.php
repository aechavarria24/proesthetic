@extends('layouts.app')
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

                <form data-ui-jp="parsley" novalidate="" method="POST" action="/pedido">
                    {{ csrf_field() }}
                    <div class="col-sm-6">
                        <div class="col-lg-12">
                            <div class="box">
                                <div class="box-header">
                                    Paciente
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Cedula del paciente</label>
                                                <input class="form-control" required="" data-parsley-id="136" type="text" name="cedula">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Nombre Paciente</label>
                                                <input class="form-control" required="" data-parsley-id="136" type="text" name="nombre" >
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
                                        @endforeach

                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Cínica</label>
                                            <input class="form-control" required="" data-parsley-id="136" type="text" name="nombre"  disabled="false" value="{{$values->usuarioClinica}}">
                                        </div>
                                    </div>
                                    <h6>Fecha entrega</h6>
                                    <div class="input-group date">
                                        <input type="text" class="form-control" id="datepicker" name="fechaEntrega">
                                        <div class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </div>
                                    </div>
                                </div>
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
                                                    <br type="text" name="" id="optServicio" hidden="true" value="{{$values->nombre}}">
                                                    @endforeach



                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Valor</label>
                                                <input class="form-control" required="" data-parsley-id="136" type="text" id="valor" disabled="" name="valor">
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
                    <div class="col-sm-12">
                        <div class=" p-a text-center">
                            <button type="submit" class="btn info">Registrar</button>
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
$('#cbxServicio').select2();
$('#datepicker').datepicker({
    format: 'yyyy-mm-dd',
});

var id_pieza=0;
function AgregarServicio(e){
    var servicio = $("#cbxServicio option:selected").html();
    var servicio_tipo_id =$("#cbxServicio").val();
    // alert(servicio_tipo_id);

    $("#containerMedidaPieza").append(
        '<div class="box">'
        +'<div class="box-header" >'
        +'Medidas de la pieza de: '+' '+servicio+''
        +'</div>'
        +'<div class="box-body">'
        +'<div class="row">'
        +'<div class="col-xs-3">'
        +'<input class="form-control" hidden="true" name="servicio_tipo_id" type="number" value="'+servicio_tipo_id+'">'
        +'<input class="form-control" name="cantidad" id="txtCant-'+id_pieza+'" placeholder="Cantidad" type="number" value="">'
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
        + '<input id="_token" name="_token" type="hidden" value="{{csrf_token()}}">'
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
}
var contador=0;
function AgregarMedidaPieza(e){
    var contador_session=0;
    var id=$(e).val();
    // alert(id);
    var idTabla=id.split('-');
    var cantidad=($("#txtCant-"+idTabla[0]).val());
    var unidad=($("#selectUnidadMedida-"+idTabla[0]).val());
    var dimension=($("#selectDimension-"+idTabla[0]).val());
    // 	var oID = $(this).attr("tbody");
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
            "contador_session" : contador_session
        }
    }).done(function(result){
        //Por programar :)
        contador=0;
                    $('#t-'+id).empty();
                $.each(result, function(index_value, valor_pieza){
                    //console.log(id, valor_pieza);
                    if (id == valor_pieza.id_tabla) {
                        $('#t-'+id).append('<tr><td>'+valor_pieza.cantidad+'</td><td>'+valor_pieza.dimension+'</td><td>'+valor_pieza.unidad+'</td><td><button class="btn btn-icon white" title="Eliminar"   onclick="EliminarMedidaPieza(this);" type="button" value="#t-'+contador+'" ><i class="fa fa-trash" href="#"></i></button></td></tr>');
                        //alert(valor_pieza.cantidad);
                        //alert(valor_pieza.dimension);

                    }
                    contador++;
                    contador_session++;
                    //console.log(valor_pieza);

                });





        //console.log(result.respuesta);
    });



    //$('#'+idTabla[0]).append(
        //'<tr id="'+contador+'-'+idTabla[0]+'">'
        //+'<td>'+cantidad+'</td>'
        //+'<td>'+unidad+'</td>'
        //+'<td>'+dimension+'</td>'
        //+'<td>'
        //+'<button class="btn btn-icon white" title="Eliminar" value="'+contador+'-'+idTabla[0]+'" onclick="eliminar(this);" id="'+contador+'-'+idTabla[0]+'" type="button">'
        //+'<i class="fa fa-trash" href="#"></i>'
        //+'</button>'
        //+'</td>'
        //+'</tr>')
        // alert(id);
        contador++;
    }

    function EliminarMedidaPieza(e){

        var id=$(e).val();
        // alert(id);
        var idTabla=id.split('-');
        var cantidad=($("#txtCant-"+idTabla[0]).val());
        var unidad=($("#selectUnidadMedida-"+idTabla[0]).val());
        var dimension=($("#selectDimension-"+idTabla[0]).val());
        // 	var oID = $(this).attr("tbody");
        $.ajax({
            type: "post",
            datatype : "json",
            url: "/pedido/agregarPieza",
            data:{
                "_token" : $("#_token").val(),
                "cantidad" : cantidad,
                "unidad" : unidad,
                "dimension" : dimension,
                "id" : id
            }
        }).done(function(result){
            //Por programar :)

                        $('#t-'+id).empty();
                    $.each(result, function(index_value, valor_pieza){
                        //console.log(id, valor_pieza);
                        if (id == valor_pieza.id_tabla) {
                            $('#t-'+id).append('<tr><td>'+valor_pieza.cantidad+'</td><td>'+valor_pieza.dimension+'</td><td>'+valor_pieza.unidad+'</td><td><button class="btn btn-icon white" title="Eliminar"  onclick="eliminar(this);" type="button"><i class="fa fa-trash" href="#"></i></button></td></tr>');
                            //alert(valor_pieza.cantidad);
                            //alert(valor_pieza.dimension);

                        }
                    });

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





    </script>
    @endsection
