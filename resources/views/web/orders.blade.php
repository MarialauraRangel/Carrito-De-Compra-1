@extends('layouts.web')

@section('title', 'Compras')

@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('/web/images/bg_1.jpg');">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				<h1 class="mb-0 bread">Compras Realizadas</h1>
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
								<th>Forma de Pago</th>
								<th>Total</th>
								<th>Estado</th>
								<th>Tienda</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($payments as $payment)
							<tr>
								<td>{{ $num++ }}</td>
								<td>
									<span class="image-list">
										@if(count($payment->products[0]->images)>0)
										<a data-toggle="tooltip" data-placement="bottom" data-html="true" title="<img src='{{ asset('/admins/img/products/'.$payment->products[0]->images[0]->image) }}' style='width: 150px; height: 150px;' ><br><b>{{ $payment->products[0]->name." x ".$payment->products[0]->pivot->qty }}</b>"><img src="{{ asset('/admins/img/products/'.$payment->products[0]->images[0]->image) }}" class="img-circle" alt="Foto de perfil" width="40" height="40" /> {{ $payment->products[0]->name." x ".$payment->products[0]->pivot->qty }}</a>
										@else
										<a data-toggle="tooltip" data-placement="bottom" data-html="true" title="<img src='{{ asset('/admins/img/products/imagen.jpg') }}' style='width: 150px; height: 150px;' ><br><b>{{ $payment->products[0]->name." x ".$payment->products[0]->pivot->qty }}</b>"><img src="{{ asset('/admins/img/products/imagen.jpg') }}" class="img-circle" alt="Foto de perfil" width="40" height="40" /> {{ $payment->products[0]->name." x ".$payment->products[0]->pivot->qty }}</a>
										@endif
									</span>
								</td>
								<td>{!! saleShape($payment->shape) !!}</td>
								<td class="price">{{ "S/. ".number_format($payment->total, 2, ".", "") }}</td>
								<td>{!! saleState($payment->state) !!}</td>
								<td>{{ $payment->products[0]->stores[0]->name }}</td>
								<td class="d-flex justify-content-center">
									<a href="{{ route('web.sales.show', ['slug' => $payment->slug]) }}" class="btn btn-primary"><i class="icon-eye"></i></a>
								</td>
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