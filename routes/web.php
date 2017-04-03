<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

//----------------------------------Rutas de clinica----------------------------------//

//--POST--//
Route::post('clinica/estado/editar', 'clinicaController@cambiar_estado');

//--GET--//
Route::get('clinica/get','clinicaController@getData');

Route::resource('clinica','clinicaController');
//------------------------------------------------------------------------------------//
//------------------------------Fin rutas de clinica----------------------------------//
//------------------------------------------------------------------------------------//



//--------------------------Rutas de usuarios de la clinica---------------------------//

//--POST--//


//--GET--//
Route::get('usuarioClinica/get', 'usuarioClinicaController@getData');
Route::get('usuario/get', 'usuarioController@getData');

Route::resource('usuario','usuarioClinicaController');
//------------------------------------------------------------------------------------//
//----------------------Fin rutas de usuarios de la clinica---------------------------//
//------------------------------------------------------------------------------------//



//------------------------------Rutas de empleado-------------------------------------//

//--POST--//
Route::post('empleado/validar_empleado', 'empleadoController@validar_empleado');

//--GET--//
Route::get('empleado/get', 'empleadoController@getData');

Route::resource('empleado', 'empleadoController');
//------------------------------------------------------------------------------------//
//------------------------------Fin rutas de empleado---------------------------------//
//------------------------------------------------------------------------------------//




//-------------------------------Rutas de pedido--------------------------------------//

//--POST--//
Route::post('pedido/agregarPieza', 'pedidoController@add_medida_pieza_tabla');
Route::post('pedido/eliminarPieza', 'pedidoController@delete_medida_pieza_tabla');
Route::post('pedido/cancelarPedido', 'pedidoController@cancelarPedido');

//--GET--//
Route::get('pedido/get', 'pedidoController@getData');
Route::get('pedido/traer/valor/{id}', 'pedidoController@get_valor');
Route::get('pedido/detalle', 'pedidoController@detalle');

Route::resource('pedido','pedidoController');
//------------------------------------------------------------------------------------//
//---------------------------Fin rutas de pedido--------------------------------------//
//------------------------------------------------------------------------------------//




//----------------------------Rutas de orden de produccion----------------------------//

//--POST--//

//--GET--//
Route::get('produccion/get', 'ordenProduccionController@getData');
Route::get('produccion/detalle/{id}', 'ordenProduccionController@detalle');

Route::resource('produccion', 'ordenProduccionController');
//------------------------------------------------------------------------------------//
//--------------------------Fin Rutas de orden de produccion--------------------------//
//------------------------------------------------------------------------------------//




//-----------------------Rutas de insumo por orden de produccion----------------------//
Route::resource('insumoordenproduccion','insumoOrdenProduccionController');

//--POST--//

//--GET--//
//------------------------------------------------------------------------------------//
//--------------------Fin rutas de insumo por orden de produccion---------------------//
//------------------------------------------------------------------------------------//




//-------------------------------Rutas de insumo--------------------------------------//

//--POST--//

//--GET--//
Route::get('insumo/get', 'insumoController@getData');

Route::resource('insumo','insumoController');
//------------------------------------------------------------------------------------//
//------------------------------Fin rutas de insumo-----------------------------------//
//------------------------------------------------------------------------------------//




//--------------------------------Rutas de servicio-----------------------------------//
//--GET--//
Route::get('servicio/get', 'servicioController@getData');

//--POST--//

Route::resource('servicio','servicioController');
//------------------------------------------------------------------------------------//
//----------------------------Fin rutas de servicio-----------------------------------//
//------------------------------------------------------------------------------------//


//--------------------------------Rutas de contrato-----------------------------------//

//--POST--//

//--GET--//
Route::get('contrato/get', 'contratoController@getData');


Route::resource('contrato','contratoController');
//------------------------------------------------------------------------------------//
//-----------------------------Fin rutas de contrato----------------------------------//
//------------------------------------------------------------------------------------//




//------------------------------Rutas de proveedor------------------------------------//
//--POST--//

//--GET--//
Route::get('proveedor/pdf', 'proveedorController@generar_pdf');
Route::get('proveedor/get', 'proveedorController@getData');

Route::resource('proveedor', 'proveedorController');
//------------------------------------------------------------------------------------//
//----------------------------Fin rutas de proveedor----------------------------------//
//------------------------------------------------------------------------------------//




//-------------------------------Rutas de Venta------------------------------------//

//--POST--//

//--GET--//
Route::get('venta/get', 'ventaController@getData');
Route::get('venta/detalle', 'ventaController@detalle');

Route::resource('venta', 'ventaController');
//------------------------------------------------------------------------------------//
//--------------------------------Fin rutas de Venta----------------------------------//
//------------------------------------------------------------------------------------//

//----------------------------Rutas de orden de cuenta de cobro----------------------------//

//--POST--//

//--GET--//
Route::get('cuentacobro/get', 'cuentaCobroController@getData');
Route::get('cuentacobro/detalle', 'cuentaCobroController@detalle');

Route::get('cuentacobro/pago', 'cuentaCobroController@create');

Route::resource('cuentacobro', 'cuentaCobroController');
//------------------------------------------------------------------------------------//
//--------------------------Fin Rutas de cuenta de cobro-------------------------//
//------------------------------------------------------------------------------------//
