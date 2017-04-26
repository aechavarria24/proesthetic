@extends('layouts.app')
@section('titulo')
Orden de producción
@endsection @section('contenedor')

<div class="Pading">
    <form class="" action="/produccion/insumo/guardar" method="get" id="frmInsumoOrdenProduccion">
        <div class="box">
            <div class="box-header">
                <h2>Asociar Insumos</h2>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Pedido</label>
                                {{Form::text('pedido ', $pedido[0]["idt"],['class'=>'form-control', 'readonly'])}}
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Orden de Producción</label>
                                {{Form::text('ordenProduccion', $pedido[0]["idp"],['class'=>'form-control', 'readonly'])}}
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="" id ="div_agregar_insumo">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label label = "Insumos">Insumos</label>
                                    <select class="form-control c-select" name="insumo_id" id="insumo_id">
                                        <option value ="0">Seleccionar</option>
                                        @foreach($insumoProduccion as $value)
                                        <option id ="select_{{ $value->id }}"  value="{{ $value->id }}">{{ $value->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <label class="control-label" label="Cantidad">Cantidad</label>
                                        <input class="form-control" data-parsley-id="136" type="text" name="cantidad" id ="cantidad" maxlength="3">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label class="" for="">___</label>
                                        <button id=¨"btnagregar" type ="button" onclick="funciones.addInsumo()" class="btn btn-icon white">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class=" p-a text-center">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <button type="submit" class="btn info">Asociar Insumos</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="box">
                            <div class="box-header">
                                Insumos asociados
                            </div>
                            <div class="box-body">
                                <div class="col-sm-12">
                                    <table class="table table-striped b-t">
                                        <thead>
                                            <tr>
                                                <th>Insumo</th>
                                                <th>Cantidad</th>
                                                <th>Unidad de medida</th>
                                                <th>Opción</th>
                                            </tr>
                                        </thead>
                                        <tbody id ="tbl_asociar_insumo"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="box">
                            <div class="box-header">
                                Medidas de la(s) pieza(s)
                            </div>
                            <div class="box-body">
                                @foreach ($servicios  as $key => $servicio)
                                <label for="table">Pieza: <?php echo $servicio["servicio"] ?></label>
                                <table class="table" id = "table">
                                    <thead>
                                        <tr>
                                            <th>Cantidad</th>
                                            <th>Dimesión</th>
                                            <th>Unidad de medida</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($medidas_pieza  as $key => $pieza)
                                        @if($servicio["servicio"] == $pieza["servicio"])
                                        <tr>
                                            <td><?php echo $pieza["cantidad"] ?></td>
                                            <td><?php echo $pieza["dimension"] ?></td>
                                            <td><?php echo $pieza["unidadMedidad"] ?></td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script')
<script type ="text/javaScript">
$(function(){
    $.ajax({
        data : "GET",
        dataType : "JSON",
        data : {},
        url : "/insumo/eliminar_tabla_asociar"
    });
});

$("#insumo").select2();

var funciones = {
    addInsumo : function (){
        insumo = $("#insumo_id").val();
        cantidad = $("#cantidad").val();
        if (insumo != 0 && !isNaN(cantidad) && cantidad > 0 && cantidad < 101) {
            $.ajax({
                type:'get',
                dataType:'json',
                url:'/insucant/addInsumo',
                data : {
                    insumo : insumo,
                    cantidad : cantidad,
                    pieza : $("#cbxPiezas option:selected").text()
                }
            }).done(function(result){
                $("#tbl_asociar_insumo").empty();
                $.each(result, function(i, v){
                    $("#tbl_asociar_insumo").append('<tr><td>'+v.nombre+'</td>\n\
                    <td>'+v.cantidad+'</td><td>'+v.unidad_medida+'</td>\n\
                    <td><button class="btn btn-icon white" title="Eliminar" \n\
                    onclick="funciones.eliminar_insumo('+v.insumo+');" \n\
                    type="button"><i class="fa fa-trash" ></i></button></td></tr>');
                });
                $("#insumo_id").val("0");
                cantidad = $("#cantidad").val("");
                $("#select_"+insumo).remove();
            })
        }else{
            new PNotify({
                title: 'Por favor verificar los valores a introducir.',
                type: 'error',
                icon: false
            });
        }
    },
    eliminar_insumo : function(e){
        $.ajax({
            type : "GET",
            dataType : "JSON",
            data : {id : e },
            url : "/produccion/insumo/eliminar"
        }).done(function(result){
            console.log(result);
            $("#tbl_asociar_insumo").empty();
            $.each(result.session, function(i, v){
                $("#tbl_asociar_insumo").append('<tr><td>'+v.nombre+'</td>\n\
                <td>'+v.cantidad+'</td><td>'+v.unidad_medida+'</td>\n\
                <td><button class="btn btn-icon white" title="Eliminar" \n\
                onclick="funciones.eliminar_insumo('+v.insumo+');" type="button">\n\
                <i class="fa fa-trash" ></i></button></td></tr>');
            });
            $("#insumo_id").append('<option id="select_'+result.insumoEliminado.insumo+'" \n\
            value ="'+result.insumoEliminado.insumo+'">'+result.insumoEliminado.nombre+'</option')
        });
    }
}
</script>
@endsection
