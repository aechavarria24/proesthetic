@extends('layouts.app')
@section('titulo') Detalle pedido
@endsection
@section('contenedor')
<div class="box">
    <div class="box-header">
        <h2>Pedido</h2>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-4 offset-sm-1">
                <div class="form-group">
                    @foreach ($pedido as $valor)
                    @endforeach
                    <label>Número pedido </label>
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="id" readonly="" value="{{$valor->id}}">
                </div>
                <div class="form-group">
                    <label>Clinica</label>
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="idusuario" readonly="" value="{{$valor->nombre}}">
                </div>
                <div class="form-group">
                    <label>Fecha entrega</label>
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="pedidoid" readonly="" value="{{$valor->fechaEntrega}}">
                </div>
                <div class="form-group">
                    <label>Paciente</label>
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="pedidoid" readonly="" value="{{$valor->pacienteNombre}}">
                </div>
                <div class="form-group">
                    <label>Cedula paciente</label>
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="pedidoid" readonly="" value="{{$valor->cedula}}">
                </div>
                <div class="form-group">
                    <label>Estado Pedido</label>
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="pedidoid" readonly="" value="{{$valor->estadoPedido}}">
                </div>
                <div class="form-group">
                    <label>Observación</label>
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="observacion" readonly="" value="{{$valor->observacion}}">
                </div>
                <div class=" p-a text-center">
                    <a class="btn btn-info" href="/pedido/show">Regresar</a>
                </div>
            </div>
            <div class="col-sm-6">

                <div class="box">
                    <div class="box-header">
                        Medidas de la pieza
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


@endsection
