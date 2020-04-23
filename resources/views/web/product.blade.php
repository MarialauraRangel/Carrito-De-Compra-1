@extends('layouts.web')

@section('title', 'Carrito de Compra')

@section('links')

@endsection

@section('content')

<section class="ftco-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 mb-5 ftco-animate">
				<a href="{{ asset('/admins/img/products/'.$product->image) }}" class="image-popup"><img src="{{ asset('/admins/img/products/'.$product->image) }}" class="img-fluid" alt="{{ $product->name }}"></a>
			</div>
			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
				<h3>{{ $product->name }}</h3>
				<div class="rating d-flex">
					<p class="text-left">
						<a class="mr-2" style="color: #000;">Categoría: <span>{{ $product->category->name }}</span></a>
					</p>
				</div>
				<div class="row mt-4">
					<div class="col-md-6">
						<div class="form-group d-flex">
							<div class="select-wrap">
								<div class="icon"><span class="ion-ios-arrow-down"></span></div>
								<select name="" id="" class="form-control">
									<option value="">Pequeña</option>
									<option value="">Mediana</option>
									<option value="">Grande</option>
									<option value="">Gigante</option>
									<option value="">Súper Gigante</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<p class="price"><span>{{ number_format($product->price, 2, ",", ".") }} Bs</span></p>
				<p>{{ $product->description }}</p>
				<p><a href="cart.html" class="btn btn-black py-3 px-5">Agregar al carrito</a></p>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center mb-3 pb-3">
			<div class="col-md-12 heading-section text-center ftco-animate">
				<span class="subheading">Nuestras Pizzas</span>
				<h2 class="mb-4">Más Destacadas</h2>
			</div>
		</div>   		
	</div>
	<div class="container">
		<div class="row">
			@foreach($products as $product)
			<div class="col-md-6 col-lg-3 ftco-animate">
				<div class="product">
					<a href="#" class="img-prod">
						<img class="img-fluid" src="{{ asset('/admins/img/products/'.$product->image) }}" alt="{{ $product->name }}">
						<div class="overlay"></div>
					</a>
					<div class="text py-3 pb-4 px-3 text-center">
						<h3><a href="#">{{ $product->name }}</a></h3>
						<div class="d-flex">
							<div class="pricing">
								<p class="price"><span>{{ number_format($product->price, 2, ",", ".") }} Bs</span></p>
							</div>
						</div>
						<div class="bottom-area d-flex px-3">
							<div class="m-auto d-flex">
								<a href="{{ route('producto', ['slug' => $product->slug]) }}" class="add-to-cart d-flex justify-content-center align-items-center text-center">
									<span><i class="ion-ios-menu"></i></span>
								</a>
								<a class="btn-cart-open d-flex justify-content-center align-items-center mx-1" title="{{ $product->name }}" img="{{ asset('/admins/img/products/'.$product->image) }}" price="{{ number_format($product->price, 2, '.', '') }}" description="{{ $product->description }}" slug="{{ $product->slug }}">
									<span><i class="ion-ios-cart"></i></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</section>

@endsection