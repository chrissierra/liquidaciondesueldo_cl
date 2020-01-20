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

	<meta charset="UTF-8">
	<title>Ingresa Impuestos</title>
</head>
<style type="text/css">
	label{
		display:block;
	}

	.contenedor{
		 max-width: 15em;
		 padding:1em;
		 margin: 0 auto; 
	}

	input{
		width: 15em;
		margin-bottom:1em;
		border-radius: .3em;
	}
</style>
<body>
	

	<div class="contenedor">
			<form  method="post" action="{{ route('IngresandoImpuestos') }}" >
				@csrf

			<div>
				<label>Desde</label>
				<input type="text" name="desde">	
			</div>


			<div>
				<label>Hasta</label>
				<input type="text" name="hasta">
			</div>

			<div>

				<label>Mes</label>
				<input type="text" name="mes">
			</div>
			
			<div>

				<label>Año</label>
				<input type="text" name="anio">
			</div>
			
			<div>

				<label>Factor</label>
				<input type="text" name="factor">
			</div>
			
			<div>

				<label>Cantidad a rebajar</label>
				<input type="text" name="cantidadRebajar">
			</div>

				<input type="submit" value="enviar" name="">


			</form>
	</div>

</body>
</html>