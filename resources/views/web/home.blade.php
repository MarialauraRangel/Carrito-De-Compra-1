@extends('layouts.web')

@section('title', 'Carrito de Compra')

@section('links')
<link rel="stylesheet" href="{{ asset('/web/vendors/select2/select2.css') }}">
<link rel="stylesheet" href="{{ asset('/web/vendors/select2/select2-bootstrap.css') }}">
@endsection

@section('content')

<body class="goto-here">
    <section id="home-section" class="hero">
        <div class="home-slider owl-carousel">
            <div class="slider-item" style="background-image: url(web/images/bg_2.jpg);">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                        <div class="col-md-12 ftco-animate text-center">
                            <h1 class="mb-2">Las Mejores Pizzas</h1>
                            <h2 class="subheading mb-4">Para los mejores &amp; clientes</h2>
                            <p><a href="#" class="btn btn-primary">Ver Más</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row no-gutters ftco-services">
                <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services mb-md-0 mb-4">
                        <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
                            <span class="flaticon-shipped"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Envíos a tiempo</h3>
                            <span>Envíos hasta la comodidad de tu hogar</span>
                        </div>
                    </div>      
                </div>
                <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services mb-md-0 mb-4">
                        <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
                            <span class="flaticon-diet"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Ingredientes Frescos</h3>
                            <span>Pizzas con los ingredientes necesarios</span>
                        </div>
                    </div>    
                </div>
                <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
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
                <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
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
                        <a href="#" class="img-prod">
                            <img class="img-fluid" src="{{ asset('/admins/img/products/'.$product->image) }}" alt="{{ $product->name }}">
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3 text-center">
                            <h3><a href="#">{{ $product->name }}</a></h3>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price"><span>$120.00</span></p>
                                </div>
                            </div>
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">
                                    <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                        <span><i class="ion-ios-menu"></i></span>
                                    </a>
                                    <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
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
</body>

@endsection