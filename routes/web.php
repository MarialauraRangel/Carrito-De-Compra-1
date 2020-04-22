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

///// AUTH /////
Auth::routes();
Route::get('/registro/email', 'UserController@emailVerify');

///// WEB /////
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

///// ADMIN /////
// Inicio
Route::get('/sistema', 'AdminController@index')->name('admin');

//Productos
Route::get('/productos', 'ProductController@index')->name('producto.index');
Route::get('/productos/registrar', 'ProductController@create')->name('producto.create');
Route::get('/productos/ver', 'ProductController@show')->name('producto.show');

//Categorías
Route::get('/categorias', 'CategoryController@index')->name('categoria.index');
Route::get('/categorias/registrar', 'CategoryController@create')->name('categoria.create');

//Ingredientes
Route::get('/ingredientes', 'IngredientController@index')->name('ingrediente.index');
Route::get('/ingredientes/registrar', 'IngredientController@create')->name('ingrediente.create');

//Tiendas
Route::get('/tiendas', 'StoreController@index')->name('tienda.index');