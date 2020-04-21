@extends('layouts.web')

@section('title', 'Carrito de Compra')

@section('links')
<link rel="stylesheet" href="{{ asset('/web/vendors/select2/select2.css') }}">
<link rel="stylesheet" href="{{ asset('/web/vendors/select2/select2-bootstrap.css') }}">
@endsection

@section('content')


<div class="hero-wrap hero-bread" style="background-image: url('web/images/bg_2.jpg');">
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Carrito</span></p>
				<h1 class="mb-0 bread">Mis Compras</h1>
			</div>
		</div>
	</div>
</div>

<section class="ftco-section ftco-cart">
	<div class="container">
		<div class="row">
			<div class="col-md-12 ftco-animate">
				<div class="cart-list">
					<table class="table">
						<thead class="thead-primary">
							<tr class="text-center">
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th>Tipo de Pizza</th>
								<th>Precio</th>
								<th>Cantidad</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							<tr class="text-center">
								<td class="product-remove"><a href="#"><span class="ion-ios-close"></span></a></td>

								<td class="image-prod"><div class="img" style="background-image:url(web/images/product-3.jpg);"></div></td>

								<td class="product-name">
									<h3>Nombre</h3>
									<p>Ingredientes, Ingrediente, Ingredientes</p>
								</td>

								<td class="price">$4.90</td>

								<td class="quantity">
									<div class="input-group mb-3">
										<input type="text" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
									</div>
								</td>

								<td class="total">$4.90</td>
							</tr><!-- END TR-->

							<tr class="text-center">
								<td class="product-remove"><a href="#"><span class="ion-ios-close"></span></a></td>

								<td class="image-prod"><div class="img" style="background-image:url(web/images/product-4.jpg);"></div></td>

								<td class="product-name">
									<h3>Nombre</h3>
									<p>Ingredientes, Ingrediente, Ingredientes</p>
								</td>

								<td class="price">$15.70</td>

								<td class="quantity">
									<div class="input-group mb-3">
										<input type="text" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
									</div>
								</td>

								<td class="total">$15.70</td>
							</tr><!-- END TR-->
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="row justify-content-end">
			<div class="col-lg-6 mt-5 cart-wrap ftco-animate">
				<div class="cart-total mb-3">
					<h3>Total</h3>
					<p class="d-flex">
						<span>Subtotal</span>
						<span>$20.60</span>
					</p>
					<p class="d-flex">
						<span>Delivery</span>
						<span>$0.00</span>
					</p>
					<hr>
					<p class="d-flex total-price">
						<span>Total</span>
						<span>$17.60</span>
					</p>
				</div>
				<p><a href="checkout.html" class="btn btn-primary py-3 px-4">Siguiente</a></p>
			</div>
		</div>
	</div>
</section>


@endsection