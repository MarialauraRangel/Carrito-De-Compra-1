<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Size;
use App\ProductSizes;
use Illuminate\Support\Str;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
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
        $sizes = Size::all();
        return view('admin.products.create', compact('stores', 'categories', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
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
                $slug=Str::slug(request('name'), '-')."-".$num;
                $num++;
            } else {
                $category=Category::where('slug', request('category_id'))->firstOrFail();
                $data=array('name' => request('name'), 'slug' => $slug, 'description' => request('description'), 'category_id' => $category->id);
                break;
            }
        }

        // Mover imagen a carpeta products y extraer nombre
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = time()."_".$slug;
            $file->move(public_path().'/admins/img/products/', $image);
            $data['image'] = $image;
        }

        $product=Product::create($data);

        if (request('size-question')=="0") {
            $size=Size::where('slug', 'unico')->firstOrFail();
            ProductSizes::create(['product_id' => $product->id, 'size_id' => $size->id, 'price' => request('price-unique')]);
        } else {
            $sizes=request('size');
            $prices=request('price');
            for ($i=0; $i < count($sizes); $i++) { 
                $size=Size::where('slug', $sizes[$i])->firstOrFail();
                ProductSizes::create(['product_id' => $product->id, 'size_id' => $size->id, 'price' => $prices[$i]]);
            }
        }        

        if ($product) {
            return redirect()->route('productos.index')->with(['type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El producto ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('productos.index')->with(['type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
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
    public function update(ProductUpdateRequest $request)
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
                $slug=Str::slug(request('name'), '-')."-".$num;
                $num++;
            } else {
                $category=Category::where('slug', request('category_id'))->firstOrFail();
                $data=array('name' => request('name'), 'slug' => $slug, 'description' => request('description'), 'category_id' => $category->id);
                break;
            }
        }

        // Mover imagen a carpeta products y extraer nombre
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = time()."_".$slug;
            $file->move(public_path().'/admins/img/products/', $image);
            $data['image'] = $image;
        }

        $product=Product::create($data);

        if (request('size-question')=="0") {
            $size=Size::where('slug', 'unico')->firstOrFail();
            ProductSizes::create(['product_id' => $product->id, 'size_id' => $size->id, 'price' => request('price-unique')]);
        } else {
            $sizes=request('size');
            $prices=request('price');
            for ($i=0; $i < count($sizes); $i++) { 
                $size=Size::where('slug', $sizes[$i])->firstOrFail();
                ProductSizes::create(['product_id' => $product->id, 'size_id' => $size->id, 'price' => $prices[$i]]);
            }
        }        

        if ($product) {
            return redirect()->route('productos.index')->with(['type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El producto ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('productos.index')->with(['type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
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
            return redirect()->route('productos.index')->with(['type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El producto ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('productos.index')->with(['type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
