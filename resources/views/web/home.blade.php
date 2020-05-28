@extends('layouts.web')

@section('title', 'Inicio')

@section('links')
<link href="{{ asset('/admins/vendors/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/admins/vendors/touchspin/jquery.bootstrap-touchspin.min.css') }}">
@endsection

@section('content')

<section id="home-section" class="hero">
    <div class="home-slider owl-carousel-banner banner-height">
        @if(count($sliders)>1)
        <div id="carouselCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($sliders as $slider)
                <li data-target="#carouselCaptions" data-slide-to="{{ $loop->index }}" @if($loop->index==0) class="active" @endif></li>
                @endforeach
            </ol>
            <div class="carousel-inner banner-height">
                @foreach($sliders as $slider)
                <div class="carousel-item slider-item banner-height @if($loop->index==0) active @endif" style="background-image: url('/admins/img/sliders/{{ $sliders[0]->image }}');">
                    <div class="overlay"></div>
                    <div class="carousel-caption row slider-text justify-content-center align-items-center banner-height">
                        <div class="col-md-12 ftco-animate text-center">
                            <h1 class="mb-2">{{ $slider->title }}</h1>
                            <h2 class="subheading mb-4">{{ $slider->description }}</h2>
                            <p><a href="{{ $slider->link }}" class="btn btn-primary">Ver Más</a></p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        @elseif(count($sliders)==1)
        <div class="slider-item banner-height" style="background-image: url('/admins/img/sliders/{{ $sliders[0]->image }}');">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center banner-height" data-scrollax-parent="true">

                    <div class="col-md-12 ftco-animate text-center">
                        <h1 class="mb-2">{{ $sliders[0]->title }}</h1>
                        <h2 class="subheading mb-4">{{ $sliders[0]->description }}</h2>
                        <p><a href="{{ $sliders[0]->link }}" class="btn btn-primary">Ver Más</a></p>
                    </div>

                </div>
            </div>
        </div>
        @else
        <div class="slider-item banner-height" style="background-image: url(web/images/bg_2.jpg);">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center banner-height" data-scrollax-parent="true">

                    <div class="col-md-12 ftco-animate text-center">
                        <h1 class="mb-2">Las Mejores Pizzas</h1>
                        <h2 class="subheading mb-4">Para los mejores clientes</h2>
                        <p><a href="{{ route('menu') }}" class="btn btn-primary">Ver Más</a></p>
                    </div>

                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<section class="ftco-section ftco-no-pb">
    <div class="container">
        <div class="row no-gutters ftco-services">
            <div class="col-lg-3 col-md-3 col-6 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-shipped"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Envíos a tiempo</h3>
                        <span>Hasta la comodidad de tu hogar</span>
                    </div>
                </div>      
            </div>
            <div class="col-lg-3 col-md-3 col-6 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-diet"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Ingredientes Frescos</h3>
                        <span>Pizzas con los mejor necesarios</span>
                    </div>
                </div>    
            </div>
            <div class="col-lg-3 col-md-3 col-6 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-award"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Calidad Superior</h3>
                        <span>Productos de Calidad</span>
                    </div>
                </div>      
            </div>
            <div class="col-lg-3 col-md-3 col-6 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-customer-service"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Pedidos</h3>
                        <span>Tratos coridales por parte de nuestros empleados</span>
                    </div>
                </div>      
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Nuestras Mejores Pizzas</span>
                <h2 class="mb-4">Más Destacadas</h2>
                <p>Dentro de un lugar en donde suelen haber muchos sabores, ninguno se compara con el de nuestras pizzas</p>
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

@if(count($promotions)>0)
<section id="promos" class="ftco-section ftco-no-pt">
    <div class="container">

        <div class="row">
            <div class="col-lg-4">
                <div class="section-title" data-aos="fade-right">
                    <h2>Promociones</h2>
                    <p>¡No se pierda de las novedades y promociones que tenemos preparadas para usted días a días!.</p>
                </div>
                <div class="promo" data-aos="fade-right">
                    <h3>Delivery Prado</h3>
                    <p>Lunes a domingo: de 10:00h a 21:30h.<br>
                        <i class="icofont-phone">4527616</i><br>
                        <i class="icofont-brand-whatsapp"><a href="https://api.whatsapp.com/send?phone=59169533025"> +591 69533025</a></i>  
                    </p><br>
                    <h3>Delivery Circunvalación</h3>
                    <p>Lunes a domingo: de 15:00h a 21:30h.<br>
                        <i class="icofont-phone">4225088</i><br>
                        <i class="icofont-brand-whatsapp"><a href="https://api.whatsapp.com/send?phone=59169533025"> +591 69533080</a></i>  
                    </p>
                </div>

            </div>
            <div class="col-lg-8">
                <div class="owl-carousel promos-carousel">
                
                    @foreach($promotions as $promotion)
                    <div class="product">
                        <a href="{{ route('producto', ['slug' => $promotion->slug]) }}" class="img-prod">
                            <img class="img-fluid" src="{{ asset('/admins/img/products/'.$promotion->image) }}" alt="{{ $promotion->name }}">
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3 text-center">
                            <h3><a href="{{ route('producto', ['slug' => $promotion->slug]) }}">{{ $promotion->name }}</a></h3>
                            <div class="row d-flex justify-content-center">
                                <div class="col-12">
                                    <p>{!! $promotion->description !!}<br></p>
                                </div>
                                <a href="{{ route('producto', ['slug' => $promotion->slug]) }}" class="btn btn-primary">
                                    <span><i class="ion-ios-menu"></i></span>
                                </a>
                                <a class="btn btn-primary btn-cart-open mx-1" slug="{{ $promotion->slug }}" image="{{ asset('/admins/img/products/'.$promotion->image) }}">
                                    <span><i class="ion-ios-cart"></i></span>
                                </a>
                            </div> 
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>

    </div>
</section>
@endif

<section class="ftco-section img" style="background-image: url(web/images/bg_3.jpg);">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-md-6 heading-section ftco-animate deal-of-the-day ftco-animate">
                <span class="subheading">Los Mejores Precios para ti</span>
                <h2 class="mb-4">Servicio de Entrega</h2>
                <p>Desde nuestras instalaciones, viajaremos hasta la comodidad de tu hogar sin ningún inconveniente</p>
                <h3><a href="#">Hemos pensado en una mejor solución en esta cuarentena</a></h3>
            </div>
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
                    <div class="form-group col-12" id="stores-product-cart">
                        <label class="col-form-label">Disponible En:</label>
                        <p></p>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label class="col-form-label">Tamaño</label>
                        <select class="form-control" name="size" id="select-size-cart">
                            <option value="">Seleccione</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-12">
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

@section('script')
<script src="{{ asset('/admins/vendors/owl.carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
@endsection