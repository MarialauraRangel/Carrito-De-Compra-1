<?php

namespace App\Http\Controllers;


use App\User;
use App\Store;
use App\Product;
use App\Category;
use App\Sale;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {

    	$activos = User::where('state', '1')->count();
    	$inactivos = User::where('state', '2')->count();
    	$tienda = Store::all()->count();
    	$producto = Product::all()->count();
    	$categoria = Category::all()->count();
    	$venta = Sale::all()->count();

        return view('admin.home', compact('activos', 'inactivos', 'tienda', 'categoria', 'venta', 'producto'));
    }
}
