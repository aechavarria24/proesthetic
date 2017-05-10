@extends('layouts.App')
@section('titulo')
Asosciar insumo
@endsection

@section('contenedor')
<div class="box">
    <div class="box-header">
        <h2>Registrar</h2>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-5 offset-sm-3">
                <form data-ui-jp="parsley" novalidate="" method="post" action="/insumoordenproduccion" id="frmInsumoOrdenProduccion">
                    {{csrf_field()}}
                    <br>

                    <div class="form-group">
                        <label>Orden De Produccion </label>
                        <select class="form-control c-select" name="ordenproducion"  >

                            <option ></option>

                        </select>
                    </div>
                    <div class="box">
                        <div class="box-header">
                            Insumos
                        </div>
                        <div class="box-body">
                            <div class="form-inline">

                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputEmail2">Insumo</label>
                                    <input class="form-control" id="txtDimension" placeholder="Insumo" type="text">

                                </div>

                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputEmail2">Cantidad</label>
                                    <input class="form-control" id="txtDimension" placeholder="Cantidad" type="text">
                                </div>
                                &nbsp;
                                &nbsp;
                                <div class="form-group">
                                    <button class="btn btn-icon white">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>

                            </div>





                            <br>
                            <div class="box-divider m-a-0"></div>

                        </div><br>
                        <div class="">
                            <table class="table table-striped b-t">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Insumos</th>
                                        <th>Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Crema Dental</td>
                                        <td>2</td>

                                        <td>
                                            <button class="btn btn-icon white">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Listerine</td>
                                        <td>3</td>

                                        <td>
                                            <button class="btn btn-icon white">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>

                                    </tr>
                                    <tr>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class=" p-a text-center">
                        <button type="submit" class="btn info">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

$("#insumo").select2();
$("#frmInsumoOrdenProduccion").validate({
    rules: {
        nombre: {
            required: true,
            minlength: 5
        }
    }
});

</script>
@endsection
