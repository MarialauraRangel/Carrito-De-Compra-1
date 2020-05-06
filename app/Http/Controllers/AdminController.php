<?php

namespace App\Http\Controllers;


use App\Category;
use App\Sale;
use App\Product;
use App\Store;
use App\User;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
    	$stores=Store::count();
    	$products=Product::count();
    	$sales=Sale::count();
    	$categories=Category::count();
    	$actives=User::where('state', 1)->count();
    	$inactives=User::where('state', 2)->count();

        return view('admin.home', compact('stores', 'products', 'sales', 'categories', 'actives', 'inactives'));
    }
}
