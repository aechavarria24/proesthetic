@extends('layouts.app')
@section('titulo') Detalle de venta
@endsection
@section('contenedor')
<div class="box">
  <div class="box-body">
    <div class="padding">
      <div class="row">
        <div class="col-sm-12">
          <div class="box">
            <div class="box-header">
              Datos
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Nombre de la clínica</label>
                    @foreach($venta as $values)
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="cedula" value="{{$values->nombreClinica}}" readonly="">
                    @endforeach
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Nombre del doctor</label>
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="cedula" value="{{$values->nombreDoctor}} {{$values->apellidoDoctor}}" readonly="">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Fecha de solicitud pedido</label>
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="cedula" value="{{$values->fechaSolicitud}}" readonly="">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Fecha de solicitud entrega pedido</label>
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="cedula" value="{{$values->fechaEntrega}}" readonly="">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Número de pedido</label>
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="cedula" value="{{$values->pedido}}" readonly="">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Número de venta</label>
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="cedula" value="{{$values->venta}}" readonly="">
                  </div>
                </div>

              </div>

            </div>
          </div>
          <div class=" p-a text-center">
            <a class="btn btn-info" href="/venta/show">Regresar</a>
          </div>
        </div>



    </div>
  </div>
</div>
</div>
@endsection
