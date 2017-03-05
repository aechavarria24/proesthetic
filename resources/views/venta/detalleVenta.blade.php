@extends('layouts.app')
@section('titulo') Vista de venta
@endsection
@section('contenedor')
<div class="box">
  <div class="box-body">
    <div class="padding">
      <div class="row">
        <div class="col-sm-12">
          <div class="box">
            <div class="box-header">
              Clínica
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Nombre de la clícina</label>
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="cedula" value="Clínica" readonly="">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Nombre del doctor</label>
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="cedula" value="Clínica" readonly="">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Fecha de solicitud</label>
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="cedula" value="Clínica" readonly="">
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="box">
            <div class="box-header">
              Información de la pieza
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Número de pedido</label>
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="cedula" value="Clínica" readonly="">
                  </div>
                  <div class="form-group">
                    <label>Fecha de solicitud</label>
                    <input class="form-control" required="" data-parsley-id="136" type="date" name="cedula" value="" readonly="">
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Valor</label>
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="cedula" value="Clínica" readonly="">
                  </div>
                  <div class="form-group">
                    <label>Estado</label>
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="cedula" value="Clínica" readonly="">
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
            <div class="">

              <table class="table table-striped b-t">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Cantidad</th>
                    <th>Dimensión</th>
                    <th>Unidad de medida</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>3</td>
                    <td>Alto</td>
                    <td>Centimetros</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>2</td>
                    <td>Ancho</td>
                    <td>Milimetros</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>
</div>
</div>
@endsection
