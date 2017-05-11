@extends('layouts.App')
@section('titulo') Editar contrato
@endsection
@section('contenedor')
<div class="box">
  <div class="box-header">
    <h2>Editar</h2>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-4 offset-sm-4">
          {{Form::model($contrato, ['route' => ['contrato.update',$contrato->id],'method' => 'put', 'id'=>'frmContrato'])}}
            {{csrf_field()}}

        <div class="form-group">
          <label>Nombre</label>
          {{Form::text('nombre', null,['maxlength'=>'50','class'=>'form-control', 'id'=>'nombre'])}}

        </div>
        <div class="form-group">
          <label>Descripción</label>
          {{Form::textarea('descripcion', null,['class'=>'form-control'])}}

          <!-- <textarea name="descripcion" class="form-control" rows="8" cols="80"></textarea> -->
        </div>
        <div class=" p-a text-center">
          <button type="submit" class="btn btn-warning">Modificar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
