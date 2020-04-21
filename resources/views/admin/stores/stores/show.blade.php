@extends('layouts.admin')

@section('title', 'Detalles de la Tienda')
@section('page-title', 'Detalles de la Tienda')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/leaflet/leaflet.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendors/leaflet/control.geocoder.css') }}" />

@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('tiendas.index') }}">Tiendas</a></li>
<li class="breadcrumb-item active">Solicitud</li>
@endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="d-flex">
					<div class="mb-4">
						<h4 class="card-title"><span class="lstick"></span>Estado: {!! storeRequetsState($store->state) !!}</h4>
					</div>
					<div class="ml-auto">
						<h5 class="card-title"><span class="lstick"></span>Fecha: {{ date('d-m-Y', strtotime($store->created_at)) }}</h5>
					</div>
				</div>

				<div class="row">
					<div class="col-12 ftco-animate">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<p><strong>Nombre de la tienda:</strong> {{ $store->name }}</p>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<p><strong>Dirección:</strong> {{ $store->address }}</p>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<p><strong>Teléfono:</strong> {{ $store->phone }}</p>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<p class="mb-2"><strong>Tienda De:</strong></p>
								<p class="mb-0">{{ $store->users[0]->name." ".$store->users[0]->lastname }}</p>
								<p>{{ $store->users[0]->email }}</p>
							</div>
						</div>
					</div>

					<div class="col-12 ftco-animate mt-2">
						<input type="hidden" id="lat" value="{{ $store->lat }}">
						<input type="hidden" id="lng" value="{{ $store->lng }}">

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
<script src="{{ asset('/admins/vendors/leaflet/control.geocoder.js') }}"></script>
@endsection