@extends('layouts.admin')

@section('title', 'Editar Tienda')
@section('page-title', 'Editar Tienda')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/multiselect/bootstrap.multiselect.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendors/lobibox/Lobibox.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendors/leaflet/leaflet.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendors/leaflet/control.geocoder.css') }}" />
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('tiendas.index') }}">Tiendas</a></li>
<li class="breadcrumb-item active">Editar</li>
@endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">

				@include('admin.partials.errors')

				<h6 class="card-subtitle">Campos obligatorios (<b class="text-danger">*</b>)</h6>
				<form action="{{ route('tiendas.update', ['slug' => $store->slug]) }}" method="POST" class="form" id="formStore">
					@method('PUT')
					@csrf
					<div class="row">
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Nombre<b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="name" required placeholder="Introduzca un nombre" value="{{ $store->name }}">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							{{-- {{ dd($store->users) }} --}}
							<label class="col-form-label">Administrador<b class="text-danger">*</b></label>
							<select class="form-control multiselect" name="user_id[]" required multiple>
								{!! selectUsers($store->users, $users) !!}
							</select>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Dueño (Opcional)</label>
							<input class="form-control" type="text" name="owner" placeholder="Introduzca el nombre del dueño" value="{{ $store->owner }}">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Departamento</label>
							<input class="form-control" type="text" disabled value="Lima">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Provincia</label>
							<input class="form-control" type="text" disabled value="Lima">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Distrito<b class="text-danger">*</b></label>
							<select class="form-control multiselect" name="district_id" required>
								<option value="">Seleccione</option>
								@foreach($districts as $district)
								<option value="{{ $district->id }}" @if($store->district_id==$district->id) selected @endif>{{ $district->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Dirección<b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="address" required readonly placeholder="Seleccione una dirección" value="{{ $store->address }}" id="addressDelivery">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Teléfono<b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="phone" required placeholder="Introduzca un teléfono" value="{{ $store->phone }}">
						</div>
						<div class="form-group col-lg-12 col-md-12 col-12">
							<label class="col-form-label">Busca la ubicación de tu tienda y da click en ese lugar para obtener la dirección<b class="text-danger">*</b></label>
							<div id="map" style="height: 300px;"></div>
							<input type="hidden" name="lat" id="lat" value="{{ $store->lat }}">
							<input type="hidden" name="lng" id="lng" value="{{ $store->lng }}">
						</div>
						<div class="form-group col-12">
							<div class="btn-group" role="group">
								<button type="submit" class="btn btn-primary" action="store">Actualizar</button>
								<a href="{{ route('tiendas.index') }}" class="btn btn-secondary">Volver</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')
<script src="{{ asset('/admins/vendors/leaflet/leaflet.js') }}"></script>
<script src="{{ asset('/admins/vendors/leaflet/control.geocoder.js') }}"></script>
<script src="{{ asset('/admins/vendors/multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('/admins/vendors/lobibox/Lobibox.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
@endsection