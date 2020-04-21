@extends('layouts.admin')

@section('title', 'Detalles de la Venta')
@section('page-title', 'Detalles de la Venta')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('ventas.index') }}">Ventas</a></li>
<li class="breadcrumb-item active">Detalles</li>
@endsection

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/leaflet/leaflet.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendors/leaflet/leaflet-routing-machine.css') }}">
@endsection

@section('content')
<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="d-flex">
					<div class="mb-4">
						<h4 class="card-title"><span class="lstick"></span>Estado: {!! saleState($payment->state) !!}</h4>
					</div>
					<div class="ml-auto">
						<h5 class="card-title"><span class="lstick"></span>Fecha: {{ date('d-m-Y', strtotime($payment->created_at)) }}</h5>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-7 col-md-7 col-12 ftco-animate">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<p><strong>Forma de Pago:</strong> {!! saleShape($payment->shape) !!}</p>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<p><strong>Moneda:</strong> {{ $payment->currency }}</p>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<p><strong>Referencia:</strong> {{ $payment->reference }}</p>
							</div>
							@if($payment->card)
							<div class="col-lg-6 col-md-6 col-12">
								<p><strong>Banco de la Tarjeta:</strong> {{ $payment->card->bank }}</p>
							</div>
							@elseif($payment->transfer)
							<div class="col-lg-6 col-md-6 col-12">
								<p><strong>Banco Emisor:</strong> {{ $payment->transfer->bank }}</p>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<p><strong>Banco Receptor:</strong> {{ $payment->products[0]->pivot->bank }}</p>
							</div>
							@endif
							<div class="col-lg-6 col-md-6 col-12">
								<p class="mb-2"><strong>Pagado Por:</strong></p>
								<p class="mb-0">{{ $payment->user->name." ".$payment->user->lastname }}</p>
								<p>{{ $payment->user->email }}</p>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<p><strong>Tienda:</strong> {{ $payment->products[0]->stores[0]->name }}</p>
							</div>
							@if($payment->delivery)
							<div class="col-lg-6 col-md-6 col-12">
								<p><strong>Envio:</strong> Si</p>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<p><strong>Dirección de Envio:</strong> {{ $payment->delivery->address }}</p>
							</div>
							@endif
							<div class="col-12">
								<p><strong>Descripción:</strong> {{ $payment->description }}</p>
							</div>
						</div>
					</div>

					<div class="col-lg-5 col-md-5 col-12 ftco-animate">
						<div class="cart-detail cart-total p-3 p-md-4 bg-light">
							<div class="row mb-2">
								<div class="col-lg-4 col-md-4 col-sm-5 col-12">
									{!! imageCardProduct($payment->products[0]) !!}
								</div>
								<div class="col-lg-8 col-md-8 col-sm-7 col-12">
									<p class="text-primary mb-1">{{ $payment->products[0]->name }}</p>
									<p><strong>Cantidad:</strong> {{ $payment->products[0]->pivot->qty }}</p>
								</div>
							</div>
							<h3 class="billing-heading mb-2">Total del Pago</h3>
							<p class="d-flex justify-content-between">
								<span>Subtotal</span>
								<span>{{ "S/. ".number_format($payment->products[0]->pivot->price*$payment->products[0]->pivot->qty, 2, '.', '') }}</span>
							</p>
							@if($payment->delivery)
							<p class="d-flex justify-content-between">
								<span>Envio</span>
								<span>{{ "S/. ".number_format($payment->delivery->price, 2, ".", "") }}</span>
							</p>
							@endif
							@if($payment->products[0]->pivot->ofert>0)
							<p class="d-flex justify-content-between">
								<span>Descuento</span>
								<span>{{ "S/. ".number_format($payment->total*$payment->products[0]->pivot->ofert/100, 2, ".", "") }}</span>
							</p>
							@endif
							<hr>
							<p class="d-flex justify-content-between">
								<span>Total</span>
								<span>{{ "S/. ".number_format($payment->total, 2, ".", "") }}</span>
							</p>
						</div>
					</div>

					<div class="col-12 ftco-animate mt-2">
						<input type="hidden" id="latStore" value="{{ $payment->products[0]->stores[0]->lat }}">
						<input type="hidden" id="lngStore" value="{{ $payment->products[0]->stores[0]->lng }}">
						<input type="hidden" id="latUser" @if(isset($lat) && !empty($lat)) value="{{ $lat }}" @endif>
						<input type="hidden" id="lngUser" @if(isset($lng) && !empty($lng)) value="{{ $lng }}" @endif>

						<div id="map" style="height: 300px;"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')
<script src="{{ asset('/admins/vendors/leaflet/leaflet.js') }}"></script>
<script src="{{ asset('/admins/vendors/leaflet/leaflet-routing-machine.js') }}"></script>
@endsection