@extends('layouts.admin')

@section('title', 'Lista de Solicitudes de Tiendas')
@section('page-title', 'Lista de Solicitudes de Tiendas')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/lobibox/Lobibox.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">Solicitudes</li>
<li class="breadcrumb-item active">Lista de Tiendas</li>
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
								<th>Nombre de la Tienda</th>
								<th>Estado</th>
								<th>Solicitante</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($storesRequest as $request)
							<tr>
								<td>{{ $num++ }}</td>
								<td>{{ $request->name }}</td>
								<td>{!! storeRequetsState($request->state) !!}</td>
								<td>
									<span class="image-list">
										<a data-toggle="tooltip" data-placement="bottom" data-html="true" title="<img src='{{ asset('/admins/img/users/'.$request->users[0]->photo) }}' style='width: 150px; height: 150px;' ><br><b>{{ $request->users[0]->name.' '.$request->users[0]->lastname }}</b>"><img src="{{ asset('/admins/img/users/'.$request->users[0]->photo) }}" class="img-circle" alt="Foto de perfil" width="40" height="40" /> {{ $request->users[0]->name." ".$request->users[0]->lastname }}</a>
									</span>
								</td>
								<td class="d-flex">
									<a class="btn btn-primary btn-circle btn-sm" title="Ver Más" href="{{ route('tiendas.request.show', ['slug' => $request->slug]) }}"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
									<a class="btn btn-info btn-circle btn-sm text-white" title="Confirmar" onclick="confirmStore('{{ $request->slug }}')"><i class="fa fa-check"></i></a>&nbsp;&nbsp;
									<a class="btn btn-danger btn-circle btn-sm text-white" title="Rechazar" onclick="refuseStore('{{ $request->slug }}')"><i class="fa fa-times"></i></a>
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

{{-- //////////////////////////////////CONFIRMAR////////////////////////////// --}}

<div class="modal fade" id="confirmStore" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">¿Estás seguro de que quieres confirmar esta tienda?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<form action="#" method="POST" id="formConfirmStore">
					@csrf
					@method('PUT')
					<button type="submit" class="btn btn-primary">Confirmar</button>
				</form>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>

{{-- //////////////////////////////////////////////////RECHAZAR///////////////////////// --}}

<div class="modal fade" id="refuseStore" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">¿Estás seguro de que quieres rechazar esta tienda?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="#" method="POST" id="formRefuseStore" class="modal-footer">
				@csrf
				@method('PUT')
				<div class="row">
					<div class="form-group col-12">
						<label class="col-form-label">Explicación<b class="text-danger">*</b></label>
						<textarea class="form-control" name="explanation" required placeholder="Introduce la razón del rechazo de la solicitud"></textarea>
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