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

/////////////////////////////////////// AUTH ////////////////////////////////////////////////////

Auth::routes();
Route::get('/registro/email', 'UserController@emailVerify');

///////////////////////////////////////////// WEB ////////////////////////////////////////////////

// Inicio
Route::get('/', 'WebController@index')->name('home');

//Tienda
Route::get('/menu', 'WebController@menu')->name('menu');
Route::get('/producto/{slug}', 'WebController@product')->name('producto');

//Pedidos
Route::get('/carrito', 'WebController@cart')->name('carrito.index');
Route::post('/carrito/producto', 'WebController@addProduct')->name('carrito.add.product');
Route::post('/carrito/agregar', 'WebController@addCart')->name('carrito.add');
Route::post('/carrito/quitar', 'WebController@removeCart')->name('carrito.remove');
Route::post('/carrito/cantidad', 'WebController@qtyCart')->name('carrito.qty');
Route::get('/pedido/{slug}', 'OrderController@show')->name('pedido.show');

//Pagos
Route::get('/comprar', 'WebController@checkout')->name('pago.create');
Route::post('/comprar', 'WebController@saleStore')->name('pago.store');

Route::group(['middleware' => ['auth']], function () {
	Route::get('/mis-compras', 'WebController@shopping')->name('pago.index');
	Route::get('/mis-compras/{slug}', 'WebController@orderProduct')->name('pago.order');

	///// //////////////////////////////////ADMIN ///////////////////////////////////////////////////
	Route::group(['middleware' => ['not.client']], function () {
		// Inicio
		Route::get('/maesma', 'AdminController@index')->name('admin');
	});

	Route::group(['middleware' => ['admin']], function () {
		
		//Productos
		Route::get('/maesma/productos', 'ProductController@index')->name('productos.index');
		Route::get('/maesma/productos/registrar', 'ProductController@create')->name('productos.create');
		Route::post('/maesma/productos', 'ProductController@store')->name('productos.store');
		Route::get('/maesma/productos/{slug}', 'ProductController@show')->name('productos.show');
		Route::get('/maesma/productos/{slug}/editar', 'ProductController@edit')->name('productos.edit');
		Route::put('/maesma/productos/{slug}', 'ProductController@update')->name('productos.update');
		Route::delete('/maesma/productos/eliminar/{slug}', 'ProductController@destroy')->name('productos.delete');

		//Distancias
		Route::get('/maesma/categorias', 'CategoryController@index')->name('categorias.index');
		Route::get('/maesma/categorias/registrar', 'CategoryController@create')->name('categorias.create');
		Route::post('/maesma/categorias', 'CategoryController@store')->name('categorias.store');
		Route::get('/maesma/categorias/{slug}', 'CategoryController@show')->name('categorias.show');
		Route::get('/maesma/categorias/{slug}/editar', 'CategoryController@edit')->name('categorias.edit');
		Route::put('/maesma/categorias/{slug}', 'CategoryController@update')->name('categorias.update');
		Route::delete('/maesma/categorias/eliminar/{slug}', 'CategoryController@destroy')->name('categorias.delete');

		//Tiendas
		Route::get('/maesma/tiendas', 'StoreController@index')->name('tienda.index');
		Route::get('/maesma/tiendas/{slug}/editar', 'StoreController@edit')->name('tienda.edit');
		Route::put('/maesma/tiendas/{slug}', 'StoreController@update')->name('tienda.update');
		Route::put('/maesma/tiendas/activar/{slug}', 'StoreController@activate')->name('tienda.activate');
		Route::put('/maesma/tiendas/desactivar/{slug}', 'StoreController@desactivate')->name('tienda.desactivate');

		//Usuarios
		Route::get('/maesma/usuarios', 'UserController@index')->name('usuario.index');
		Route::get('/maesma/usuarios/registrar', 'UserController@create')->name('usuario.create');
		Route::post('/maesma/usuarios', 'UserController@store')->name('usuario.store');
		Route::get('/maesma/usuarios/{slug}', 'UserController@show')->name('usuario.show');
		Route::get('/maesma/usuarios/{slug}/editar', 'UserController@edit')->name('usuario.edit');
		Route::put('/maesma/usuarios/inactivos', 'UserController@inactive')->name('usuario.inactivos');
		Route::put('/maesma/usuarios/{slug}', 'UserController@update')->name('usuario.update');
		Route::put('/maesma/usuarios/activar/{slug}', 'UserController@activate')->name('usuario.activate');
		Route::put('/maesma/usuarios/desactivar/{slug}', 'UserController@deactivate')->name('usuario.deactivate');
		Route::get('/maesma/perfil', 'UserController@profile')->name('usuario.profile');

		//Distancias
		Route::get('/maesma/distancias', 'DistanceController@index')->name('distancias.index');
		Route::get('/maesma/distancias/registrar', 'DistanceController@create')->name('distancias.create');
		Route::post('/maesma/distancias', 'DistanceController@store')->name('distancias.store');
		Route::get('/maesma/distancias/{slug}/editar', 'DistanceController@edit')->name('distancias.edit');
		Route::put('/maesma/distancias/{slug}', 'DistanceController@update')->name('distancias.update');
		Route::delete('/maesma/distancias/eliminar/{slug}', 'DistanceController@destroy')->name('distancias.delete');
	});

	Route::group(['middleware' => ['not.client']], function () {
		//Ventas
		Route::get('/maesma/ventas', 'SaleController@index')->name('venta.index');
		Route::put('/maesma/ventas/cajero-repartidor/{slug}', 'SaleController@update')->name('venta.user');
		Route::put('/maesma/ventas/tiempo/{slug}', 'SaleController@time')->name('venta.time');
		Route::put('/maesma/ventas/estado/{slug}', 'SaleController@state')->name('venta.state');
		Route::get('/maesma/ventas/{slug}', 'SaleController@show')->name('venta.show');
	});
});