$(document).ready(function(){
	//Usuarios register
	$("button[action='login']").on("click",function(){
		$("#formLogin").validate({
			rules:
			{
				email: {
					required: true,
					email: true,
					minlength: 8,
					maxlength: 191
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			}
		});
	});

	//Usuarios register
	$("button[action='register']").on("click",function(){
		$("#formRegister").validate({
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
					maxlength: 191,
					remote: {
						url: "/registro/email",
						type: "get"
					}
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
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
					maxlength: 'Escribe máximo {0} caracteres.',
					remote: "Usted ya esta usando este correo."
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password_confirmation: { 
					equalTo: 'Los datos ingresados no coinciden.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			}
		});
	});

	//Usuarios
	$("button[action='user']").on("click",function(){
		$("#formUser").validate({
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

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
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
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password_confirmation: { 
					equalTo: 'Los datos ingresados no coinciden.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			}
		});
	});

	//Blog
	$("button[action='blog']").on("click",function(){
		$("#formBlog").validate({
			rules:
			{
				title: {
					required: true,
					minlength: 2,
					maxlength: 191
				}
			},
			messages:
			{
				title: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			}
		});
	});

	//Marcas
	$("button[action='brand']").on("click",function(){
		$("#formBrand").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				quality: {
					required: true,
					min: 1,
					max: 5
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				quality: {
					min: 'Escribe un valor mayor o igual a {0}.',
					max: 'Escribe un valor menor o igual a {0}.'
				}
			}
		});
	});


	//Categorias
	$("button[action='category']").on("click",function(){
		$("#formCategory").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			}
		});
	});

	//Productos
	$("button[action='store']").on("click",function(){
		$("#formStore").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				district_id: {
					required: true
				},

				address: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				phone: {
					required: true,
					minlength: 2,
					maxlength: 15
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				district_id: {
					required: 'Seleccione una opción.'
				},

				address: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				phone: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			}
		});
	});

	//Tienda
	$("button[action='product']").on("click",function(){
		$("#formProduct").validate({
			rules:
			{
				store_id: {
					required: true
				},

				brand_id: {
					required: true
				},

				subcategory_id: {
					required: true
				},

				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				qty: {
					required: true,
					min: 0,
					max: 10000
				},

				price: { 
					required: true,
					min: 0,
					max: 10000000
				},

				ofert: { 
					required: true,
					min: 0,
					max: 100
				},

				description: { 
					required: true,
					minlength: 10,
					maxlength: 64000
				}
			},
			messages:
			{
				store_id: {
					required: 'Seleccione una opción.'
				},

				brand_id: {
					required: 'Seleccione una opción.'
				},

				subcategory_id: {
					required: 'Seleccione una opción.'
				},

				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				qty: { 
					min: 'Escribe un valor mayor o igual a {0}.',
					max: 'Escribe un valor menor o igual a {0}.'
				},

				price: {
					min: 'Escribe un valor mayor o igual a {0}.',
					max: 'Escribe un valor menor o igual a {0}.'
				},

				ofert: {
					min: 'Escribe un valor mayor o igual a {0}.',
					max: 'Escribe un valor menor o igual a {0}.'
				},

				description: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			}
		});
	});

	//SubCategorias
	$("button[action='subcategory']").on("click",function(){
		$("#formSubCategory").validate({
			rules:
			{
				category: { 
					required: true
				},

				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				}
			},
			messages:
			{
				category: {
					required: 'Seleccione una opción.'
				},

				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			}
		});
	});
});