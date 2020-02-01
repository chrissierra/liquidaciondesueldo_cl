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
        <link href="https://fonts.googleapis.com/css?family=Roboto+Mono|Roboto:400,700,900&display=swap" rel="stylesheet">
        <title>Liquidacion de sueldo</title>
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
        {!! SEO::generate() !!}
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<style type="text/css">
	label{
		display:block;
	}

	.contenedor{
		 display: flex;
		 justify-content: center;
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
	    @component('componentes.navbar')              
        @endcomponent

	<div id="app" class="contenedor">
			<form  method="post" action="{{ route('IngresandoParametros') }}" >
				@csrf

				<div class="form-group">
					<label for="Habitat">Modelo</label>
					<input type="text" class="form-control" name="Modelo"> 
				</div> 

				<div class="form-group">
					<label for="Habitat">Habitat</label>
					<input type="text" class="form-control" name="Habitat"> 
				</div> 

				<div class="form-group">
					<label for="Provida">Provida</label>
					<input type="text" class="form-control" name="Provida"> 
				</div> 

				<div class="form-group">
					<label for="Cuprum">Cuprum</label>
					<input type="text" class="form-control" name="Cuprum"> 
				</div> 

				<div class="form-group">
					<label for="PlanVital">PlanVital</label>
					<input type="text" class="form-control" name="PlanVital"> 
				</div> 

				<div class="form-group">
					<label for="Uno">Uno</label>
					<input type="text" class="form-control" name="Uno"> 
				</div> 

				<div class="form-group">
					<label for="UF">UF</label>
					<input type="text" class="form-control" name="UF"> 
				</div> 

				<div class="form-group">
					<label for="Cesantia">Cesantia</label>
					<input type="text" class="form-control" name="Cesantia"> 
				</div> 

				<div class="form-group">
					<label for="AsigFamA">AsigFamA</label>
					<input type="text" class="form-control" name="AsigFamA"> 
				</div> 

				<div class="form-group">
					<label for="AsigFamB">AsigFamB</label>
					<input type="text" class="form-control" name="AsigFamB"> 
				</div> 

				<div class="form-group">
					<label for="AsigFamC">AsigFamC</label>
					<input type="text" class="form-control" name="AsigFamC"> 
				</div> 

				<div class="form-group">
					<label for="TopeImpAFP">TopeImpAFP</label>
					<input type="text" class="form-control" name="TopeImpAFP"> 
				</div> 

				<div class="form-group">
					<label for="TopeImpIPS">TopeImpIPS</label>
					<input type="text" class="form-control" name="TopeImpIPS"> 
				</div> 

				<div class="form-group">
					<label for="TopeImpSegCesantia">TopeImpSegCesantia</label>
					<input type="text" class="form-control" name="TopeImpSegCesantia"> 
				</div> 

				<div class="form-group">
					<label for="mes">mes</label>
					<input type="text" class="form-control" name="mes"> 
				</div> 

				<div class="form-group">
					<label for="anio">anio</label>
					<input type="text" class="form-control" name="anio"> 
				</div> 


			

				<input type="submit" value="Enviar" name="" class="btn btn-outline-success">


			</form>

				<get-parametros></get-parametros>
	</div>
	

</body>
    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
</html>