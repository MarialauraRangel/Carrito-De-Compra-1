@extends('layouts.admin')

@section('title', 'Lista de Páginas')
@section('page-title', 'Lista de Páginas')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/lobibox/Lobibox.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">Páginas</li>
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
								<th>Título</th>
								<th>Link</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($pages as $page)
							<tr>
								<td>{{ $num++ }}</td>
								<td>
									<span class="image-list">
										<a data-toggle="tooltip" data-placement="bottom" data-html="true" title="<img src='{{ asset('/admins/img/pages/'.$page->image) }}' style='width: 150px; height: 150px;' >"><img src="{{ asset('/admins/img/pages/'.$page->image) }}" class="img-circle" alt="Foto de la página" width="40" height="40" /> {{ $page->title }}</a>
									</span>
								</td>
								<td>{{ $page->link }}</td>
								<td>{!! state($page->state) !!}</td>
								<td class="d-flex">
									<a class="btn btn-info btn-circle btn-sm" href="{{ route('paginas.edit', ['slug' => $page->slug]) }}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
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