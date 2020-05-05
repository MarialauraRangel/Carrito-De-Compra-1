@extends('layouts.web')

@section('title', 'Menú')

@section('content')

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mb-5 text-center">
                <ul class="product-category">
                    <li><a href="#" category="all" class="active">Todas</a></li>
                    @foreach($categories as $category)
                    <li><a href="#" category="{{ $category->name }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-6 col-lg-3 ftco-animate menu-filter" category="{{ $product->category->name }}">
                <div class="product">
                    <a href="#" class="img-prod">
                        <img class="img-fluid" src="{{ asset('/admins/img/products/'.$product->image) }}" alt="{{ $product->name }}">
                        <div class="overlay"></div>
                    </a>
                    <div class="text py-3 pb-4 px-3 text-center">
                        <h3><a href="{{ route('producto', ['slug' => $product->slug]) }}">{{ $product->name }}</a></h3>
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="price"><span class="price-sale">{{ number_format($product->price, 2, ",", ".") }} Bs</span></p>
                            </div>
                        </div>
                        <div class="bottom-area d-flex px-3">
                            <div class="m-auto d-flex">
                                <a href="{{ route('producto', ['slug' => $product->slug]) }}" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                    <span><i class="ion-ios-menu"></i></span>
                                </a>
                                <a class="btn-cart-open d-flex justify-content-center align-items-center mx-1" title="{{ $product->name }}" img="{{ asset('/admins/img/products/'.$product->image) }}" price="{{ number_format($product->price, 2, '.', '') }}" description="{{ $product->description }}" slug="{{ $product->slug }}">
                                    <span><i class="ion-ios-cart"></i></span>
                                </a>
                            </div>
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