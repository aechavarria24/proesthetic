@extends('layouts.app')
@section('titulo') Pedido
@endsection @section('contenedor')
<div class="padding">
    <div class="box">
      <div class="box-header">
        <h2>Editar</h2>
      </div>
      <div class="box-body">
        <div class="padding">
          <div class="row">
              {{Form::model($pedido, ['route' => ['pedido.update',$pedido->id],'method' => 'put'])}}
              {{csrf_field()}}
              <div class="col-sm-12">
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
            $tabla.='<td value="'.$acumulador.'"><i id="'.$value["id_pieza"].'"  onclick="editarMedidaPieza(this);" class="glyphicon glyphicon-edit" title="Editar Medida"> </td>';
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
              <div class="col-sm-5" id="containerMedidaPieza">
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
</div>

@section('script')

<script type="text/javascript">
function editarMedidaPieza(e) {
    var id_pieza = $(e).attr("id");
    $("#containerMedidaPieza").append(
        '<div class="box" name="containerMedidaPieza">'
        +'<div class="box-header" >'
        +'</div>'
        +'<div class="box-body">'
        +'<div class="row">'
        +'<div style = "padding-top: 1%;">'
        +'<table class="table table-striped b-t">'
        +'<thead>'
        +'<tr>'
        +'<th>Cantidad</th>'
        +'<th>Dimensión</th>'
        +'<th>Unidad de medida</th>'
        +'<th>Opción</th>'
        +'</tr>'
        +'</thead>'
        +'<tbody id="t-'+id_pieza+'">'
        +'</tbody>'
        +'</table>'
        +'</div>'
        +'<div class="col-xs-3">'
        +'<input class="form-control" type="hidden"  id="servi-'+id_pieza+'" name="id_pieza" type="number" value="'+id_pieza+'">'
        +'<input class="form-control" name="cantidad" id="txtCant-'+id_pieza+'" placeholder="Cantidad" type="number" value="">'
        +	'</div>'
        +'<div class=" col-xs-4">'
        +'<select class="form-control c-select" name="unidadMedida" id="selectUnidadMedida-'+id_pieza+'" value="">'
        +'<option value="MM">MM</option>'
        +'<option value="CM">CM</option>'
        +'</select>'
        +'</div>'
        +'<div class="col-xs-3">'
        +'<select class="form-control c-select" name="dimension" id="selectDimension-'+id_pieza+'" value="">'
        +'<option value="ALTO">ALTO</option>'
        +'<option value="LARGO">LARGO</option>'
        +'<option value="ANCHO">ANCHO</option>'
        +'<option value="RADIO">RADIO</option>'
        +'</select>'
        +'</div>'
        +'<div>'
        +'<div class="col-xs-1">'
        +'<button id="'+id_pieza+'-btn" title="Adicionar" value="'+id_pieza+'" onclick="AgregarMedidaPieza(this);" class="btn btn-icon white" type="button">'
        // + '<input id="_token" name="_token" type="hidden" value="{{csrf_token()}}">'
        +'<i class="fa fa-plus" href="#"></i>'
        +'</button>'
        +'</div>'
        +'</div>'
        +'<div class="box-divider m-a-0"></div>'

        +'</div>'

        +'</div>'
        +'</div>'
    );
    id_pieza++;


}

</script>
@endsection
