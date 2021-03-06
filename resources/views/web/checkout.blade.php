@extends('layouts.web')

@section('title', 'Comprar')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/leaflet/leaflet.css') }}">
@endsection

@section('content')

<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-4 col-lg-4 order-lg-1 order-xl-1">
				<div class="row">
					<div class="col-md-12 d-flex mb-5">
						<div class="cart-detail cart-total p-3 p-md-4">
							<h3 class="billing-heading mb-4">Total de La Compra</h3>
							<p class="d-flex">
								<span>Subtotal</span>
								<span id="subtotal">{{ number_format($total, 2, ",", ".") }} Bs</span>
							</p>
							<p class="d-flex">
								<span>Delivery</span>
								<span id="total-delivery">0,00 Bs</span>
							</p>
							<hr>
							<p class="d-flex total-price">
								<span>Total</span>
								<span id="total" total="{{ $total }}">{{ number_format($total, 2, ",", ".") }} Bs</span>
							</p>
						</div>
					</div>
				</div>
			</div>

			<div class="col-12">
				@include('admin.partials.errors')
			</div>

			@guest
			<div class="col-xl-4 col-lg-4 order-lg-0 order-xl-0 ftco-animate">
				<form action="{{ route('login') }}" method="POST" id="formLogin">
					@csrf
					<div class="row align-items-end">
						<div class="col-12">
							<div class="cart-detail cart-total p-3 p-md-4 bg-white">
								<p class="h4 text-center mt-2">Iniciar Sesión</p>
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<label>Correo Electrónico</label>
											<input class="form-control @error('email') is-invalid @enderror" type="email" name="email" required placeholder="{{ 'ejemplo@gmail.com' }}" value="{{ old('email') }}">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label>Contraseña</label>
											<input class="form-control @error('password') is-invalid @enderror" type="password" required name="password" placeholder="********">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group text-center">
											<button class="btn btn-primary" type="submit" action="login">Ingresar</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>

			<div class="col-xl-4 col-lg-4 order-lg-0 order-xl-0 ftco-animate">
				<form action="{{ route('register') }}" method="POST" id="formRegister">
					@csrf
					<div class="row align-items-end">
						<div class="col-12">
							<div class="cart-detail cart-total p-3 p-md-4 bg-white">
								<p class="h4 text-center mt-2">Registrarse</p>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Nombre</label>
											<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required placeholder="Ejm: Juan" value="{{ old('name') }}" autocomplete="name" autofocus>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Apellido</label>
											<input class="form-control @error('lastname') is-invalid @enderror" type="text" name="lastname" required placeholder="Ejm: Lopez" value="{{ old('lastname') }}" autocomplete="lastname">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label>Correo Electrónico</label>
											<input class="form-control @error('email') is-invalid @enderror" type="email" name="email" required placeholder="{{ 'ejemplo@gmail.com' }}" value="{{ old('email') }}">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label>Contraseña</label>
											<input class="form-control @error('password') is-invalid @enderror" type="password" required name="password" placeholder="********" id="password">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label>Confirmar Contraseña</label>
											<input class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="********">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group text-center">
											<button class="btn btn-primary" type="submit" action="register">Registrarse</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			@else
			<div class="col-xl-8 col-lg-8 order-lg-0 order-xl-0 ftco-animate">
				<form action="{{ route('pago.store') }}" method="POST" id="formSale" class="billing-form">
					@csrf
					<h3 class="mb-4 billing-heading">Detalles de La Compra</h3>
					<div class="row align-items-end">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="form-group">
								<label for="firstname">Nombre y Apellido</label>
								<input type="text" class="form-control" disabled value="{{ Auth::user()->name.' '.Auth::user()->lastname }}">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12">
							<div class="form-group">
								<label for="emailaddress">Correo Electrónico</label>
								<input type="text" class="form-control" disabled value="{{ Auth::user()->email }}">
							</div>
						</div>
						<div class="w-100"></div>
						<div class="col-lg-6 col-md-6 col-12">
							<div class="form-group">
								<label for="phone">Teléfono</label>
								<input type="text" class="form-control" required name="phone" placeholder="Introduzca su número telefónico" @if(Auth::user()->phone!=NULL) value="{{ Auth::user()->phone }}" @endif>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12">
							<div class="form-group">
								<label for="phone">DNI</label>
								<input type="text" class="form-control" required name="dni" placeholder="Introduzca su dni"  @if(Auth::user()->dni!=NULL) value="{{ Auth::user()->dni }}" readonly @endif>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12">
							<div class="form-group">
								<label for="phone">Seleccione la tienda a solicitar los productos</label>
								<select class="form-control" required name="store_id">
									<option value="">Seleccione</option>
									@foreach($stores as $s)
									<option value="{{ $s->slug }}">{{ $s->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12">
							<div class="form-group">
								<label for="phone">Distancia a recorrer</label>
								<select class="form-control" required name="distance_id" id="delivery">
									<option value="">Seleccione</option>
									@foreach($distance as $d)
									<option value="{{ $d->slug }}" price="{{ $d->price }}">@if($d->km>0) {{ number_format($d->km, 1, ",", ".")." kilometros" }} @else Local @endif - @if($d->price>0) {{ number_format($d->price, 2, ",", ".")." Bs" }} @else {{ "Gratis" }} @endif</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="streetaddress">Dirección</label>
								<input type="text" name="address" class="form-control" required placeholder="Introduzca su dirección (calle, número de casa, avenida, etc)">
							</div>
						</div>
						<div class="col-12 d-none" id="deliveryMap">
							<div class="form-group">
								<label class="col-form-label">Busca la ubicación en la que quieres que llegue el producto y da click en ese lugar<b class="text-danger">*</b></label>
								<div id="error_mensaje"></div>
								<div id="map" style="height: 250px;"></div>
								<input type="hidden" name="lat" value="-17.3779267" id="lat">
								<input type="hidden" name="lng" value="-66.1455536" id="lng">
							</div>
						</div>

						<div class="col-12">
							<div class="form-group">
								<p>
									<a class="btn btn-sm btn-link" data-toggle="modal" data-target="#modal-prado"><i class="icon-map text-primary"></i> Ver Mapa Delivery Prado</a>
									<a class="btn btn-sm btn-link" data-toggle="modal" data-target="#modal-circunvalacion"><i class="icon-map text-primary"></i> Ver Mapa Delivery Circunvalación</a>
								</p>
							</div>
						</div> 

						<div class="col-12">
							<div class="form-group">
								<p>
									<button type="submit" action="sale" class="btn btn-primary py-3 px-4">Finalizar Compra</button>
									<a href="{{ route('menu') }}" class="btn btn-primary py-3 px-4">Seguir Comprando</a>
								</p>
							</div>
						</div> 
					</div>
				</form>
			</div>
			@endguest
		</div>
	</div>
</section>

<div class="modal fade" id="modal-prado" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mapa de Delivery de Prado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <iframe src="https://www.google.com/maps/d/embed?mid=1YXmjYkh2JHCmo7C1THmueg0fAbWaYi68" width="100%" height="500" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-circunvalacion" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mapa de Delivery de Circunvalación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <iframe src="https://www.google.com/maps/d/embed?mid=12c8c6MCsX2ZtKBjt6FaUuMbjcQ-PRC6e" width="100%" height="500" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{ asset('/admins/vendors/leaflet/leaflet.js') }}"></script>
<script src="{{ asset('/admins/vendors/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
@endsection