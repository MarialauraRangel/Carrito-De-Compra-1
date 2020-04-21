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
Route::get('/pedidos', 'OrderController@create')->name('pedido.create');
Route::get('/pedido/{slug}', 'OrderController@show')->name('pedido.show');

//Ventas
Route::get('/ventas', 'SaleController@index')->name('venta.index');

//Pagos
Route::get('/pagos', 'PaymentController@index')->name('pago.index');
Route::get('/pagos/registrar', 'PaymentController@create')->name('pago.create');

//Productos
Route::get('/productos/ver', 'ProductController@show')->name('producto.show');

//Categorías
Route::get('/categorias', 'CategoryController@index')->name('categoria.index');

///// ADMIN /////
// Inicio
Route::get('/sistema', 'AdminController@index')->name('admin');

//Productos
Route::get('/productos', 'ProductController@index')->name('productos.index');
Route::get('/productos/registrar', 'ProductController@create')->name('productos.create');


//Categorías
Route::get('/categorias/listado', 'CategoryController@lista')->name('categorias.index');
Route::get('/categorias/registrar', 'CategoryController@create')->name('categorias.create');

//Ingredientes
Route::get('/ingredientes', 'IngredientController@index')->name('ingredientes.index');
Route::get('/ingredientes/registrar', 'IngredientController@create')->name('ingredientes.create');

//Tiendas
Route::get('/tiendas', 'StoreController@index')->name('tienda.index');

