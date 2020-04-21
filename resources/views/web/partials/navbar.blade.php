<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	<div class="container">
		<a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('/web/images/imagotipo.png') }}" width="170" alt="Logo"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="oi oi-menu"></span> Menu
		</button>

		<div class="collapse navbar-collapse" id="ftco-nav">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active"><a href="{{ route('home') }}" class="nav-link">Inicio</a></li>
				<li class="nav-item"><a class="nav-link" href="#">Pizzas</a></li>
				<li class="nav-item"><a class="nav-link" href="#">Mis Compras</a></li>
				<li class="nav-item cta cta-colored"><a href="cart.html" class="nav-link"><span class="icon-shopping_cart"></span>[0]</a></li>
			</ul>
		</div>
	</div>
</nav>