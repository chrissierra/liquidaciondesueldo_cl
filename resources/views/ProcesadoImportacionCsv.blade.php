<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Mono|Roboto:400,700,900&display=swap" rel="stylesheet">
        <title>Procesado de importación</title>
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


    </head>
    <body>
        @component('componentes.navbar')              
        @endcomponent
        <div id="app">
           <procesado-importable datos="{{ $datos }}"  parametros="{{ $parametros_desde_bbdd }}"></procesado-importable>  
        </div>


    </body>
    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
</html>
