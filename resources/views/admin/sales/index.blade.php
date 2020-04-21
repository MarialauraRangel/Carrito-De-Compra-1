@extends('layouts.admin')

@section('title', 'Lista de Ventas')
@section('page-title', 'Lista de Ventas')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/lobibox/Lobibox.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">Ventas</li>
<li class="breadcrumb-item active">Lista</li>
@endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="tabla" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>#</th>
								<th>Producto</th>
								<th>Forma de Pago</th>
								<th>Total</th>
								<th>Estado</th>
								<th>Fecha</th>
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
								<td>{{ "S/. ".number_format($payment->total, 2, ".", "") }}</td>
								<td>{!! saleState($payment->state) !!}</td>
								<td>{{ date("d-m-Y", strtotime($payment->created_at)) }}</td>
								<td class="d-flex">
									<a class="btn btn-primary btn-circle btn-sm" href="{{ route('ventas.show', ['slug' => $payment->slug]) }}"><i class="fa fa-briefcase"></i></a>&nbsp;&nbsp;
									@if($payment->state==2)
									<a class="btn btn-success btn-circle btn-sm text-white" onclick="confirmPay('{{ $payment->slug }}')"><i class="fa fa-check"></i></a>&nbsp;&nbsp;
									<a class="btn btn-danger btn-circle btn-sm text-white" onclick="refusePay('{{ $payment->slug }}')"><i class="fa fa-close"></i></a>
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="confirmPay" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">¿Estás seguro de que quieres confirmar este pago?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<form action="#" method="POST" id="formConfirmPay">
					@csrf
					@method('PUT')
					<button type="submit" class="btn btn-primary">Confirmar</button>
				</form>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="refusePay" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">¿Estás seguro de que quieres rechazar este pago?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="#" method="POST" id="formRefusePay" class="modal-footer">
				@csrf
				@method('PUT')
				<div class="row">
					<div class="form-group col-12">
						<label class="col-form-label">Explicación<b class="text-danger">*</b></label>
						<textarea class="form-control" name="explanation" required placeholder="Introduce la razón del rechazo del pago"></textarea>
					</div>
					<div class="form-group col-12 d-flex justify-content-end">
						<button type="submit" class="btn btn-primary mr-2">Rechazar</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section('script')
<script src="{{ asset('/admins/vendors/lobibox/Lobibox.js') }}"></script>
<script src="{{ asset('/admins/vendors/datatables/jquery.dataTables.min.js') }}"></script>
@endsection