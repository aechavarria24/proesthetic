@extends('layouts.app')
@section('titulo') Vista de cuenta de cobro
@endsection
@section('contenedor')
<div class="box">
  <div class="box-body">
    <div class="padding">
      <div class="row">
        <div class="col-sm-12">
          <div class="box">
            <div class="box-header">
              Cuenta de cobro
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Nombre de la clícina</label>
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="cedula" value="Clínica soma" readonly="">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Nombre del doctor</label>
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="cedula" value="Duban" readonly="">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Fecha de solicitud</label>
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="cedula" value="30-03-2017" readonly="">
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class=" p-a text-center">
          <strong><h3>Total a pagar : $307.000 </h3></strong>
        </div>
        <div class=" p-a text-center">
          <a href="/cuentacobro" class="btn btn-primary">Confirmar pago</a>
        </div>






    </div>
  </div>
</div>
</div>
@endsection
