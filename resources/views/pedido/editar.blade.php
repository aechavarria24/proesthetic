@extends('layouts.App')
@section('titulo') Pedido
@endsection @section('contenedor')
<div class="padding">
    <div class="box">
        <div class="box-header">
            <h2>Editar</h2>
        </div>
        <div class="box-body">
            <div class="padding">
                <div class="row">
                    {{Form::model($pedido, ['route' => ['pedido.update',$pedido->id],'method' => 'put', 'id'=>'frmEditarPedido'])}}
                    {{csrf_field()}}
                    <div class="col-sm-12">
                        <div class="col-lg-12">
                            <div class="box">
                                <div class="box-header">
                                    Paciente
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                @foreach ($paciente as $values)
                                                <label label='Cedula del paciente'>Cedula del paciente</label>
                                                <input class="form-control" required="" data-parsley-id="136" type="text" name="cedula" value="{{$values->cedula}}">
                                                <input class="form-control" type="hidden" required="" data-parsley-id="136" type="text" name="cedulaPaciente" value="{{$values->cedula}}">
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label label='Nombre Paciente'>Nombre Paciente</label>
                                                <input class="form-control" required="" data-parsley-id="136" type="text" name="nombre" value="{{$values->nombre}}" >
                                                <!-- <input type="hiiden" class="form-control" required="" data-parsley-id="136" type="text" name="nombrePciente" value="{{$values->id}}" > -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header">
                                Medidas de la pieza
                            </div>
                            <div class="box-body">
                                <table class="table table-striped b-t col-md-12">
                                    <thead>
                                        <tr>
                                            <th>Servicio</th>
                                            <th>Cantidad</th>
                                            <th>Dimensión</th>
                                            <th>Unidad de medida</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($medida_pieza as $valor)
                                        <tr>
                                            <td>
                                                <input readonly="true" class="form-control" value="{{$valor->servicio}}">
                                            </td>
                                            <td>
                                                <input class="form-control" type="hidden"  id="{{$valor->id_pieza}}'" name="id_pieza[]"  type="number" value="{{$valor->id_pieza}}">
                                                <input class="form-control" name="cantidad[]" id="txtCant-{{$valor->id_pieza}}" placeholder="Cantidad" type="number" value="{{$valor->cantidad}}">
                                            </td>
                                            <td>
                                                <!-- <select class="form-control c-select" name="unidadMedida[]" id="{{$valor->id_pieza}}" type="hidden" value="{{$valor->id_pieza}}"> -->
                                                <select class="form-control c-select" name="unidadMedida[]" id="{{$valor->id_pieza}}" value="">
                                                    @if( '{{$valor->unidadMedidad}}' == "MM")
                                                    <option value="MM" >MM</option>
                                                    <option value="CM">CM</option>
                                                    @else
                                                    <option value="MM">MM</option>
                                                    <option value="CM" selected="">CM</option>
                                                    @endif


                                                </select>
                                            </td>
                                            <td>
                                                <!-- <select class="form-control c-select" type="hidden" name="dimension[]" id="{{$valor->id_pieza}}" value="{{$valor->id_pieza}}"> -->
                                                <select class="form-control c-select" name="dimension[]" id="{{$valor->id_pieza}}" value="">
                                                    <option value="ALTO">ALTO</option>
                                                    <option value="LARGO">LARGO</option>
                                                    <option value="ANCHO">ANCHO</option>
                                                    <option value="RADIO">RADIO</option>
                                                </select>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5" id="containerMedidaPieza">

                    </div>

                    <div class="col-sm-12">
                        <div class=" p-a text-center">
                            <button type="submit"  class="btn success">Actualizar</button>
                            <a type="button" class="btn info" name="button" href="/pedido/show">Regresar</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>


@section('script')

<script type="text/javascript">
$("#frmEditarPedido").validate({
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
            personName : true,
            minlength: 5,
            maxlength: 45
        },
        cedula: {
            required: true,
            digits: true,
            minlength: 7,
            maxlength: 13,
        },
        cantidad: {
            required: true,
            minlength: 10,
            maxlength: 10
        },
        containerMedidaPieza: {
            required: true,
            minlength: 10,
            maxlength: 10
        },
        id_pieza :{
            digits : true
        }
    }
});

// function guardar(){
//
//     // var idTabla=id.split('-');
//     // var cantidad=($("#txtCant-"+idTabla[0]).val());
//     var cantidad=($("#txtCant").val());
//     if (cantidad.length==0||cantidad<=0||cantidad=="") {
//
//         new PNotify({
//             title : 'Atención...',
//             text : 'Por favor ingrese una cantidad valida en la medida de la pieza',
//             type : 'error'
//         });
//     }else {
//         $("#frmEditarPedido").submit();
// }
// }


</script>
@endsection
