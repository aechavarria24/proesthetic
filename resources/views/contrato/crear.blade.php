@extends('layouts.app') @section('titulo') Contrato @endsection @section('contenedor')
<div class="box">
  <div class="box-header">
    <h2>Registrar</h2>
  </div>
  <div class="box-body">
    <div class="padding">
      <div class="row">
        <form data-ui-jp="parsley" novalidate="" method="post" action="/contrato">
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
                        <label>Nombre del Contrato</label>
                        <input class="form-control" required="" data-parsley-id="136" type="text" name="nombre">
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="8" cols="80"></textarea> 
                      </div>
                    </div>
                  </div>
                </div>
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
                    <select class="form-control c-select">
                      <option> </option>
                      <option></option>
                      <option></option>
                      <option> </option>
                      <option></option>
                  </select>
                </div>  

                  </div>
                  
                  
                
                <div class="col-sm-4">
                  <div class="form-group">
                  <label>Valor</label>
                  <input class="form-control" id="txtUnidadM" placeholder="Valor" type="text" title = "Centimetros, Milimetros, Radianes">
                </div>  

                </div>

                <div class = "col-sm-2">
                  <div class="form-group">
                  <button class="btn btn-icon white">
                    <i class="fa fa-plus"></i>
                  </button>
                </div>
                </div>
                </div>


                
                
                
              
              <div class="box-divider m-a-0"></div>

              </div>
              <div class="">
                <table class="table table-striped b-t">
          <thead>
            <tr>
              <th>#</th>
              <th>Tipo de Servicio</th>
              <th>valor</th>
              <th>Opción</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <button class="btn btn-icon white">
                  <i class="fa fa-trash"></i>
                </button>
              </td>

            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <button class="btn btn-icon white">
                  <i class="fa fa-trash"></i>
                </button>
              </td>

            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
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
