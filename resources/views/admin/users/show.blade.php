@extends('layouts.admin')

@section('title', 'Ver Usuario')
@section('page-title', 'Ver Usuario')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/lobibox/Lobibox.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendors/dropify/css/dropify.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('usuario.index') }}">Usuarios</a></li>
<li class="breadcrumb-item active">Ver</li>
@endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">

				@include('admin.partials.errors')

				<h6 class="card-subtitle">Campos obligatorios (<b class="text-danger">*</b>)</h6>
				<form action="{{ route('usuario.update', ['slug' => $user->slug]) }}" method="POST" class="form" id="formUser" enctype="multipart/form-data">
					@method('PUT')
					@csrf
					<div class="row">
						<div class="form-group col-lg-6 col-md-6 col-12">
							<img src="{{ '/admins/img/users/'.$user->photo }}" class="img-fluid">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<div class="row">
								<div class="form-group col-lg-12 col-md-12 col-12">
									<label class="col-form-label">Nombre y Apellido</label>
									<input class="form-control" disabled type="text" disabled value="{{ $user->name.' '.$user->lastname }}">
								</div>
								<div class="form-group col-lg-12 col-md-12 col-12">
									<label class="col-form-label">Correo Electrónico</label>
									<input class="form-control" disabled type="text" name="email" value="{{ $user->email }}">
								</div>
								<div class="form-group col-lg-12 col-md-12 col-12">
									<label class="col-form-label">Teléfono</label>
									<input class="form-control" disabled name="phone" type="text" value="{{ $user->phone }}">
								</div>
								<div class="form-group col-lg-12 col-md-12 col-12">
									<label class="col-form-label">DNI</label>
									<input class="form-control" disabled name="dni" type="text" value="{{ $user->dni }}">
								</div>
								<div class="form-group col-lg-12 col-md-12 col-12">
									<label class="col-form-label">Tipo</label>
									<input class="form-control" disabled name="type" type="text" @if($user->type==1) value="Super Administrador" @endif @if($user->type==2) value="Administrador de Tienda" @endif @if($user->type==3) value="Normal" @endif  >
								</div>
							</div>
						</div>
						
						<div class="form-group col-12">
							<div class="btn-group" role="group">
								<a href="{{ route('usuario.index') }}" class="btn btn-secondary">Volver</a>
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
<script src="{{ asset('/admins/vendors/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/lobibox/Lobibox.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
@endsection