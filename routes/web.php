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


Route::get('servicio/get', 'servicioController@getData');
Route::get('contrato/get', 'contratoController@getData');
Route::get('proveedor/get', 'proveedorController@getData');
Route::get('usuarioClinica/get', 'usuarioClinicaController@getData');
Route::get('usuario/get', 'usuarioController@getData');
Route::get('clinica/get', 'clinica@getData');
Route::get('produccion/get', 'ordenProduccionController@getData');
Route::get('pedido/get', 'pedidoController@getData');
Route::get('pedido/traer/valor/{id}', 'pedidoController@get_valor');
Route::get('pedido/detalle', 'pedidoController@detalle');
Route::get('produccion/{id}/detalle', 'ordenProduccionController@detalle');
Route::get('venta/get', 'ventaController@getData');

Route::get('empleado/get', 'empleadoController@getData');
Route::post('empleado/validar_empleado', 'empleadoController@validar_empleado');

Route::post('pedido/agregarPieza', 'pedidoController@add_medida_pieza_tabla');
Route::post('pedido/eliminarPieza', 'pedidoController@delete_medida_pieza_tabla');
Route::post('pedido/cancelarPedido', 'pedidoController@cancelarPedido');


Route::resource('servicio','servicioController');
Route::resource('contrato','contratoController');
Route::resource('clinica','clinicaController');
Route::resource('usuario','usuarioClinicaController');
Route::resource('proveedor', 'proveedorController');
Route::resource('insumo','insumoController');
Route::resource('pedido','pedidoController');
Route::resource('produccion', 'ordenProduccionController');
Route::resource('venta', 'ventaController');
Route::resource('empleado', 'empleadoController');
