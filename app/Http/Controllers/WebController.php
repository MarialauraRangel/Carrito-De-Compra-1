<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Size;
use App\Store;
use App\Distance;
use App\Sale;
use App\Order;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function menu(Request $request) {
        $categories=Category::all();
        $products=Product::orderBy('category_id', 'ASC')->get();
        $cart=($request->session()->has('cart')) ? count(session('cart')) : 0 ;
        return view('web.menu', compact('categories', 'products', 'cart'));
    }

    public function product(Request $request, $slug) {
        $product=Product::where('slug', $slug)->firstOrFail();
        $products=Product::where('id', '!=', $product->id)->limit(4)->get();
        $cart=($request->session()->has('cart')) ? count(session('cart')) : 0 ;
        
        return view('web.product', compact('product', 'products', 'cart'));
    }

    public function cart(Request $request) {
        $total=0;
        $products=[];
        if ($request->session()->has('cart')) {
            $cart=session('cart');
            $request->session()->forget('cart');
            $num=0;
            foreach ($cart as $cartProduct) {
                $size=Size::where('slug', $cartProduct['size_slug'])->first();
                $store=Store::where('slug', $cartProduct['store_slug'])->first();
                $product=Product::join('product_size', 'products.id', '=', 'product_size.product_id')->where('products.slug', $cartProduct['product_slug'])->where('product_size.size_id', $size->id)->first();

                $products[$num]['product']=$product;
                $products[$num]['size']=$size;
                $products[$num]['store']=$store;
                $products[$num]['qty']=$cartProduct['qty'];
                $products[$num]['code']=$cartProduct['code'];
                $total+=$product->price*$cartProduct['qty'];

                if ($num==0) {
                    $request->session()->put('cart', array(0 => ['name' => $product->name, 'qty' => $cartProduct['qty'], 'price' => $product->price, 'subtotal' => number_format($product->price*$cartProduct['qty'], 2, ',', '.'), 'ofert' => $product->ofert, 'product_slug' => $product->slug, 'size_slug' => $size->slug, 'size' => $size->name, 'store' => $store->name, 'store_slug' => $store->slug, 'code' => $cartProduct['code']]));
                } else {
                    $request->session()->push('cart', array('name' => $product->name, 'qty' => $cartProduct['qty'], 'price' => $product->price, 'subtotal' => number_format($product->price*$cartProduct['qty'], 2, ',', '.'), 'ofert' => $product->ofert, 'product_slug' => $product->slug, 'size_slug' => $size->slug, 'size' => $size->name, 'store' => $store->name, 'store_slug' => $store->slug, 'code' => $cartProduct['code']));
                }
                $num++;  
            }
        }
        $cart=($request->session()->has('cart')) ? count(session('cart')) : 0 ;

        return view('web.cart', compact("products", "cart", "total"));
    }

    public function addProduct(Request $request) {
        $exists=Product::where('slug', request('slug'))->exists();
        if ($exists) {
            $product=Product::with(['stores', 'sizes'])->where('slug', request('slug'))->first();
            return response()->json(['status' => true, 'product' => $product]);
        }

        return response()->json(['status' => false]);
    }

    public function addCart(Request $request) {
    	if (request('qty')>0 && !empty(request('store')) && !empty(request('size'))) {
    		$exists=Product::where('slug', request('slug'))->exists();

    		if ($exists) {
                $size=Size::where('slug', request('size'))->first();
                $store=Store::where('slug', request('store'))->first();
                $product=Product::join('product_size', 'products.id', '=', 'product_size.product_id')->where('products.slug', request('slug'))->where('product_size.size_id', $size->id)->first();
                $code=$product->id.$size->id.$store->id;

                if ($request->session()->has('cart')) {
                    $cart=session('cart');

                    if (array_search($code, array_column($cart, 'code'))!==false) {

                        $key=array_search($code, array_column($cart, 'code'));
                        $cart[$key]['qty']=$cart[$key]['qty']+request('qty');
                        $subtotal=$product->price*$cart[$key]['qty'];
                        $cart[$key]['price']=$product->price;
                        $cart[$key]['subtotal']=number_format($subtotal, 2, ',', '.');
                        $cart[$key]['ofert']=$product->ofert;
                        $request->session()->put('cart', $cart);

                        return response()->json(['status' => true, 'cart' => session('cart')]);

                    } else {
                        $subtotal=$product->price*request('qty');
                        $request->session()->push('cart', array('name' => $product->name, 'qty' => request('qty'), 'price' => $product->price, 'subtotal' => number_format($subtotal, 2, ',', '.'), 'ofert' => $product->ofert, 'product_slug' => $product->slug, 'size_slug' => $size->slug, 'size' => $size->name, 'store' => $store->name, 'store_slug' => $store->slug, 'code' => $code));

                        return response()->json(['status' => true, 'cart' => session('cart')]);
                    }
                } else {
                    $subtotal=$product->price*request('qty');
                    $request->session()->push('cart', array('name' => $product->name, 'qty' => request('qty'), 'price' => $product->price, 'subtotal' => number_format($subtotal, 2, ',', '.'), 'ofert' => $product->ofert, 'product_slug' => $product->slug, 'size_slug' => $size->slug, 'size' => $size->name, 'store' => $store->name, 'store_slug' => $store->slug, 'code' => $code));

                    return response()->json(['status' => true, 'cart' => session('cart')]);
                }
            }
        }

        return response()->json(['status' => false]);
    }

    public function removeCart(Request $request) {

        if ($request->session()->has('cart')) {
            $cart=session('cart');

            if (array_search(request('code'), array_column($cart, 'code'))!==false) {
                $request->session()->forget('cart');
                $num=0;
                foreach ($cart as $product) {
                    if (request('code')!=$product['code']) {
                        if ($num==0) {
                            $request->session()->put('cart', array(0 => ['name' => $product['name'], 'qty' => $product['qty'], 'price' => $product['price'], 'subtotal' => $product['subtotal'], 'ofert' => $product['ofert'], 'product_slug' => $product['product_slug'], 'size_slug' => $product['size_slug'], 'size' => $product['size'], 'store' => $product['store'], 'store_slug' => $product['store_slug'], 'code' => $product['code']]));
                        } else {
                            $request->session()->push('cart', array('name' => $product['name'], 'qty' => $product['qty'], 'price' => $product['price'], 'subtotal' => $product['subtotal'], 'ofert' => $product['ofert'], 'product_slug' => $product['product_slug'], 'size_slug' => $product['size_slug'], 'size' => $product['size'], 'store' => $product['store'], 'store_slug' => $product['store_slug'], 'code' => $product['code']));
                        }
                        $num++;
                    }
                }
                return response()->json(['status' => true]);
            }
        }

        return response()->json(['status' => false]);
    }

    public function qtyCart(Request $request) {
        if (request('qty')>0 && !empty(request('size')) && !empty(request('slug')) && !empty(request('code'))) {
            $exists=Product::where('slug', request('slug'))->exists();
            if ($exists) {
                $size=Size::where('slug', request('size'))->first();
                $product=Product::join('product_size', 'products.id', '=', 'product_size.product_id')->where('products.slug', request('slug'))->where('product_size.size_id', $size->id)->first();

                $cart=session('cart');
                if (array_search(request('code'), array_column($cart, 'code'))!==false) {

                    $key=array_search(request('code'), array_column($cart, 'code'));
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
                $total+=$cartProduct['price']*$cartProduct['qty'];
            }

            $cart=($request->session()->has('cart')) ? count(session('cart')) : 0 ;
            $store = Store::all();
            $distance = Distance::where('id', '>', '1')->get();

            return view('web.checkout', compact('cart', 'total', 'store', 'distance'));
        }

        return redirect()->route('web.cart');
    }

    public function saleStore(Request $request) {

        $count=Sale::count();
        $slug=Str::slug('venta', '-');
        if ($count>0) {
            $slug="venta-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Sale::where('slug', $slug)->count();
            if ($count2>0) {
                $slug="venta-".$num;
                $num++;
            } else {
                $id = Auth::user()->id;
                $data = array('slug' => $slug, 'user_id' => $id, 'store_id' => request('store_id'), 'address' => request('address'), 'distance_id' => request('distance_id'));
                break;
            }
        }

        $sale=Sale::create($data);

        $cart=session('cart');

        foreach ($cart as $order) {

            $store = Store::where('slug', $order['store_slug'])->firstOrFail();
 
            $product = Product::where('slug', $order['product_slug'])->firstOrFail();

            $size = Size::where('slug', $order['size_slug'])->firstOrFail();
            

            $data2 = array('sale_id' => $sale->id, 'product_id' => $product->id, 'size_id' => $size->id, 'store_id' => $store->id, 'price' => $order['price'], 'qty' => $order['qty']);
            Order::create($data2)->save();
        }

        

        return view('web.orders', compact('cart'));
    }

    public function shopping(Request $request) {
        $cart=($request->session()->has('cart')) ? count(session('cart')) : 0 ;
        $sale = Sale::where('user_id', '=', Auth::user()->id)->get();
        $num = 1;
        return view('web.orders', compact('cart', 'sale', 'num'));
    }

        public function orderProduct(Request $request, $slug) {
        $cart=($request->session()->has('cart')) ? count(session('cart')) : 0 ;
        $sale = Sale::where('slug', $slug)->firstOrFail();
        $order = Order::where('sale_id', '=', $sale->id)->get();
        $num = 1;

        return view('web.order_product', compact('cart', 'sale', 'order', 'num'));
    }

}
