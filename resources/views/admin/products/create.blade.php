@extends('layouts.admin')

@section('title', 'Registro de Producto')
@section('page-title', 'Registro de Producto')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/multiselect/bootstrap.multiselect.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendors/touchspin/jquery.bootstrap-touchspin.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendors/dropify/css/dropify.min.css') }}">
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
						<div class="form-group col-lg-6 col-md-6 col-6">
							<label class="col-form-label">Nombre<b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="name" required placeholder="Introduzca un nombre" value="{{ old('name') }}">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Categoria<b class="text-danger">*</b></label>
							<select class="form-control multiselect" name="category_id" required id="category">
								<option value="">Seleccione</option>
								@foreach($categories as $category)
								<option value="{{ $category->slug }}">{{ $category->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Precio<b class="text-danger">*</b></label>
							<input class="form-control price" type="text" name="price" required placeholder="Introduzca el precio" value="0.00">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Descuento (%)</label>
							<input class="form-control ofert" type="text" name="ofert" placeholder="Introduzca el descuento" value="0">
						</div>
						<div class="form-group col-lg-12 col-md-12 col-12">
							<label class="col-form-label">Descripción<b class="text-danger">*</b></label>
							<textarea class="form-control" rows="4" name="description" required placeholder="Introduzca una descripción">{{ old('description') }}</textarea>
						</div>

						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">¿El producto tendrá varios tamaños?<b class="text-danger">*</b></label>
							<select class="form-control" name="size-question">
								<option value="0">No</option>
								<option value="1">Si</option>
							</select>
						</div>

						<div class="form-group col-lg-6 col-md-6 col-12 d-none" id="div-select-select">
							<label class="col-form-label">Tamaño<b class="text-danger">*</b></label>
							<div class="input-group">
								<select class="form-control" id="select-size">
									<option value="">Seleccione</option>
									@foreach($sizes as $size)
									<option value="{{ $size->slug }}">{{ $size->name }}</option>
									@endforeach
								</select>
								<button type="type" class="btn btn-primary text-white input-group-addon" id="btn-select-size">Agregar</button>
							</div>
						</div>

						<div class="col-12">
							<div class="row" id="newSizes"></div>
						</div>

						<div class="form-group col-12">
							<label class="col-form-label">Imagen (Opcional)</label>
							<input type="file" name="image" accept="image/*" id="input-file-now" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" />
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
<script src="{{ asset('/admins/vendors/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>

<script type="text/javascript">
	$('input[name="size-question"]').change(function() {
		if ($(this).val()==0) {
			$('#div-select-size').addClass('d-none');
		} else {
			$('#div-select-size').removeClass('d-none');
		}
	});

	$('#select-size').change(function() {
		if ($(this).val()!="") {
			$('#btn-select-size').attr('disabled', true);
		} else {
			$('#btn-select-size').attr('disabled', false);
		}
	});

	$('#btn-select-size').click(function() {
		var size=$('#select-size').val();
		$("#newSizes").append($('<div>', {
			class: "form-group col-lg-5 col-md-5 col-12 size",
			size: size
		}).append($('<label>', {
			class: "col-form-label",
			text: "Tamaño"
		})).append($('<input>', {
			type: 'text',
			class: "form-control",
			disabled: "disabled",
			value: $('#select-size option:selected').text();
		})).append($('<input>', {
			type: 'hidden',
			class: "form-control",
			name: "size[]"
			value: $('#select-size').val();
		})));

		$("#newSizes").append($('<div>', {
			class: "form-group col-lg-5 col-md-5 col-12 size",
			size: size
		}).append($('<label>', {
			class: "col-form-label",
			text: "Precio"
		}).append($('<b>', {
			class: "text-danger",
			text: "*"
		}))).append($('<input>', {
			class: "form-control price",
			name: "price[]",
			required: "required"
			value: 1,
			min: 1
		})));

		$("#newSizes").append($('<div>', {
			class: "form-group col-lg-2 col-md-2 col-12 size",
			size: size
		}).append($('<button>', {
			type: "button",
			class: "btn btn-danger deleteSize",
			size: size
		}).append($('<i>', {
			class: "fa fa-close"
		}))));

    	//Quitar tamaño de producto
    	$('.deleteSize').on("click", function() {
    		var size=$(this).attr('size');
    		$('.size[size="'+size+'"]').remove();
    	});
    });
</script>
@endsection