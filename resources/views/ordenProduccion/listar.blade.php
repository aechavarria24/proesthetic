@extends('layouts.app')
@section('titulo')
Orden de producción
@endsection
@section('contenedor')
<div class="box">
  <div class="box-header">
    <h2>Lista de ordenes de producción</h2>
  </div>
  <div class="box-body">
    <table class="table table-striped b-t b-b" id="tblordenProduccion">
      <thead>
        <tr>
          <th  style="width:1%">Número orden</th>
          <th  style="width:1%">Fecha creación</th>
          <th  style="width:1%">Fecha finalizacion</th>
          <th  style="width:1%">Estado</th>
          <th  style="width:1%">Opciones</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="mdlEstado">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <label for="">Su estado actual es: <span id="estadoActual"></span> </label>
        <select class="form-control" ="" id="ddlEstados">
          
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@section ('script')
<script type="text/javascript">
 function detalle(id){   

    $.ajax({
        'dataType':'json',
        'type':'get',
        'url':'/produccion/detalle/'+id
    }).done(function (e){
      if(e.data ==1){
        new PNotify ({
          title: 'Espera',
          text: 'No hay datos para mostrar',
          type: 'error'
        });

      }else{
        
        
        $("#estadoActual").text(e.estado);
        $.each(e.data[0], function(i, e){
          $("#ddlEstados").append("<option value='"+e.id+"'>"+e.nombre+"</option>");
        })
        $("#ddlEstados").removeAttr('hidden');
         // $("#mdlEstado").modal();
      }

  })};
  

$('#tblordenProduccion').DataTable({
  processing: true,
  serverSide: true,
  "language": {
    "url": "/plugins/dataTables/Spanish.json"
  },
  ajax: '/produccion/get',
  columns: [
    {data: 'id', name: 'Numero orden'},
    {data: 'created_at', name: 'Fecha creación'},
    {data: 'fechaFin', name: 'Fecha finalizacion'},
    {data: 'estado_orden_produccion', name: 'estado_orden_produccion'},
    {data: 'action', name: 'action', orderable: false,searchable: false}
  ]
});

</script>
@endsection
