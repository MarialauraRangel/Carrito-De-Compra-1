@extends('layouts.web')

@section('title', 'Compras')

@section('content')
<div class="hero-wrap hero-bread" >
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				<h1 class="mb-0 bread">{{ $sale->created_at }}</h1>
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
								<th>#</th>
								<th>Producto</th>
								<th>Tamaño</th>
								<th>Precio</th>
							</tr>
						</thead>
						<tbody>
							@foreach($order as $o)
							<tr>
								<td>{{ $num++ }}</td>
								<td class="image-prod">
									<div class="img" title="{{ $o->product->name }}" style="background-image:url({{ asset('/admins/img/products/'.$o->product->image) }});"></div>
								</td>
								<td>{{ $o->size->name }}</td>
								<td>{{ $o->price }} Bs</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection

@section('script')
<script src="{{ asset('/admins/vendors/datatables/jquery.dataTables.min.js') }}"></script>
@endsection