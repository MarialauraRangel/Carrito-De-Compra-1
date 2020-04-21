<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="user-profile"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><img src="{{ asset('/admins/img/users/'.Auth::user()->photo) }}" alt="Foto de perfil" /><span class="hide-menu">{{ Auth::user()->name." ".Auth::user()->lastname }} </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('home') }}">Volver a la Web</a></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sección</a></li>
                    </ul>
                </li>
                <li class="nav-devider"></li>
                <li class="nav-small-cap">MÓDULOS</li>
                <li><a class="waves-effect waves-dark" href="{{ route('admin') }}"><i class="mdi mdi-coffee"></i><span class="hide-menu">Inicio</span></a></li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-star"></i><span class="hide-menu">Usuarios</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('usuarios.create') }}">Registrar</a></li>
                        <li><a href="{{ route('usuarios.index') }}">Lista</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-home"></i><span class="hide-menu">Tiendas</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('tiendas.create') }}">Registrar</a></li>
                        <li><a href="{{ route('tiendas.index') }}">Lista</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-automobile (alias)"></i><span class="hide-menu">Productos</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('productos.create') }}">Registrar</a></li>
                        <li><a href="{{ route('productos.index') }}">Lista</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-shopping-cart"></i><span class="hide-menu">Ventas</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('ventas.index') }}">Lista</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa  fa-sort-alpha-asc"></i><span class="hide-menu">Categorias</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('categorias.create') }}">Registrar</a></li>
                        <li><a href="{{ route('categorias.index') }}">Lista</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>