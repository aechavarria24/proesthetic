@extends('layouts.app')
@section('titulo') Pedido
@endsection @section('contenedor')
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
                          @foreach ($paciente as $values)
                        <label>Cedula del paciente</label>
                        <input class="form-control" required="" data-parsley-id="136" type="text" name="cedula" value="{{$values->cedula}}">
                        @endforeach
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nombre Paciente</label>
                        <input class="form-control" required="" data-parsley-id="136" type="text" name="nombre" value="{{$values->nombre}}" >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="box">

                <div class="box-body">


              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-7">

          <div class="box">
            <div class="box-header">
              Medidas de la pieza
            </div>

              <div class="">
                <table class="table table-striped b-t">
          <thead>
            <tr>
              <th>#</th>
              <th>Cantidad</th>
              <th>Dimensión</th>
              <th>Unidad de medida</th>
              <th>Editar</th>
            </tr>
          </thead>
          <tbody>
              <?php
              $tabla="";
      $acumulador=1;
      foreach ($medida_Pieza as  $value) {
          # code...

        $tabla.='<tr data-valor ="F-'.$acumulador.'" table table-striped b-t">';
        $tabla.='<td>'.$acumulador++.' </td>';
        $tabla.='<td>'.$value['cantidad'].' </td>';
        $tabla.='<td>'.$value['dimension'].' </td>';
        $tabla.='<td>'.$value['unidadMedidad'].' </td>';
        // $tabla.='<td>'.$value['observacion'].' </td>';
        $tabla.='<td value="'.$acumulador.'"><i id="'.$value["id"].'"  onclick="editarMedidaPieza(this);" class="glyphicon glyphicon-edit" title="Editar Medida"> </td>';
        $tabla.='</tr>';

    }
    $acumulador++;

               echo $tabla; ?>




              </td>

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
@section('script')

<script type="text/javascript">
function editarMedidaPieza(e) {
    var id = $(e).attr("id");
    alert(id);

}

</script>
@endsection
