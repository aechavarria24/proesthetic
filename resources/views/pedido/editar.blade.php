@extends('layouts.app') @section('titulo') Pedido @endsection @section('contenedor')
<div class="box">
  <div class="box-header">
    <h2>Editar</h2>
  </div>
  <div class="box-body">
    <div class="padding">
      <div class="row">
          {{Form::model($pedido, ['route' => ['pedido.update',$pedido->id],'method' => 'put'])}}
          {{csrf_field()}}
          <div class="col-sm-5">
            <div class="col-lg-12">
              <div class="box">
                <div class="box-header">
                  Paciente
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Cedula del paciente</label>
                        <input class="form-control" required="" data-parsley-id="136" type="text" name="nombre">
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
                  Detalles del pedido
                </div>
                <div class="box-body">
                  <div class="form-group">
                    <label>Nombre Doctor</label>
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="nombre" disabled="" value="Test doctor 1">
                  </div>
                  <div class="form-group">
                    <label>Contrato</label>
                    <select class="form-control c-select" name="proveedor">
                      @foreach($servicio_tipoContrato_id as $values)
                      <option value="{{$values->id}}"> {{$values->servicio_tipoContrato_id}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <div class="input-group date" data-ui-jp="datetimepicker" data-ui-options="{
                      format: 'DD/MM/YYYY',
                      icons: {
                        time: 'fa fa-clock-o',
                        date: 'fa fa-calendar',
                        up: 'fa fa-chevron-up',
                        down: 'fa fa-chevron-down',
                        previous: 'fa fa-chevron-left',
                        next: 'fa fa-chevron-right',
                        today: 'fa fa-screenshot',
                        clear: 'fa fa-trash',
                        close: 'fa fa-remove'
                      }
                    }">
                    <input class="form-control has-value" type="text">
                    <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-7">

          <div class="box">
            <div class="box-header">
              Medidas de la pieza
            </div>
            <div class="box-body">
              <div class="form-inline">
                <div class="form-group">
                  <label class="sr-only" for="exampleInputEmail2">Cantidad</label>
                  <input class="form-control" id="txtCant" placeholder="Cantidad" type="number">
                </div>
                <div class="form-group">
                  <label class="sr-only" for="exampleInputEmail2">Unidad de medida</label>
                  <input class="form-control" id="txtUnidadM" placeholder="Unidad de medida" type="text" title = "Centimetros, Milimetros, Radianes">
                </div>
                <div class="form-group">
                  <label class="sr-only" for="exampleInputEmail2">Dimensión</label>
                  <input class="form-control" id="txtDimension" placeholder="Dimension" type="text">
                </div>
                &nbsp;
                &nbsp;
                <div class="form-group">
                  <button class="btn btn-icon white">
                    <i class="fa fa-plus"></i>
                  </button>
                </div>





              </div>
              <div class="box-divider m-a-0"></div>

              </div>
              <div class="">
                <table class="table table-striped b-t">
          <thead>
            <tr>
              <th>#</th>
              <th>Cantidad</th>
              <th>Dimensión</th>
              <th>Unidad de medida</th>
              <th>Opción</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>3</td>
              <td>Alto</td>
              <td>Centimetros</td>
              <td>
                <button class="btn btn-icon white">
                  <i class="fa fa-trash"></i>
                </button>
              </td>

            </tr>
            <tr>
              <td>2</td>
              <td>2</td>
              <td>Ancho</td>
              <td>Milimetros</td>
              <td>
                <button class="btn btn-icon white">
                  <i class="fa fa-trash"></i>
                </button>
              </td>

            </tr>
            <tr>
              <td>3</td>
              <td>...</td>
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
        <div class="col-sm-12">
          <div class=" p-a text-center">
            <button type="submit" class="btn info">Registrar</button>
          </div>

        </div>









      </div>
    </form>
  </div>
</div>

</div>
</div>
@endsection
