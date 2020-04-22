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

//Pedidos
Route::get('/carrito', 'WebController@cart')->name('carrito.index');
Route::post('/carrito/agregar', 'WebController@addCart')->name('carrito.add');
Route::post('/carrito/quitar', 'WebController@removeCart')->name('carrito.remove');
Route::post('/carrito/cantidad', 'WebController@qtyCart')->name('carrito.qty');
Route::get('/pedido/{slug}', 'OrderController@show')->name('pedido.show');

//Ventas
Route::get('/ventas', 'SaleController@index')->name('venta.index');

//Pagos
Route::get('/pagos', 'PaymentController@index')->name('pago.index');
Route::get('/comprar', 'WebController@checkout')->name('pago.create');

//Productos
Route::get('/productos/ver', 'ProductController@show')->name('producto.show');

//Categorías
Route::get('/categorias', 'CategoryController@index')->name('categoria.index');

///// //////////////////////////////////ADMIN ///////////////////////////////////////////////////

// Inicio
Route::get('/sistema', 'AdminController@index')->name('admin');

//Productos
Route::get('/productos', 'ProductController@index')->name('productos.index');
Route::get('/productos/registrar', 'ProductController@create')->name('productos.create');
Route::post('/productos', 'ProductController@store')->name('productos.store');
Route::get('/productos/{slug}', 'ProductController@show')->name('productos.show');
Route::get('/productos/{slug}/editar', 'ProductController@edit')->name('productos.edit');
Route::put('/productos/{slug}', 'ProductController@update')->name('productos.update');
Route::delete('/productos/eliminar/{slug}', 'ProductController@destroy')->name('productos.delete');


//Categorías
Route::get('/categorias/listado', 'CategoryController@lista')->name('categorias.index');
Route::get('/categorias/registrar', 'CategoryController@create')->name('categorias.create');
Route::post('/categorias', 'CategoryController@store')->name('categorias.store');
Route::get('/categorias/{slug}', 'CategoryController@show')->name('categorias.show');
Route::get('/categorias/{slug}/editar', 'CategoryController@edit')->name('categorias.edit');
Route::put('/categorias/{slug}', 'CategoryController@update')->name('categorias.update');
Route::delete('/categorias/eliminar/{slug}', 'CategoryController@destroy')->name('categorias.delete');

//Ingredientes
Route::get('/ingredientes', 'IngredientController@index')->name('ingredientes.index');
Route::get('/ingredientes/registrar', 'IngredientController@create')->name('ingredientes.create');

//Tiendas
Route::get('/tiendas', 'StoreController@index')->name('tienda.index');
Route::put('/tiendas/activar/{slug}', 'StoreController@activate')->name('tienda.activate');
Route::put('/tiendas/desactivar/{slug}', 'StoreController@desactivate')->name('tienda.desactivate');

//Usuarios
Route::get('/usuarios', 'UserController@index')->name('usuario.index');
Route::get('/usuarios/registrar', 'UserController@create')->name('usuario.create');
Route::post('/usuarios', 'UserController@store')->name('usuario.store');
Route::get('/usuarios/{slug}', 'UserController@show')->name('usuario.show');
Route::get('/usuarios/{slug}/editar', 'UserController@edit')->name('usuario.edit');
Route::put('/usuarios/{slug}', 'UserController@update')->name('usuario.update');
Route::put('/usuarios/activar/{slug}', 'UserController@activate')->name('usuario.activate');
Route::put('/usuarios/desactivar/{slug}', 'UserController@deactivate')->name('usuario.deactivate');
Route::put('/usuarios/inactivos', 'UserController@inactive')->name('usuario.inactivos');
Route::get('/perfil', 'UserController@profile')->name('usuario.profile');

//Ventas
Route::get('/ventas', 'SaleController@index')->name('venta.index');