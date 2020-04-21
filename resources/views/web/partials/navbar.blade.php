<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	<div class="container">
		<a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('/web/images/imagotipo.png') }}" width="170" alt="Logo"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="oi oi-menu"></span> Menu
		</button>

		<div class="collapse navbar-collapse" id="ftco-nav">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active"><a href="{{ route('home') }}" class="nav-link">Inicio</a></li>
				<li class="nav-item"><a class="nav-link" href="#">Tienda</a></li>
				<li class="nav-item"><a href="#" class="nav-link">Categorías</a></li>
				@guest
				<li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Ingresar</a></li>
				<li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Registrarse</a></li>
				@else
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
					<div class="dropdown-menu" aria-labelledby="dropdown05">
						@if(Auth::user()->type==1 || Auth::user()->type==2)
						<a class="dropdown-item" href="{{ route('admin') }}">Panel Administrativo</a>
						@endif
						{{-- <a class="dropdown-item" href="{{ route('web.profile') }}">Perfil</a> --}}
						{{-- <a class="dropdown-item" href="{{ route('web.sales') }}">Mis Compras</a> --}}
						<hr class="w-75 my-0">
						<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</div>
				</li>
				@endguest
			</ul>
		</div>
	</div>
</nav>