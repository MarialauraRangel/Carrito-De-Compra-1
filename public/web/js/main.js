 (function($) {

 	"use strict";

 	$('[data-toggle="tooltip"]').tooltip();

 	var isMobile = {
 		Android: function() {
 			return navigator.userAgent.match(/Android/i);
 		},
 		BlackBerry: function() {
 			return navigator.userAgent.match(/BlackBerry/i);
 		},
 		iOS: function() {
 			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
 		},
 		Opera: function() {
 			return navigator.userAgent.match(/Opera Mini/i);
 		},
 		Windows: function() {
 			return navigator.userAgent.match(/IEMobile/i);
 		},
 		any: function() {
 			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
 		}
 	};

	// loader
	var loader = function() {
		setTimeout(function() { 
			if($('#ftco-loader').length > 0) {
				$('#ftco-loader').removeClass('show');
			}
		}, 1);
	};
	loader();

	$('nav .dropdown').hover(function(){
		var $this = $(this);
		// 	 timer;
		// clearTimeout(timer);
		$this.addClass('show');
		$this.find('> a').attr('aria-expanded', true);
		// $this.find('.dropdown-menu').addClass('animated-fast fadeInUp show');
		$this.find('.dropdown-menu').addClass('show');
	}, function(){
		var $this = $(this);
			// timer;
		// timer = setTimeout(function(){
			$this.removeClass('show');
			$this.find('> a').attr('aria-expanded', false);
			// $this.find('.dropdown-menu').removeClass('animated-fast fadeInUp show');
			$this.find('.dropdown-menu').removeClass('show');
		// }, 100);
	});


	$('#dropdown04').on('show.bs.dropdown', function () {
		console.log('show');
	});

	// scroll
	var scrollWindow = function() {
		$(window).scroll(function(){
			var $w = $(this),
			st = $w.scrollTop(),
			navbar = $('.ftco_navbar'),
			sd = $('.js-scroll-wrap');

			if (st > 150) {
				if ( !navbar.hasClass('scrolled') ) {
					navbar.addClass('scrolled');	
				}
			} 
			if (st < 150) {
				if ( navbar.hasClass('scrolled') ) {
					navbar.removeClass('scrolled sleep');
				}
			} 
			if ( st > 350 ) {
				if ( !navbar.hasClass('awake') ) {
					navbar.addClass('awake');	
				}
				
				if(sd.length > 0) {
					sd.addClass('sleep');
				}
			}
			if ( st < 350 ) {
				if ( navbar.hasClass('awake') ) {
					navbar.removeClass('awake');
					navbar.addClass('sleep');
				}
				if(sd.length > 0) {
					sd.removeClass('sleep');
				}
			}
		});
	};
	scrollWindow();

	
	var counter = function() {
		
		$('#section-counter').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('ftco-animated') ) {

				var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',')
				$('.number').each(function(){
					var $this = $(this),
					num = $this.data('number');
					console.log(num);
					$this.animateNumber(
					{
						number: num,
						numberStep: comma_separator_number_step
					}, 7000
					);
				});
				
			}

		} , { offset: '95%' } );

	}
	counter();

	var contentWayPoint = function() {
		var i = 0;
		$('.ftco-animate').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('ftco-animated') ) {
				
				i++;

				$(this.element).addClass('item-animate');
				setTimeout(function(){

					$('body .ftco-animate.item-animate').each(function(k){
						var el = $(this);
						setTimeout( function () {
							var effect = el.data('animate-effect');
							if ( effect === 'fadeIn') {
								el.addClass('fadeIn ftco-animated');
							} else if ( effect === 'fadeInLeft') {
								el.addClass('fadeInLeft ftco-animated');
							} else if ( effect === 'fadeInRight') {
								el.addClass('fadeInRight ftco-animated');
							} else {
								el.addClass('fadeInUp ftco-animated');
							}
							el.removeClass('item-animate');
						},  k * 50, 'easeInOutExpo' );
					});
					
				}, 100);
				
			}

		} , { offset: '95%' } );
	};
	contentWayPoint();


	// navigation
	var OnePageNav = function() {
		$(".smoothscroll[href^='#'], #ftco-nav ul li a[href^='#']").on('click', function(e) {
			e.preventDefault();

			var hash = this.hash,
			navToggler = $('.navbar-toggler');
			$('html, body').animate({
				scrollTop: $(hash).offset().top
			}, 700, 'easeInOutExpo', function(){
				window.location.hash = hash;
			});


			if ( navToggler.is(':visible') ) {
				navToggler.click();
			}
		});
		$('body').on('activate.bs.scrollspy', function () {
			console.log('nice');
		})
	};
	OnePageNav();

	var goHere = function() {

		$('.mouse-icon').on('click', function(event){
			
			event.preventDefault();

			$('html,body').animate({
				scrollTop: $('.goto-here').offset().top
			}, 500, 'easeInOutExpo');
			
			return false;
		});
	};
	goHere();

})(jQuery);

