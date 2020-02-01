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
			<form  method="post" action="{{ route('IngresandoAfp') }}" >
				@csrf

				<div class="form-group">
				   <label>
				   Provida	
				   </label>	
				   <input type="text" name="Provida"> 
				</div> 
				<div class="form-group">
				   <label>
				   Modelo	
				   </label>	
				   <input type="text" name="Modelo"> 
				</div> 
				<div class="form-group">
				   <label>
				   Capital	
				   </label>	
				   <input type="text" name="Capital"> 
				</div> 
				<div class="form-group">
				   <label>
				   Cuprum	
				   </label>	
				   <input type="text" name="Cuprum"> 
				</div> 
				<div class="form-group">
				   <label>
				   Habitat	
				   </label>	
				   <input type="text" name="Habitat"> 
				</div> 
				<div class="form-group">
				   <label>
				   Uno	
				   </label>	
				   <input type="text" name="Uno"> 
				</div> 
				<div class="form-group">
				   <label>
				   PlanVital	
				   </label>	
				   <input type="text" name="PlanVital"> 
				</div> 
				<div class="form-group">
				   <label>
				   IPS	
				   </label>	
				   <input type="text" name="IPS"> 
				</div> 
				<div class="form-group">
				   <label>
				   mes	
				   </label>	
				   <input type="text" name="mes"> 
				</div> 
				<div class="form-group">
				   <label>
				   anio	
				   </label>	
				   <input type="text" name="anio"> 
				</div> 
				<div class="form-group">
				   <label>
				   Pensionado	
				   </label>	
				   <input type="text" name="Pensionado"> 
				</div> 



				<input type="submit" value="Enviar" name="" class="btn btn-outline-success">


			</form>

				<get-afp></get-afp>
	</div>
	

</body>
    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
</html>