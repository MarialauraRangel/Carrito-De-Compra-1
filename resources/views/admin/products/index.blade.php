@extends('layouts.admin')

@section('title', 'Lista de Productos')
@section('page-title', 'Lista de Productos')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/lobibox/Lobibox.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">Productos</li>
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
								<th>Cantidad</th>
								<th>Categoria</th>
								<th>Subcategoria</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($products as $product)
							<tr>
								<td>{{ $num++ }}</td>
								<td>
									<span class="image-list">
										@if(count($product->images)>0)
										<a data-toggle="tooltip" data-placement="bottom" data-html="true" title="<img src='{{ asset('/admins/img/products/'.$product->images[0]->image) }}' style='width: 150px; height: 150px;' ><br><b>{{ $product->name }}</b>"><img src="{{ asset('/admins/img/products/'.$product->images[0]->image) }}" class="img-circle" alt="Foto de perfil" width="40" height="40" /> {{ $product->name }}</a>
										@else
										<a data-toggle="tooltip" data-placement="bottom" data-html="true" title="<img src='{{ asset('/admins/img/products/imagen.jpg') }}' style='width: 150px; height: 150px;' ><br><b>{{ $product->name }}</b>"><img src="{{ asset('/admins/img/products/imagen.jpg') }}" class="img-circle" alt="Foto de perfil" width="40" height="40" /> {{ $product->name }}</a>
										@endif
									</span>
								</td>
								<td>{{ $product->qty }}</td>
								<td>{{ $product->subcategory->category->name }}</td>
								<td>{{ $product->subcategory->name }}</td>
								<td class="d-flex">
									<a class="btn btn-info btn-circle btn-sm" href="{{ route('productos.edit', ['slug' => $product->slug]) }}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
									@if(count($product->payments)==0)
									<button class="btn btn-danger btn-circle btn-sm" onclick="deleteProduct('{{ $product->slug }}')"><i class="fa fa-trash"></i></button>
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

<div class="modal fade" id="deleteProduct" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">¿Estás seguro de que quieres eliminar este producto?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<form action="#" method="POST" id="formDeleteProduct">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-primary">Eliminar</button>
				</form>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>

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