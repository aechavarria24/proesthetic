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
Route::post('clinica/estado/editar', 'clinicaController@cambiar_estado');
Route::post('produccion/estado/editar', 'ordenProduccionController@cambiar_estado');
Route::get('insucant/addInsumo', 'ordenProduccionController@add_Insumo');
Route::get('insumo/eliminar_tabla_asociar', 'ordenProduccionController@eliminar_tabla_asociar');
Route::get('produccion/get', 'ordenProduccionController@getData');
Route::get('pedido/get', 'pedidoController@getData');
Route::get('pedido/detalle', 'pedidoController@detalle');
Route::get('produccion/detalle/{id}', 'ordenProduccionController@detalle');
Route::get('venta/get', 'ventaController@getData');
Route::get('clinica/get','clinicaController@getData');
Route::get('produccion/asociar/insumo/{id}','ordenProduccionController@asociar_Insumo');

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

