@extends('layouts.app')
@section('titulo')
Retornar
@endsection
@section('contenedor')
<div class="box">
    <div class="box-header">
        <h2>Retorno de pedido</h2>
    </div>
    <div class="box-body">
        <form class="" action="/pedido/retornar" method="post">
            {{csrf_field()}}
            <div class="padding">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="box">
                            <div class="box-header">
                                Detalle del pedido
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Documento del paciente </label>
                                                <input class="form-control" required="" value="<?php echo $pedido["cedula"] ?>" data-parsley-id="136" type="text" name="documento" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Nombre del paciente</label>
                                                <input class="form-control" value="<?php echo $pedido["paciente"] ?>" required="" data-parsley-id="136" type="text" name="nombre_paciente" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Número Pedido</label>
                                                <input class="form-control" required="" value="<?php echo $pedido["nro_pedido"] ?>" data-parsley-id="136" type="text" name="nro_pedido" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Doctor</label>
                                                <input class="form-control" required="" value="<?php echo $pedido["doctor"] . " ". $pedido["apellido_doctor"] ?>" data-parsley-id="136" type="text" name="doctor" readonly="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Observación</label>
                                            <!-- <input class="form-control" value="" rows="8" cols="80" data-parsley-id="136" type="text" name="observacion" readonly=""> -->
                                            <textarea name="observacion" value="" rows="8" cols="80"></textarea>
                                        </div>
                                        <div class=" p-a text-center">
                                            <button type="submit" class="btn btn-info" name="button">Retornar</button>
                                            <a class="btn btn-warning" href="/pedido/show">Regresar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        </form>
    </div> <!-- fin box-body linea 10-->
</div>
@endsection
