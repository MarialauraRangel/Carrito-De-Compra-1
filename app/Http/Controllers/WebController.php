<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class WebController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request) {
    	$products=Product::all();
    	$cart=($request->session()->has('cart')) ? count(session('cart')) : 0 ;
    	return view('web.home', compact('products', 'cart'));
    }

    public function cart(Request $request) {
        $total=0;
        $products=[];
        if ($request->session()->has('cart')) {
            $cart=session('cart');
            $num=0;
            foreach ($cart as $cartProduct) {
                $product=Product::where('slug', $cartProduct['slug'])->first();
                $products[$num]=$product;
                $products[$num]['qty']=$cartProduct['qty'];
                $total+=$product->price*$cartProduct['qty'];
                $num++;
            }

        }
        $cart=($request->session()->has('cart')) ? count(session('cart')) : 0 ;

        return view('web.orders.cart', compact("products", "cart", "total"));
    }

    public function addCart(Request $request) {
    	if (request('qty')>0) {
    		$count=Product::where('slug', request('slug'))->count();
    		if ($count>0) {
    			$product=Product::where('slug', request('slug'))->first();
    			if ($request->session()->has('cart')) {
    				$cart=session('cart');

    				if (array_search($product->slug, array_column($cart, 'slug'))!==false) {

    					$key=array_search($product->slug, array_column($cart, 'slug'));
    					$cart[$key]['qty']=$cart[$key]['qty']+request('qty');
    					$subtotal=$product->price*$cart[$key]['qty'];
    					$cart[$key]['price']=$product->price;
    					$cart[$key]['subtotal']=number_format($subtotal, 2, ',', '.');
    					$request->session()->put('cart', $cart);

    					return response()->json(['status' => true, 'cart' => session('cart')]);

    				} else {
    					$subtotal=$product->price*request('qty');
    					$request->session()->push('cart', array('name' => $product->name, 'qty' => request('qty'), 'price' => $product->price, 'subtotal' => number_format($subtotal, 2, ',', '.'), 'slug' => $product->slug));

    					return response()->json(['status' => true, 'cart' => session('cart')]);
    				}
    			} else {
    				$subtotal=$product->price*request('qty');
    				$request->session()->push('cart', array('name' => $product->name, 'qty' => request('qty'), 'price' => $product->price, 'subtotal' => number_format($subtotal, 2, ',', '.'), 'slug' => $product->slug));

    				return response()->json(['status' => true, 'cart' => session('cart')]);
    			}
    		}
    	}

    	return response()->json(['status' => false]);
    }

    public function removeCart(Request $request) {

        if ($request->session()->has('cart')) {
            $cart=session('cart');

            if (array_search(request('slug'), array_column($cart, 'slug'))!==false) {
                $request->session()->forget('cart');
                $num=0;
                foreach ($cart as $product) {
                    if (request('slug')!=$product['slug']) {
                        if ($num==0) {
                            $request->session()->put('cart', array(0 => ['name' => $product['name'], 'qty' => $product['qty'], 'price' => $product['price'], 'subtotal' => $product['subtotal'], 'slug' => $product['slug']]));
                        } else {
                            $request->session()->push('cart', array('name' => $product['name'], 'qty' => $product['qty'], 'price' => $product['price'], 'subtotal' => $product['subtotal'], 'slug' => $product['slug']));
                        }
                        $num++;
                    }
                }
                return response()->json(['status' => true]);
            } else {
                return response()->json(['status' => false]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function qtyCart(Request $request) {
        if (request('qty')>0) {
            $count=Product::where('slug', request('slug'))->count();
            if ($count>0) {
                $product=Product::where('slug', request('slug'))->first();
                $cart=session('cart');

                if (array_search($product->slug, array_column($cart, 'slug'))!==false) {

                    $key=array_search($product->slug, array_column($cart, 'slug'));
                    $cart[$key]['qty']=request('qty');
                    $subtotal=$product->price*$cart[$key]['qty'];
                    $cart[$key]['price']=$product->price;
                    $cart[$key]['subtotal']=number_format($subtotal, 2, ',', '.');
                    $request->session()->put('cart', $cart);

                    return response()->json(['status' => true, 'subtotal' => number_format($subtotal, 2, ',', '.'), 'cart' => session('cart')]);

                }
            }
        }

        return response()->json(['status' => false]);
    }

    public function checkout(Request $request)
    {
        $total=0;
        if ($request->session()->has('cart')) {
            $cart=session('cart');
            foreach ($cart as $cartProduct) {
                $product=Product::where('slug', $cartProduct['slug'])->first();
                $total+=$product->price*$cartProduct['qty'];
            }

        }
        $cart=($request->session()->has('cart')) ? count(session('cart')) : 0 ;

        return view('web.payments.checkout', compact('cart', 'total'));
    }
}