$(document).ready(function() {
	//API de Javascript para obtener geolocalización del usuario
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showLocation, errorLocation, { timeout: 0 });
	} else {
		//Aqui no
	}
	function showLocation (location) {
		var userLng=location.coords.longitude;
		var userLat=location.coords.latitude;

		$.ajax({
			url: '/agregar/ubicacion',
			type: 'POST',
			dataType: 'html',
			data: {lat: userLat, lng: userLng},
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		if (typeof(userLat)!="undefined" && typeof(userLng)!="undefined") {
			showDistance(userLat, userLng);
		}
	}
	function  errorLocation (error) {
		if (error.code==1 || error.code==2 || error.code==3) {
			navigator.geolocation.getCurrentPosition(showLocation, errorLocation, { timeout: 0 });
		}
	}

	//Validación para introducir solo números
	$('.number, .phone, #dni').keypress(function() {
		return event.charCode >= 48 && event.charCode <= 57;
	});
    //Validación para introducir solo letras y espacios
    $('#name, #lastname').keypress(function() {
    	return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32;
    });
    //Validación para solo presionar enter y borrar
    $('.date').keypress(function() {
    	return event.charCode == 32 || event.charCode == 127;
    });

	//multiselect
	if ($('.multiselect').length) {
		$('.multiselect').select2({
			theme: "bootstrap",
			language: "es"
		});
	}

	//Variables con fecha actual
	var mayor=new Date();
	//Restandole 18 años a la fecha actual
	mayor.setMonth(mayor.getMonth() - 216);

	//datepicker material
	if ($('.date').length) {
		$('.date').bootstrapMaterialDatePicker({
			time: false,
			cancelText: 'Cancelar',
			clearText: 'Limpiar',
			format: 'DD-MM-YYYY',
			maxDate : mayor
		});
	}

	//datatable español
	var español = {
		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún resultado disponible en esta tabla",
		"sInfo":           "Resultados del _START_ al _END_ de un total de _TOTAL_ registros",
		"sInfoEmpty":      "No hay resultados",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar :",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}
	}

	//datatable normal
	if ($('#tabla').length) {
		$('#tabla').DataTable({
			"language": español
		});
	}

	if ($('.lazy').length) {
		$('.lazy').loadScroll();
	}

	//Llamado para agregar touchspin a campos de cantidad
	if ($('.qty').length) {
		qtyProduct();
	}

	//Funcion para mostrar la distancia entre el producto o tienda y el usuario
	function showDistance(userLat, userLng) {
		$(".distance").each(function(){
			var lat=$(this).attr('lat'), lng=$(this).attr('lng');
			var km=getDistance(lat, lng, userLat, userLng);
			$(this).append($('<p>', {
				'class': 'text-muted my-0',
				'text': km+' Km'
			}));
		});
	}

	//Galeria de imagenes en la vista del producto
	if ($('#imagesProduct').length) {
		$('#imagesProduct').lightGallery();
		$('#imagesProduct').lightSlider();
	}

	//Plugin para la calidad (estrellas) de las marcas
	if ($('.ratings').length) {
		$(".ratings").rate();
	}

	//Plugin para formulario step en checkout
	if ($('#checkout').length) {
		$("#checkout").steps({
			headerTag: "h3",
			bodyTag: "section",
			transitionEffect: "slideLeft",
			autoFocus: true,
			onStepChanging: function (event, currentIndex, newIndex)
			{
				//Cambiar opciones de pago entre tarjeta y transferencia
				$('#selectPay').change(function() {
					if ($(this).val()=="1") {
						$('#transferFields').addClass('d-none');
						$('#transferFields input, #transferFields select').attr('disabled', true);
						$('#cardFields').removeClass('d-none');
						$('#cardFields input').attr('disabled', false);
					} else {
						$('#cardFields').addClass('d-none');
						$('#cardFields input').attr('disabled', true);
						$('#transferFields').removeClass('d-none');
						$('#transferFields input, #transferFields select').attr('disabled', false);
					}
				});

				//Cambiar valor de un input fuera del checkout al cambiar el selct del envio
				// $('select[name="delivery"]').change(function() {
					// if ($(this).val()=='no') {
					// 	$('#deliveryInputs').addClass('d-none');
					// 	$('#deliveryInputs input').attr('disabled', true);
					// } else {
					// 	$('#deliveryInputs').removeClass('d-none');
					// 	$('#deliveryInputs input').attr('disabled', false);
					// }
					// $('#checkoutDelivery').val($(this).val());
					// var slug=$('.qty').attr('slug'), qty=$('.qty').val(), delivery=$('#checkoutDelivery').val(), lat=$('#lat').val(), lng=$('#lng').val();
					// calculatorTotal(slug, qty, delivery, lat, lng);
				// });

				$(".billing-form").validate().settings.ignore = ":disabled,:hidden";
				return $(".billing-form").valid();
			},
			onFinishing: function (event, currentIndex)
			{
				$(".billing-form").validate().settings.ignore = ":disabled";
				return $(".billing-form").valid();
			},
			onFinished: function (event, currentIndex)
			{
				// Crea el objeto Token con Culqi JS
				if ($('select[name="pay"] option:selected').val()==1) {
					Culqi.createToken();
					e.preventDefault();
				} else {
					$(".billing-form").submit();
				}
			}
		}).validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				email: {
					required: true,
					email: true,
					minlength: 8,
					maxlength: 191
				},

				phone: {
					required: true,
					minlength: 5,
					maxlength: 15
				},

				// address: {
				// 	required: true,
				// 	minlength: 2,
				// 	maxlength: 191
				// },

				pay: {
					required: true
				},

				card: {
					required: true,
					minlength: 16,
					maxlength: 16
				},

				code: {
					required: true,
					minlength: 3,
					maxlength: 3
				},

				month: {
					required: true,
					minlength: 2,
					maxlength: 2
				},

				year: {
					required: true,
					minlength: 4,
					maxlength: 4
				},

				reference: {
					required: true,
					minlength: 5,
					maxlength: 25
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				lastname: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				phone: {
					minlength: 'Escribe mínimo {0} números.',
					maxlength: 'Escribe máximo {0} números.'
				},

				// address: {
				// 	minlength: 'Escribe mínimo {0} caracteres.',
				// 	maxlength: 'Escribe máximo {0} caracteres.'
				// },

				card: {
					minlength: 'Escribe mínimo {0} números.',
					maxlength: 'Escribe máximo {0} números.'
				},

				code: {
					minlength: 'Escribe mínimo {0} números.',
					maxlength: 'Escribe máximo {0} números.'
				},

				month: {
					minlength: 'Escribe mínimo {0} números.',
					maxlength: 'Escribe máximo {0} números.'
				},

				year: {
					minlength: 'Escribe mínimo {0} números.',
					maxlength: 'Escribe máximo {0} números.'
				},

				reference: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			}
		});

		//Llave para conectarse a culqi e inicializador
		//llave mia
		// Culqi.publicKey='pk_test_u3aBMzCGCvPM3vfc';

		//llave eduardo
		Culqi.publicKey='pk_live_f3c652ac24a45c92';
		Culqi.init();
	}

	//Mapa de leaflet
	if ($('#lat').length && $('#lng').length && $('#map').length) {
		if ($('#lat').val()=="" || $('#lng').val()=="") {
			var map = L.map('map', {
				center: [-12.05, -77.04],
				zoom: 12
			});

			marker = L.marker([-12.05, -77.04]).addTo(map);
		} else {
			var mapLat=$('#lat').val();
			var mapLng=$('#lng').val();
			var map = L.map('map', {
				center: [mapLat, mapLng],
				zoom: 12
			});

			marker = L.marker([mapLat, mapLng]).addTo(map);
		}

		var geocoder = L.Control.Geocoder.nominatim();

		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);

		map.on('click', function(e) {
			if (marker) {
				map.removeLayer(marker);
			}

			geocoder.reverse(e.latlng, map.options.crs.scale(map.getZoom()), function(results) {
				var r = results[0];
				$('#addressDelivery').val(r.name);
			});

			marker=L.marker(e.latlng).addTo(map);
			$('#lat').val(e.latlng.lat);
			$('#lng').val(e.latlng.lng);

			var slug=$('.qty').attr('slug'), 
			qty=$('.qty').val(), 
			delivery=$('#checkoutDelivery').val(), 
			lat=$('#lat').val(), 
			lng=$('#lng').val();

			calculatorTotal(slug, qty, delivery, lat, lng);
		});
	}

	if ($('#latStore').length && $('#lngStore').length && $('#map').length) {
		var latStore=$('#latStore').val();
		var lngStore=$('#lngStore').val();
		var latUser=$('#latUser').val();
		var lngUser=$('#lngUser').val();

		var map = L.map('map', {
			center: [latStore, lngStore],
			zoom: 13
		});

		if (latUser!="" && lngUser!="") {
			L.Routing.control({
				waypoints: [
				L.latLng(latStore, lngStore),
				L.latLng(latUser, lngUser)
				]
			}).addTo(map);
		} else {
			marker = L.marker([latStore, lngStore]).addTo(map);
		}

		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);
	}

	//dropify para input file más personalizado
	if ($('.dropify').length) {
		$('.dropify').dropify({
			messages: {
				default: 'Arrastre y suelte una imagen o da click para seleccionarla',
				replace: 'Arrastre y suelte una imagen o haga click para reemplazar',
				remove: 'Remover',
				error: 'Lo sentimos, el archivo es demasiado grande'
			},
			error: {
				'fileSize': 'El tamaño del archivo es demasiado grande ({{ value }} máximo).',
				'minWidth': 'El ancho de la imagen es demasiado pequeño ({{ value }}}px mínimo).',
				'maxWidth': 'El ancho de la imagen es demasiado grande ({{ value }}}px máximo).',
				'minHeight': 'La altura de la imagen es demasiado pequeña ({{ value }}}px mínimo).',
				'maxHeight': 'La altura de la imagen es demasiado grande ({{ value }}px máximo).',
				'imageFormat': 'El formato de imagen no está permitido (Debe ser {{ value }}).'
			}
		});
	}
});

