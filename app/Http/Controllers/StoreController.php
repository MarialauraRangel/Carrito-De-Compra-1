<?php

namespace App\Http\Controllers;

use App\Store;
use App\Http\Requests\StoreUpdateRequest;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::all();
        $num = 1;
        return view('admin.stores.index', compact('stores', 'num'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $store=Store::where('slug', $slug)->firstOrFail();
        return view('admin.stores.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateRequest $request, $slug)
    {
        $store=Store::where('slug', $slug)->firstOrFail();
        $store->fill($request->all())->save();

        if ($store) {
            return redirect()->route('tiendas.edit', ['slug' => $slug])->with(['type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La tienda ha sido editada exitosamente.']);
        } else {
            return redirect()->route('tiendas.edit', ['slug' => $slug])->with(['type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function desactivate(Request $request, $slug) {

        $store = Store::where('slug', $slug)->firstOrFail();
        $store->fill($request->all())->save();

        if ($store) {
            return redirect()->route('tienda.index')->with(['type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La tienda ha sido desactivada exitosamente.']);
        } else {
            return redirect()->route('tienda.index')->with(['type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, $slug) {

        $store = Store::where('slug', $slug)->firstOrFail();
        $store->fill($request->all())->save();

        if ($store) {
            return redirect()->route('tienda.index')->with(['type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La tienda ha sido activada exitosamente.']);
        } else {
            return redirect()->route('tienda.index')->with(['type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
