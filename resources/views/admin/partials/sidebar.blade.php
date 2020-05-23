<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">MÓDULOS</li>
                <li><a class="waves-effect waves-dark" href="{{ route('admin') }}"><i class="fa fa-home"></i><span class="hide-menu">Inicio</span></a></li>
                @if(Auth::user()->type==1)
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Usuarios</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('usuario.create') }}">Registrar</a></li>
                        <li><a href="{{ route('usuario.index') }}">Lista</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-cutlery"></i><span class="hide-menu">Productos</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('productos.create') }}">Registrar</a></li>
                        <li><a href="{{ route('productos.index') }}">Lista</a></li>
                    </ul>
                </li>
                @endif
                @if(Auth::user()->type==1 || Auth::user()->type==2 || Auth::user()->type==3)
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-money"></i><span class="hide-menu">Ventas</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('venta.index') }}">Lista</a></li>
                    </ul>
                </li>
                @endif
                @if(Auth::user()->type==1)
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-sort-alpha-asc"></i><span class="hide-menu">Categorias</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('categorias.create') }}">Registrar</a></li>
                        <li><a href="{{ route('categorias.index') }}">Lista</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-building"></i><span class="hide-menu">Tiendas</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('tienda.create') }}">Registrar</a></li>
                        <li><a href="{{ route('tienda.index') }}">Lista</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-map"></i><span class="hide-menu">Distancias</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('distancias.create') }}">Registrar</a></li>
                        <li><a href="{{ route('distancias.index') }}">Lista</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-file"></i><span class="hide-menu">Páginas</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('paginas.create') }}">Registrar</a></li>
                        <li><a href="{{ route('paginas.index') }}">Lista</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="ti-shopping-cart"></i><span class="hide-menu">Servicios</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('servicios.create') }}">Registrar</a></li>
                        <li><a href="{{ route('servicios.index') }}">Lista</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-square"></i><span class="hide-menu">Sliders</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('sliders.create') }}">Registrar</a></li>
                        <li><a href="{{ route('sliders.index') }}">Lista</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-camera"></i><span class="hide-menu">Galería</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('galeria.create') }}">Registrar</a></li>
                        <li><a href="{{ route('galeria.index') }}">Lista</a></li>
                    </ul>
                </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>