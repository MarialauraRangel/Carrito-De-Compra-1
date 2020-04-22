<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $num = 1;
        return view('admin.products.index', compact('products', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('stores', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count=Product::where('name', request('name'))->count();
        $slug=Str::slug(request('name'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Product::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=$slug."-".$num;
                $num++;
            } else {
                $data=array('name' => request('name'), 'slug' => $slug, 'price' => request('price'), 'description' => request('description'), 'ofert' => request('ofert'), 'category_id' => request('category_id'));
                break;
            }
        }

        // Mover imagen a carpeta users y extraer nombre
        // if ($request->hasFile('files')) {
        //     $file=$request->file('files');
        //     $files=time()."_".$file->getClientOriginalName();
        //     $file->move(public_path().'/admins/img/products/', $files);
        //     $data['files']=$files;
        // }

        $product=Product::create($data);

        if ($product) {
            return redirect()->route('productos.index')->with(['type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El producto ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('productos.index')->with(['type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('web.products.product');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $product=Product::where('slug', $slug)->firstOrFail();
        $product->delete();

        if ($product) {
            return redirect()->route('productos.index')->with(['type' => 'success', 'title' => 'Modificación exitosa', 'msg' => 'El Producto ha sido eliminada exitosamente.']);
        } else {
            return redirect()->route('productos.index')->with(['type' => 'error', 'title' => 'Modificación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