// Funciones para agregar datos a select
$('#multiselectDepartments').change(function() {
	var id=$(this).val();
	if (id!="") {
		$.ajax({
			url: '/misterfix/provincias/agregar',
			type: 'POST',
			dataType: 'html',
			data: {id: id},
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		})
		.done(function(resultado) {
			$("#multiselectProvinces option, #multiselectDistricts option").remove();
			$("#multiselectProvinces, #multiselectDistricts").attr('disabled', true);
			var obj=JSON.parse(resultado);

			$('#multiselectProvinces, #multiselectDistricts').append($('<option>', {
				value: '',
				text: 'Seleccione'
			}));
			for (var i=obj.length-1; i>=0; i--) {
				$('#multiselectProvinces').append($('<option>', {
					value: obj[i].id,
					text: obj[i].name
				}));
			}
			$("#multiselectProvinces").attr('disabled', false);
		});
	} else {
		$("#multiselectProvinces option, #multiselectDistricts option").remove();
		$('#multiselectProvinces, #multiselectDistricts').append($('<option>', {
			value: '',
			text: 'Seleccione'
		}));
		$("#multiselectProvinces, #multiselectDistricts").attr('disabled', true);
	}
});

$('#multiselectProvinces').change(function() {
	var id=$(this).val();
	if (id!="") {
		$.ajax({
			url: '/misterfix/distritos/agregar',
			type: 'POST',
			dataType: 'html',
			data: {id: id},
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		})
		.done(function(resultado) {
			$("#multiselectDistricts option").remove();
			$("#multiselectDistricts").attr('disabled', true);
			var obj=JSON.parse(resultado);

			$('#multiselectDistricts').append($('<option>', {
				value: '',
				text: 'Seleccione'
			}));
			for (var i=obj.length-1; i>=0; i--) {
				$('#multiselectDistricts').append($('<option>', {
					value: obj[i].id,
					text: obj[i].name
				}));
			}
			$("#multiselectDistricts").attr('disabled', false);
		});
	} else {
		$("#multiselectDistricts option").remove();
		$('#multiselectDistricts').append($('<option>', {
			value: '',
			text: 'Seleccione'
		}));
		$("#multiselectDistricts").attr('disabled', true);
	}
});

