<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Mono|Roboto:400,700,900&display=swap" rel="stylesheet">
        <title>Liquidacion de sueldo</title>
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
         {!! SEO::generate() !!}
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    </head>
    <body>

        @component('componentes.navbar')              
        @endcomponent
        <div class="container">
            <div class="card">
                <div class="card-body">

    <form  action="{{ route('importacion.csv') }}" method="post" enctype="multipart/form-data" >
        
    @csrf
    <input type="file" name="csv">

    <button>Importar</button>

    </form>
                </div>
            </div>
        </div>
    </body>
</html>
