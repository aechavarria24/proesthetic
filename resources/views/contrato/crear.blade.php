@extends('layouts.App')
@section('titulo')
Contrato
@endsection
@section('contenedor')
<div class="box">
    <div class="box-header">
        <h2>Registrar</h2>
    </div>
    <div class="box-body">
        <div class="padding">
            <div class="row">
                <form data-ui-jp="parsley" novalidate="" method="get" action="/contrato/crear" id="frmcrearcontrato">
                    {{csrf_field()}}
                    <div class="col-sm-5">
                        <div class="col-lg-12">
                            <div class="box">
                                <div class="box-header">
                                    Contrato
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label label="Nombre del Contrato">Nombre del Contrato</label>
                                                <input class="form-control" required="true" data-parsley-id="136" type="text" name="nombre">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label label="Descripción">Descripción</label>
                                                <textarea name="descripcion" required="" class="form-control" rows="8" cols="80"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class=" p-a text-center">
                                <button type="submit" class="btn info">Registrar</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="box">
                            <div class="box-header">
                                Datos del Contrato
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Servicios</label>
                                            <select class="form-control c-select" id = "chxServicio">
                                                <option value ="">Seleccionar </option>
                                                @foreach ($servicio as $value)
                                                <option value ="{{ $value->id }}" id ="select-{{ $value->id }}">{{ $value->nombre }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label label="Valor">Valor</label>
                                            <input class="form-control" name="valor" id="txtValor" placeholder="valor" type="number" min ="1">
                                        </div>
                                    </div>
                                    <div class = "col-sm-1">
                                        <div class="form-group">
                                            <label for="">__</label>
                                            <button class="btn btn-icon white" type = "button" onclick="agregar_servicio()">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-divider m-a-0"></div>
                            </div>
                            <table class="table table-striped b-t">
                                <thead>
                                    <tr>
                                        <th>Tipo de Servicio</th>
                                        <th>valor</th>
                                        <th>Opción</th>
                                    </tr>
                                </thead>
                                <tbody id ="tbl_contrato_servicio">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type = "text/javascript">

$("#chxServicio").select2();

$(function(){

    $.ajax({
        type : 'GET',
        dataType : 'JSON',
        data : {},
        url : '/contrato/eliminar/tabla'
    });

});

function agregar_servicio(){
    var servicio = $("#chxServicio").val();
    var valor = $("#txtValor").val();
    var nombre_servicio = $("#chxServicio option:selected").text();

    if (servicio.length == 0) {
        new PNotify({
            title: 'Por favor escoja un servicio.',
            type: 'error',
            icon: false
        });
    }else if (valor.length == 0) {
        new PNotify({
            title: 'Por favor ingrese un valor valido',
            type: 'error',
            icon: false
        });
    }else {
        $.ajax({
            type: "GET",
            dataType : "JSON",
            url : "/contrato/servicio/agregar",
            data : {
                servicio : servicio,
                nombre : nombre_servicio,
                valor : valor,
            }
        }).done(function(result){
            $("#tbl_contrato_servicio").empty();
            $.each(result, function(i, v){
                $("#tbl_contrato_servicio").append("<tr id = "+v.servicio+"><td>"+v.nombre+"</td><td>"+v.valor+"</td><td><button class = 'btn btn-xs'  type ='button' onclick='eliminar_servicio("+v.servicio+")'><i class ='fa fa-trash'></i></button></td></tr>");
                $("#select-"+v.servicio+"").remove();
            });

            $("#chxServicio").val("");
            $("#txtValor").val("");
        });

    }
}

function eliminar_servicio(e){
    $.ajax({
        type : "GET",
        dataType : "JSON",
        data : {id : e },
        url : "/contrato/servicio/eliminar"
    }).done(function(result){
        console.log(result);
        $("#tbl_contrato_servicio").empty();
        $.each(result.session, function(i, v){
            $("#tbl_contrato_servicio").append("<tr id = tr-"+v.servicio+"><td>"+v.nombre+"</td><td>"+v.valor+"</td><td><button class = 'btn btn-xs'  type ='button' onclick='eliminar_servicio("+v.servicio+")'><i class ='fa fa-trash'></i></button></td></tr>");
        });

        $("#chxServicio").val("");
        $("#txtValor").val("");
        $("#chxServicio").append('<option value ="'+result.servicioEliminado.servicio+'" id ="select-'+result.servicioEliminado.servicio+'">'+result.servicioEliminado.nombre+'</option>');

    });
}

$("#txtNombre").change(function(){
    return registrar_servicio();
});
function crearcontrato(){
    $("#frmcrearcontrato").submit()
}
$("#frmcrearcontrato").validate({
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
        valor: {
            required: false,
            minlength: 1,
            maxlength: 7
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
