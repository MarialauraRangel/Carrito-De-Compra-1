@extends('layouts.admin')

@section('title', 'Detalles de la Venta')
@section('page-title', 'Detalles de la Venta')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('venta.index') }}">Ventas</a></li>
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
						<h4 class="card-title"><span class="lstick"></span>Estado: {!! saleState($sale->state) !!}</h4>
					</div>
					<div class="ml-auto">
						<h5 class="card-title"><span class="lstick"></span>Fecha: {{ date('d-m-Y', strtotime($sale->created_at)) }}</h5>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-7 col-md-7 col-12 ftco-animate">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<p><strong>Pedido:</strong> N° {{  $sale->id }}</p>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<p><strong>Cliente:</strong> {{ $sale->customer->name." ".$sale->customer->name }} </p>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<p><strong>Tienda:</strong> {{ $sale->stores->name }}</p>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<p><strong>Cajero:</strong> {{ $sale->casher->name." ".$sale->casher->lastname }}</p>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<p><strong>Repartidor:</strong> {{ $sale->delivery->name." ".$sale->delivery->lastname }}</p>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<p><strong>Tiempo de Entrega:</strong> {{ $sale->time }}</p>
							</div>
						</div>
					</div>

					<div class="col-lg-5 col-md-5 col-12 ftco-animate">
						<div class="cart-detail cart-total p-3 p-md-4 bg-light">
							<div class="row mb-2">
								<div class="col-lg-4 col-md-4 col-sm-5 col-12">
									<strong>Dirección</strong>
								</div>
								<div class="col-lg-8 col-md-8 col-sm-7 col-12">
									<p class="text-primary mb-1">{{ $sale->address }}</p>
									<p><strong>Cantidad:</strong> ...</p>
								</div>
							</div>
							<h3 class="billing-heading mb-2">Total del Pago</h3>
							<p class="d-flex justify-content-between">
								<span>Subtotal</span>
								<span>...</span>
							</p>
							<p class="d-flex justify-content-between">
								<span>Delivery</span>
								<span>...</span>
							</p>
							<hr>
							<p class="d-flex justify-content-between">
								<span>Total</span>
								<span>...</span>
							</p>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="tabla" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>#</th>
								<th>Producto</th>
								<th>Tamaño</th>
								<th>Categoría</th>
								<th>Cantidad</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
					</table>
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