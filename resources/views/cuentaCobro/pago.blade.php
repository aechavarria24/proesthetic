@extends('layouts.app')
@section('titulo') Cuentas de cobro
@endsection
@section('contenedor')
<div class="box">
  <div class="box-body">
    <div class="padding">
      <div class="row">
        <div class="col-sm-12">
          <div class="box">
            <div class="box-header">
              <h3><b>Reporte total</b></h3>
            </div>
            <div class="box-body">
              <div class="row">

                <div class="col-md-6">
                <div class="form-group">
                    <label>Nombre de la clícina</label>
                    @foreach($usuarioClinica as $values)
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="usuarioClinica" disabled="false" value="{{$values->usuarioClinica}}">
                    <input type="hidden" id = "usuario_id" name="usuario_id" value="{{$values->id}}">
                    @endforeach
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label>Nombre Doctor</label>
                    @foreach($usuarioClinica as $values)
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="usuarioClinica" disabled="false" value="{{$values->NombreDoctor}} {{$values->ApellidoDocto}}">
                    <input type="hidden" id = "usuario_id" name="usuario_id" value="{{$values->id}}">
                    @endforeach
                </div>
                </div>
                <div class="col-md-4">
                  <!-- <div class="form-group">
                    <label>Fecha de solicitud</label>
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="cedula" value="" readonly="">
                  </div> -->
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class=" p-a text-center">
          <strong><h3>Total a pagar : $<?=$pago ?></h3></strong>
        </div>
        <div class=" p-a text-center">
          <a href="/cuentacobro" class="btn btn-primary">Confirmar pago</a>
        </div>






    </div>
  </div>
</div>
</div>
@endsection