//Redireccionar en el filtro de la tienda con los datos del buscador del inicio
$('#sendFilter').click(function() {
	if ($('select[name="search"] option:selected').val()!="" && $('select[name="brand"] option:selected').val()!="") {
		var searchValue=$('select[name="search"] option:selected').val();
		var brandValue=$('select[name="brand"] option:selected').val();
		location.href="/tienda/buscar_"+searchValue+"_marca_"+brandValue+"_";
	} else if ($('select[name="search"] option:selected').val()!="" || $('select[name="brand"] option:selected').val()!="") {
		if ($('select[name="search"] option:selected').val()!="") {
			var searchValue=$('select[name="search"] option:selected').val();
			location.href="/tienda/buscar_"+searchValue+"_";
		}

		if ($('select[name="brand"] option:selected').val()!="") {
			var brandValue=$('select[name="brand"] option:selected').val();
			location.href="/tienda/marca_"+brandValue+"_";
		}
	} else {
		location.href="/tienda/";
	}
});

//Redireccionar en el filtro de la tienda con la opcion buscar
$('#searchField').change(function() {
	if ($(this).val()!="") {
		var url=$('#searchField option:selected').attr('url');
		location.href=url;
	}
});

//Redireccionar en el filtro de la tienda con la opcion precio
$('#filterPrice').change(function() {
	if ($(this).val()!="") {
		var url=$('#filterPrice option:selected').attr('url');
		location.href=url;
	}
});

