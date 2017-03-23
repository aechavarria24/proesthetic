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
Route::resource('clinica','clinicaController');

//--POST--//
Route::post('clinica/estado/editar', 'clinicaController@cambiar_estado');

//--GET--//
Route::get('clinica/get','clinicaController@getData');
//------------------------------------------------------------------------------------//
//------------------------------Fin rutas de clinica----------------------------------//
//------------------------------------------------------------------------------------//



//--------------------------Rutas de usuarios de la clinica---------------------------//
Route::resource('usuario','usuarioClinicaController');

//--POST--//


//--GET--//
Route::get('usuarioClinica/get', 'usuarioClinicaController@getData');
Route::get('usuario/get', 'usuarioController@getData');
//------------------------------------------------------------------------------------//
//----------------------Fin rutas de usuarios de la clinica---------------------------//
//------------------------------------------------------------------------------------//



//------------------------------Rutas de empleado-------------------------------------//
Route::resource('empleado', 'empleadoController');

//--POST--//
Route::post('empleado/validar_empleado', 'empleadoController@validar_empleado');

//--GET--//
Route::get('empleado/get', 'empleadoController@getData');
//------------------------------------------------------------------------------------//
//------------------------------Fin rutas de empleado---------------------------------//
//------------------------------------------------------------------------------------//




//-------------------------------Rutas de pedido--------------------------------------//
Route::resource('pedido','pedidoController');

//--POST--//
Route::post('pedido/agregarPieza', 'pedidoController@add_medida_pieza_tabla');
Route::post('pedido/eliminarPieza', 'pedidoController@delete_medida_pieza_tabla');
Route::post('pedido/cancelarPedido', 'pedidoController@cancelarPedido');

//--GET--//
Route::get('pedido/get', 'pedidoController@getData');
Route::get('pedido/traer/valor/{id}', 'pedidoController@get_valor');
Route::get('pedido/detalle', 'pedidoController@detalle');
//------------------------------------------------------------------------------------//
//---------------------------Fin rutas de pedido--------------------------------------//
//------------------------------------------------------------------------------------//




//----------------------------Rutas de orden de produccion----------------------------//
Route::resource('produccion', 'ordenProduccionController');

//--POST--//

//--GET--//
Route::get('produccion/get', 'ordenProduccionController@getData');
Route::get('produccion/detalle/{id}', 'ordenProduccionController@detalle');
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
Route::resource('insumo','insumoController');

//--POST--//

//--GET--//
Route::get('insumo/get', 'insumoController@getData');
//------------------------------------------------------------------------------------//
//------------------------------Fin rutas de insumo-----------------------------------//
//------------------------------------------------------------------------------------//





//--------------------------------Rutas de servicio-----------------------------------//
Route::resource('servicio','servicioController');

//--POST--//

//--GET--//
Route::get('servicio/get', 'servicioController@getData');
//------------------------------------------------------------------------------------//
//----------------------------Fin rutas de servicio-----------------------------------//
//------------------------------------------------------------------------------------//


//--------------------------------Rutas de contrato-----------------------------------//
Route::resource('contrato','contratoController');

//--POST--//

//--GET--//
Route::get('contrato/get', 'contratoController@getData');
//------------------------------------------------------------------------------------//
//-----------------------------Fin rutas de contrato----------------------------------//
//------------------------------------------------------------------------------------//




//------------------------------Rutas de proveedor------------------------------------//
Route::resource('proveedor', 'proveedorController');

//--POST--//

//--GET--//
Route::get('proveedor/pdf', 'proveedorController@generar_pdf');
Route::get('proveedor/get', 'proveedorController@getData');
//------------------------------------------------------------------------------------//
//----------------------------Fin rutas de proveedor----------------------------------//
//------------------------------------------------------------------------------------//




//-------------------------------Rutas de Venta------------------------------------//
Route::resource('venta', 'ventaController');

//--POST--//

//--GET--//
Route::get('venta/get', 'ventaController@getData');
//------------------------------------------------------------------------------------//
//--------------------------------Fin rutas de Venta----------------------------------//
//------------------------------------------------------------------------------------//
