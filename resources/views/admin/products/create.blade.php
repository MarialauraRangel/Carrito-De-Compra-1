@extends('layouts.admin')

@section('title', 'Registro de Producto')
@section('page-title', 'Registro de Producto')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/multiselect/bootstrap.multiselect.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendors/touchspin/jquery.bootstrap-touchspin.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendors/uploader/jquery.dm-uploader.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendors/uploader/styles.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Productos</a></li>
<li class="breadcrumb-item active">Registro</li>
@endsection
 
@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">

				@include('admin.partials.errors')

				<h6 class="card-subtitle">Campos obligatorios (<b class="text-danger">*</b>)</h6>
				<form action="{{ route('productos.store') }}" method="POST" class="form" id="formProduct" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Tienda<b class="text-danger">*</b></label>
							<select class="form-control multiselect" required name="store_id" id="store_id">
								<option value="">Seleccione</option>
								@foreach($stores as $store)
								<option value="{{ $store->slug }}" @if(old('store_id')==$store->slug) selected @endif>{{ $store->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-6">
							<label class="col-form-label">Nombre<b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="name" required placeholder="Introduzca un nombre" value="{{ old('name') }}">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Marca del Producto<b class="text-danger">*</b></label>
							<select class="form-control multiselect" name="brand_id" id="brand_id" required>
								<option value="">Seleccione</option>
								@foreach($brandsProducts as $brand)
								<option value="{{ $brand->slug }}">{{ $brand->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Marcas de Vehículos Para Usar<b class="text-danger">*</b></label>
							<select class="form-control multiselect" name="brands_vehicles[]" required multiple>
								<option value="all">Todas</option>
								{!! selectMultiple(old('brands_vehicles'), $brands) !!}
							</select>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Categoria<b class="text-danger">*</b></label>
							<select class="form-control multiselect" required id="category" onchange="addSubcategories($(this).val());">
								<option value="">Seleccione</option>
								@foreach($categories as $category)
								<option value="{{ $category->slug }}">{{ $category->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Subcategoria<b class="text-danger">*</b></label>
							<select class="form-control multiselect" name="subcategory_id" required id="multiselectSubcategories">
							</select>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Cantidad<b class="text-danger">*</b></label>
							<input class="form-control number" type="text" name="qty" required placeholder="Introduzca una cantidad" value="1">
						</div>
						<div class="form-group col-lg-3 col-md-3 col-12">
							<label class="col-form-label">Precio<b class="text-danger">*</b></label>
							<input class="form-control price" type="text" name="price" required placeholder="Introduzca el precio" value="0.00">
						</div>
						<div class="form-group col-lg-3 col-md-3 col-12">
							<label class="col-form-label">Descuento (%)<b class="text-danger">*</b></label>
							<input class="form-control ofert" type="text" name="ofert" required placeholder="Introduzca el descuento" value="0">
						</div>
						<div class="form-group col-lg-12 col-md-12 col-12">
							<label class="col-form-label">Descripción<b class="text-danger">*</b></label>
							<textarea class="form-control" rows="4" name="description" required placeholder="Introduzca una descripción">{{ old('description') }}</textarea>
						</div>
						<div class="form-group col-12">
							<label class="col-form-label">Imagenes (Opcional)</label>
							<div id="drop-area" class="dm-uploader text-center py-4 px-2">
								<p id="files" class="text-left py-0 dark-text"></p>
								<h3 class="text-muted">Arrastra aquí tus imagenes</h3>
								<div class="btn btn-primary btn-block">
									<span>Selecciona las imagenes</span>
									<input type="file" title="Selecciona un archivo" multiple>
								</div>
							</div>
							<p id="response" class="text-left py-0"></p>
							<input type="hidden" name="files" id="nameFiles" value="">
						</div>

						<div class="form-group col-12">
							<div class="btn-group" role="group">
								<button type="submit" class="btn btn-primary" action="product">Guardar</button>
								<a href="{{ route('productos.index') }}" class="btn btn-secondary">Volver</a>
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
<script src="{{ asset('/admins/vendors/multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('/admins/vendors/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/uploader/jquery.dm-uploader.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
@endsection