//Redireccionar en el filtro de la tienda con la opcion marca
$('#filterBrand').change(function() {
	if ($(this).val()!="") {
		var url=$('#filterBrand option:selected').attr('url');
		location.href=url;
	}
});

//Redireccionar en el filtro de la tienda con la opcion categoria
$('#filterCategory').change(function() {
	if ($(this).val()!="") {
		var url=$('#filterCategory option:selected').attr('url');
		location.href=url;
	}
});

//Redireccionar en el filtro de la tienda con la opcion distrito
$('#filterDistrict').change(function() {
	if ($(this).val()!="") {
		var url=$('#filterDistrict option:selected').attr('url');
		location.href=url;
	}
});

//Al cambiar la cantidad de un producto cambia el total
$('.qty').change(function() {
	var slug=$(this).attr('slug'), qty=$(this).val(), delivery=$('#checkoutDelivery').val(), lat=$('#lat').val(), lng=$('#lng').val();
	calculatorTotal(slug, qty, delivery, lat, lng);
});

//Función para calcular total de la compra
function calculatorTotal(slug, qty, delivery, lat, lng) {
	$("#qtySale").val(qty);
	$.ajax({
		url: '/calcular/precio',
		type: 'POST',
		dataType: 'html',
		data: {qty: qty, delivery: delivery, slug: slug, lat: lat, lng: lng},
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	}).done(function(resultado) {

		var obj=JSON.parse(resultado);

		// if (obj.error=='') {
			$('.subtotal').text("S/. "+obj.price);
			// $('.delivery').text("S/. "+obj.delivery);
			if ($(".ofert").length) {
				$('.ofert').text("S/. "+obj.ofert);
			}
			$('.total').text("S/. "+obj.total);
			// $('a[delivery="no"]').attr('delivery', 'si');
			// $('a[delivery="si"]').attr('href', '#next');
		// }else{
			/*$('#error_mensaje').before(`
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Lo sentimos!</strong> No realizamos envíos a esta dirección. Por favor, seleccione otra ubicación 
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>`);*/
		// 	$('a[href="#next"]').attr('delivery', 'no');
		// 	$('a[delivery="no"]').attr('href', '');
		// }

		//console.log(resultado);
		//console.log(obj);

		
	});
}

//Función para calcular las distancia entre 2 puntos en km
function getDistance(lat1, lon1, lat2, lon2){
	rad = function(x) {return x*Math.PI/180;}
	var R = 6378.137; //Radio de la tierra en km
	var dLat = rad( lat2 - lat1 );
	var dLong = rad( lon2 - lon1 );
	var a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.cos(rad(lat1)) * Math.cos(rad(lat2)) * Math.sin(dLong/2) * Math.sin(dLong/2);
	var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
	var d = R * c;
	return d.toFixed(0); //Retorna cero decimales
}

//Funcion para colocar plugin de touchspin en todos los campos de cantidad validados
function qtyProduct() {
	$(".qty").each(function(){
		var qtyMax=$(this).attr('max');
		$(this).TouchSpin({
			min: 1,
			max: qtyMax,
			buttondown_class: 'btn btn-primary px-2 py-1 rounded',
			buttonup_class: 'btn btn-primary px-2 py-1 rounded'
		});
	});
}

//Función para crear token de culqi y enviar formulario de pago
function culqi() {
	if (Culqi.token) {
		var token = Culqi.token.id;
		console.log('Se ha creado un token:' + token);
		$('#culqi').val(token);
		$(".billing-form").submit();
	} else {
    	// Mostramos JSON de objeto error en consola
    	console.log(Culqi.error);
    	alert(Culqi.error.user_message);
    }
};