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
								<th>Pedido</th>
								<th>Cliente</th>
								<th>Tienda</th>
								<th>Cajero y Repartidor</th>
								<th>Estado</th>
								<th><i class="fa fa-clock-o"></i></th>
								<th>Procesar</th>
							</tr>
						</thead>
						<tbody>
							@foreach($sale as $s)
							<tr>
								<td>{{ $num++ }}</td>
								<td>{{ $s->order_id }}</td>
								<td>{{ $s->customer->name }} {{ $s->customer->lastname }}</td>
								<td>{{ $s->stores->name }}</td>
								<td>
									@if($s->cajero_id==NULL)
									<button class="btn btn-success text-white" onclick="confirmUsers('{{ $s->slug }}')">Asignar</button>
									@else
									{{ $s->cajero_id }} | {{ $s->delivery_man_id }} 
									@endif
								</td>
								<td>{!! saleState($s->state) !!}</td>
								<td>		
									@if($s->time==NULL)
									<button class="btn btn-success text-white" onclick="confirmTime('{{ $s->slug }}')">Empezar</button>
								@endif</td>
								<td class="d-flex">
									<a class="btn btn-primary btn-circle btn-sm" href="{{ route('venta.show', ['slug' => $s->slug]) }}"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
									<a class="btn btn-success btn-circle btn-sm text-white" onclick="confirmState('{{ $s->slug }}')"><i class="fa fa-check"></i></a>&nbsp;&nbsp;
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

<div class="modal fade" id="confirmUsers" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Introduzca el caero y repartidor correspondiente</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<form action="#" method="POST" id="formConfirmUsers">
					@csrf
					@method('PUT')
					<div class="row">
						<div class="form-group col-6">
							<label class="col-form-label">Seleccione el cajero<b class="text-danger">*</b></label>
							<div class="form-group col-12">
								<select class="form-control" name="casher_id">
									<option>Seleccione</option>
									@foreach($casher as $c)
									<option value="{{ $c->id }}">{{ $c->id }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group col-6">
							<label class="col-form-label">Seleccione el repartidor<b class="text-danger">*</b></label>
							<div class="form-group col-12">
								<select class="form-control" name="delivery_man_id">
									<option>Seleccione</option>
									@foreach($deliveryMan as $d)
									<option value="{{ $d->id }}">{{ $d->name." ".$d->lastname }} -> {{ $d->store_id }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group col-12 d-flex justify-content-end">
							<button type="submit" class="btn btn-primary mr-2">Asignar</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="confirmTime" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">¿Desea inicializar el tiempo de entrega?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="#" method="POST" id="formConfirmTime" class="modal-footer">
				@csrf
				@method('PUT')
				<div class="row">
					<div class="form-group col-12 d-flex justify-content-end">
						<button type="submit" class="btn btn-primary mr-2">Si</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="confirmState" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Introduzca el estado actual del pedido</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="#" method="POST" id="formConfirmState" class="modal-footer">
				@csrf
				@method('PUT')
				<div class="row">
					<div class="form-group col-12">
						<label class="col-form-label">Seleccione el estado<b class="text-danger">*</b></label>
						<div class="form-group col-12">
							<select class="form-control">
								<option>Seleccione</option>
								<option value="1">Preparación En Proceso</option>
								<option value="2">Enviado</option>
								<option value="3">Entregado</option>
								<option value="4">Reembolso</option>
								<option value="5">Productos Fuera de Linea</option>
								<option value="6">Error en el pago</option>
								<option value="7">Pago mediante cheque pendiente</option>
								<option value="8">Pago por transferencia bancaria pendiente</option>
								<option value="9">Pago mediante PayPal pendiente</option>
								<option value="10">Pago Aceptado</option>
								<option value="11">Cancelado</option>
							</select>
						</div>
					</div>
					<div class="form-group col-12 d-flex justify-content-end">
						<button type="submit" class="btn btn-primary mr-2">Cambiar</button>
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