@extends('layouts.admin')

@section('title', 'Lista de Tiendas')
@section('page-title', 'Lista de Tiendas')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/lobibox/Lobibox.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">Tiendas</li>
<li class="breadcrumb-item active">Lista</li>
@endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="tablaExport" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>#</th>
								<th>Nombre</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($stores as $store)
							<tr>
								<td>{{ $num++ }}</td>
								<td>{{ $store->name }}</td>
								<td class="d-flex">
									{{-- <a class="btn btn-primary btn-circle btn-sm" href="{{ route('tiendas.show', ['slug' => $store->slug]) }}"><i class="fa fa-briefcase"></i></a>&nbsp;&nbsp; --}}
									<a class="btn btn-info btn-circle btn-sm" href="#{{-- {{ route('tiendas.edit', ['slug' => $store->slug]) }} --}}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
									@if(Auth::user()->type==1)
									@if($store->state==1)
									<button class="btn btn-danger btn-circle btn-sm" onclick="desactivateStore('{{ $store->slug }}')"><i class="fa fa-power-off"></i></button>
									@else
									<button class="btn btn-success btn-circle btn-sm" onclick="activateStore('{{ $store->slug }}')"><i class="fa fa-history"></i></button>
									@endif
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

@if(Auth::user()->type==1)

<div class="modal fade" id="desactivateStore" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">¿Estás seguro de que quieres desactivar esta tienda?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<form action="#" method="POST" id="formDesactivateStore">
					@csrf
					@method('PUT')
					<input type="hidden" name="state" value="2">
					<button type="submit" class="btn btn-primary">Desactivar</button>
				</form>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="activateStore" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">¿Estás seguro de que quieres activar esta tienda?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<form action="#" method="POST" id="formActivateStore">
					@csrf
					@method('PUT')
					<input type="hidden" name="state" value="1">
					<button type="submit" class="btn btn-primary">Activar</button>
				</form>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>
@endif

@endsection

@section('script')
<script src="{{ asset('/admins/vendors/lobibox/Lobibox.js') }}"></script>
<script src="{{ asset('/admins/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/datatables/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/datatables/buttons/dataTables.flash.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/datatables/buttons/jszip.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/datatables/buttons/pdfmake.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/datatables/buttons/vfs_fonts.js') }}"></script>
<script src="{{ asset('/admins/vendors/datatables/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/datatables/buttons/buttons.print.min.js') }}"></script>
@endsection