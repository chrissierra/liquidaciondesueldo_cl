<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-154973674-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-154973674-2');
    </script>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Lato|Roboto+Mono:100,100i,300,300i,400,400i,500|Roboto:400,700,900&display=swap" rel="stylesheet">
        <title>Liquidacion de sueldo</title>
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
        {!! SEO::generate() !!}
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
	<style type="text/css">
.banner1::after{
					content: "";
					display: block;
					background-image: url( {{ URL::asset('images/banner1.jpg') }} );
					height: 70vh;
					width: 100%;
					background-repeat: no-repeat;
					background-size:cover;
					background-position: center;
					margin-top:-3rem;
				}

				.banner1{
					position: relative;
				}

				.banner1::before{
					height: 70vh;
					width: 100%;
					content:'';
					display: block;
					background-color: hsla(180, 50%, 10%, .9);
					position:absolute;
					
				}


				.titulo-banner1{
					
					font-size: 2em;
					font-family: 'Roboto Mono', sans-serif;
				}
				.subtitulo-banner1{
					font-size:.8em;
					font-family: 'Roboto Mono', monospace;
					
				}



				p.titulo-principal {
					font-size: 2.3em;
					font-family: 'Roboto Mono', monospace;
					font-weight: 500;
				}

				p.titulo {
					font-size: 1.5em;
					font-family: 'Roboto Mono', monospace;
					font-weight: 400;

				}		

				p.subtitulo-contenedor-card{
					font-size:1.1em;
					font-family: 'Lato', sans-serif;
					color: #656979;
					width: 25em;
					line-height: 2;
				}
				.texto-superior-titulo{
					color:blue;
				}



		@media (max-width: 800px) {
		  .banner2 {
		    display: grid;
			grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
			padding:2em;

		  }

		  		.texto-banner1{
					position:absolute;
					top:0;
					width: 100%;
					height: 100%;
					color: white;
					display: flex;
					flex-direction: column;
					justify-content: flex-end;
					align-items: flex-start;
					padding-bottom:15em;
					padding-left: 2em;

				}
		}

		@media only screen and (min-width: 992px) {

				
				.texto-banner1{
					position:absolute;
					top:0;
					width: 100%;
					height: 100%;
					color: white;
					display: flex;
					flex-direction: column;
					justify-content: flex-end;
					align-items: flex-start;
					padding-bottom:15em;
					padding-left: 10em;

				}
				

				.banner2{

					height: 100vh;
					display: grid;
					grid-template-columns: 2fr 1fr 1fr;
					grid-template-rows: 1fr 1fr 1fr;
					padding:2em;
				}

				.contenedor-card1{
					grid-column-start:1;
					grid-column-end: 2;
					grid-row-start: 1;
					grid-row-end:2;
					align-self: end;
					justify-self: center;
				}

				.contenedor-card2{
					grid-column-start:2;
					grid-column-end: 3;
					grid-row-start: 1;
					grid-row-end:2;
				}

				.contenedor-card3{
					grid-column-start:3;
					grid-column-end: 4;
					grid-row-start: 1;
					grid-row-end:2;
				}

				.contenedor-card4{
					grid-column-start:2;
					grid-column-end: 3;
					grid-row-start: 2;
					grid-row-end:3;
				}

				.contenedor-card5{
					grid-column-start:3;
					grid-column-end: 4;
					grid-row-start: 2;
					grid-row-end:3;
				}


				.contenedor-card6{
					grid-column-start:2;
					grid-column-end: 3;
					grid-row-start: 3;
					grid-row-end:4;
				}

				[class*='contenedor-card']{
					padding:1em;
				}

		}
	</style>

    </head>
    <body>
        
        @component('componentes.navbar')              
        @endcomponent

	
        <div class="banner1">
				<div class="texto-banner1">
					<p class="titulo-banner1">
						Realiza tus liquidaciones de sueldo de la forma más rápida
					</p>
					<p class="subtitulo-banner1">
						Podrás generar la liquidación en PDF en tan sólo segundos. Tratar de forma masiva a tus trabajadores. 
					</p>
				</div>

        </div><!-- Fin banner 1 -->



		<div class="banner2">
			
			<div class="contenedor-card1">
				<span class="texto-superior-titulo">Remuneraciones</span>
				<p class="titulo-principal">
					Máxima eficiencia
				</p>

				<p class="subtitulo-contenedor-card">
					Podrás generar la liquidación con la máxima velocidad y seguridad. Los parámetros están siempre dispuestos 
					para que no tengas que buscarlos. 
				</p>

			</div>




			<div class="contenedor-card2">
				<p  class="texto-superior-titulo" style="float:left;margin-right: 1em; font-size: 1.3em;font-weight: 300">01</p><p class="titulo">
					Generación PDF
				</p>

				<p class="subtitulo-contenedor-card">
					Al aplicar los parámetros necesarios, tales como sueldo base y bonos como también asignaciones no imponibles; podrás
					generar con tan sólo un click la liquidación de sueldo en PDF.
				</p>

			</div>

			<div class="contenedor-card3">
				<p  class="texto-superior-titulo" style="float:left;margin-right: 1em; font-size: 1.3em;font-weight: 300">02</p><p class="titulo">
					Conocer el Sueldo Base
				</p>

				<p class="subtitulo-contenedor-card">
					Muchas veces necesitamos conocer el sueldo base desde un sueldo líquido. Si trabajas en RRHH lo sabrás. 
					Pactamos un líquido y fijando una colación y movilización necesitamos llegar al sueldo base 
					considerando desde los descuentos legales como también los impuestos.
				</p>

			</div>	

			<div class="contenedor-card4">
				<p  class="texto-superior-titulo" style="float:left;margin-right: 1em; font-size: 1.3em;font-weight: 300">03</p><p class="titulo">
					Pricing
				</p>

				<p class="subtitulo-contenedor-card">
					Contamos con planes desde costo 0. Si realizas menos de 5 liquidaciones al mes, podrás hacerlas totalmente gratis. 
					Sin embargo si necesitas el plan premium con tan sólo 10USD al mes podrás generar todas las liquidaciones que desees.
				</p>

			</div>	



			<div class="contenedor-card5">
				<p  class="texto-superior-titulo" style="float:left;margin-right: 1em; font-size: 1.3em;font-weight: 300">04</p><p class="titulo">
					Premium
				</p>

				<p class="subtitulo-contenedor-card">
					El plan premium cuenta con distintas posiblidades. Las mejor por lejos es la generación de liquidación de forma masiva.
					Con tan sólo ingresar los valores conocidos, tales como sueldo base y bonos; asignaciones no imponibles. Teniendo
					éstos valores luego podrás obtener un libro de remuneración para tu contabilidad y las liquidaciones de sueldos en PDF listas.
				</p>

			</div>

			<div class="contenedor-card6">
				<p  class="texto-superior-titulo" style="float:left;margin-right: 1em; font-size: 1.3em;font-weight: 300">05</p><p class="titulo">
					Gestionar Personal
				</p>

				<p class="subtitulo-contenedor-card">
					Podrás tener una base accesible de todos los dispositivos de tus sueldos pagados. Podrás visualizar los haberes
					totales, el pago total en impuestos, aportes patronales, entre otros.
				</p>

			</div>													

		</div><!-- Fin banner 2-->





    </body>
    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
</html>
