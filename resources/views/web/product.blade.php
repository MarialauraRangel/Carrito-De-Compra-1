@extends('layouts.web')

@section('title', 'Producto')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/touchspin/jquery.bootstrap-touchspin.min.css') }}">
@endsection

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
									@foreach($product->sizes as $size)
									<option value="{{ $size->slug }}">{{ $size->name." - ".number_format($size->pivot->price, 2, ",", ".")." Bs" }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>
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
				<h2 class="mb-4">Productos Relacionados</h2>
			</div>
		</div>   		
	</div>
	<div class="container">
		<div class="row">
			@foreach($products as $product)
			<div class="col-md-6 col-lg-3 ftco-animate">
				<div class="product">
					<a href="{{ route('producto', ['slug' => $product->slug]) }}" class="img-prod">
						<img class="img-fluid" src="{{ asset('/admins/img/products/'.$product->image) }}" alt="{{ $product->name }}">
						<div class="overlay"></div>
					</a>
					<div class="text py-3 pb-4 px-3 text-center">
						<h3><a href="{{ route('producto', ['slug' => $product->slug]) }}">{{ $product->name }}</a></h3>
                        <div class="row d-flex justify-content-center">
                            <a href="{{ route('producto', ['slug' => $product->slug]) }}" class="btn btn-primary">
                                <span><i class="ion-ios-menu"></i></span>
                            </a>
                            <a class="btn btn-primary btn-cart-open mx-1" slug="{{ $product->slug }}" image="{{ asset('/admins/img/products/'.$product->image) }}">
                                <span><i class="ion-ios-cart"></i></span>
                            </a>
                        </div> 
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</section>

<div class="modal fade" id="modal-cart" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-cart"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <img src="" class="w-100 img-fluid" id="img-cart">
                    </div>
                    <div class="col-12">
                        <p id="description-cart"></p>
                    </div>
                    <div class="form-group col-12">
                        <label class="col-form-label">Tienda</label>
                        <select class="form-control" name="store" id="select-store-cart">
                            <option value="">Seleccione</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label class="col-form-label">Tamaño</label>
                        <select class="form-control" name="size" id="select-size-cart">
                            <option value="">Seleccione</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label class="col-form-label">Cantidad</label>
                        <input type="text" class="form-control number" name="qty" placeholder="Introduzca una cantidad" min="1" value="1" id="modal-qty" price="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-add-cart" slug=""><b id="price-add-cart"></b> Agregar Al Carrito</button>
            </div>
        </div>
    </div>
</div>

@endsection