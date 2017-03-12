@extends('layouts.app')
@section('titulo')
Pedido
@endsection
@section('contenedor')
<div class="box">
  <div class="box-header">
    <h2>Registrar</h2>
  </div>
  <div class="box-body">
    <div class="padding">
      <div class="row">
        <form data-ui-jp="parsley" novalidate="" method="post" action="/pedido">
          {{csrf_field()}}
          <div class="col-sm-6">
            <div class="col-lg-12">
              <div class="box">
                <div class="box-header">
                  Paciente
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Cedula del paciente</label>
                        <input class="form-control" required="" data-parsley-id="136" type="text" name="cedula">
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
                  Datos clínica
                </div>
                <div class="box-body">
                  <div class="form-group">
                    <label>Nombre Doctor</label>
                    @foreach($usuarioClinica as $values)
                    <input class="form-control" required="" data-parsley-id="136" type="text" name="usuarioClinica" disabled="false" value="{{$values->nombre}} {{$values->apellido}}">
                    @endforeach

                  </div>
                  <div class="form-group">
                    <div class="form-group">
                      <label>Cínica</label>
                      <input class="form-control" required="" data-parsley-id="136" type="text" name="nombre"  disabled="false">
                    </div>
                  </div>
                  <h6>Fecha entrega</h6>
                  <div class="input-group date">
                    <input type="text" class="form-control" id="datepicker" >
                    <div class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="col-sm-12">
              <div class="box">
                <div class="box-header">

                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Servicio</label>
                        <select class="form-control c-select" name="servicio" id="cbxServicio"  onchange="cambiar_valor_servicio(this)">
                          <option value=""></option>
                          @foreach($servicio as $values)
                          <option value="{{$values->id}}" id=""> {{$values->nombre}}</option>
                            <br type="text" name="" id="optServicio" hidden="true" value="{{$values->nombre}}">
                          @endforeach



                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Valor</label>
                        <input class="form-control" required="" data-parsley-id="136" type="text" id="valor" disabled="" name="valor">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class=" p-a text-center">
                        <button type="button" onclick = "AgregarServicio();" class="btn info">Agregar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12" id="containerMedidaPieza">
            </div>
          </div>
          <div class="col-sm-12">
            <div class=" p-a text-center">
              <button type="submit" class="btn info">Registrar</button>
            </div>

          </div>
        </div>

      </div>
    </form>
  </div>
</div>

</div>
</div>
@endsection

@section ('script')
<script type="text/javascript">

$('#cbxServicio').select2();
$('#datepicker').datepicker({
  format: 'yyyy-mm-dd',
});



</script>
@endsection
