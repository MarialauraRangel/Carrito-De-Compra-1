@extends('layouts.admin')

@section('title', 'Perfil')
@section('page-title', 'Perfil')

@section('breadcrumb')
<li class="breadcrumb-item">Perfil</li>
@endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">

				@include('admin.partials.errors')

				<!--Little Profile widget-->
				<div class="little-profile text-center">
					<div class="pro-img m-t-20"><img src="/admins/img/users/{{ Auth::user()->photo }}" alt="user"></div>
					<h3 class="m-b-0">{{ Auth::user()->name." ".Auth::user()->lastname }}</h3>
					{{-- <h6 class="text-muted">Web Designer &amp; Developer</h6> --}}
				</div>
				<div class="text-center bg-light">
					<div class="row">
						<div class="col-6 p-20 b-r">
							<h4 class="m-b-0 font-medium">Correo Electrónico</h4><small>{{ Auth::user()->email }}</small>
						</div>
						<div class="col-6 p-20">
							<h4 class="m-b-0 font-medium">Tipo de Usuario</h4><small> @if (Auth::user()->type=='1')
								{{'Administrador'}}
							@endif </small>
						</div>
					</div>
				</div>
				<div class="text-center bg-light">
					<div class="row">
						<div class="col-6  p-20 b-r">
							<h4 class="m-b-0 font-medium">Estado</h4>@if (Auth::user()->state=='1')
							{{'Activo'}}
						@endif</div>
						<div class="col-6  p-20">
							<h4 class="m-b-0 font-medium">Fecha de Inscripción</h4><small>{{  Auth::user()->created_at }}</small></div>
						</div>
					</div>
					<div class="card-body text-center">
						<a href=" {{ route('admin') }}" class="m-t-10 m-b-20 waves-effect waves-dark btn btn-success btn-md btn-rounded">Volver al Inicio</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection