<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-154973674-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-154973674-2');
    </script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Mono|Roboto:400,700,900&display=swap" rel="stylesheet">
        <title>Liquidacion de sueldo</title>
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
   
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
               @component('componentes.navbar')              
        @endcomponent

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
        <style type="text/css">
          nav.barra-superior{
            background-color: #1c4b82;
            color: #dae1e7;
            font-family: 'Roboto', sans-serif;
          }

          .fas{
            color:white;
          }

          nav.barra-superior > a.navbar-brand{
            color: #dd6b4d;
            font-weight: 900;
            font-family: 'Roboto Mono', sans-serif;
          }       

          nav.barra-superior > div.collapse > ul > li > a{
            color: #dae1e7;
            font-weight: 600;
            font-family: 'Roboto', sans-serif;
          }   
          nav.barra-superior > button.navbar-toggler > span.navbar-toggler-icon {
            color: #dae1e7;
          }
        </style>  
</html>
