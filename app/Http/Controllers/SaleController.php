<?php

namespace App\Http\Controllers;

use App\Sale;
use App\User;
use App\Order;
use App\Http\Requests\SaleStoreRequest;
use App\Http\Requests\SaleUpdateRequest;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sale = Sale::all();
        $casher = User::where('type', 2)->where('state', 1)->get();
        $deliveryMan = User::where('type', 3)->where('state', 1)->get();
        $num = 1;
        return view('admin.sales.index', compact('sale', 'num', 'casher', 'deliveryMan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $sale = Sale::where('slug', $slug)->firstOrFail();
        $order = Order::where('sale_id', '=', $sale->id)->get();
        $num = 1;
        return view('admin.sales.show', compact('sale', 'order', 'num'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $sale = Sale::where('slug', $slug)->firstOrFail();
        $sale->fill($request->all())->save();

        if ($sale) {
            return redirect()->route('venta.index')->with(['type' => 'success', 'title' => 'Asignación exitosa', 'msg' => 'Se ha asignado correctamente el cajero y repartidor correctamente.']);
        } else {
            return redirect()->route('venta.index')->with(['type' => 'error', 'title' => 'Asignación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }

    public function time(Request $request, $slug)
    {
        $sale = Sale::where('slug', $slug)->firstOrFail();
        $today= date('H:i:s'); 
        $newDate = strtotime('+30 minute', strtotime($today)) ;  
        $newDate = date('H:i:s', $newDate); 
        $data = array('time' => $newDate);
        $sale->fill($data)->save();

        if ($sale) {
            return redirect()->route('venta.index')->with(['type' => 'success', 'title' => 'Asignación exitosa', 'msg' => 'Se ha iniciado el tiempo de entrega.']);
        } else {
            return redirect()->route('venta.index')->with(['type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function state(Request $request, $slug)
    {
        $sale = Sale::where('slug', $slug)->firstOrFail();
        $sale->fill($request->all())->save();

        if ($sale) {
            return redirect()->route('venta.index')->with(['type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'Se ha modificado correctamente el estado.']);
        } else {
            return redirect()->route('venta.index')->with(['type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }


}
