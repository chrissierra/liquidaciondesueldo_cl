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

    <div class="row mb-5">
        
        <div class="col-12 text-center">
            <h2 class="titulo mb-4">
                Calcular sueldo liquido
            </h2>
        </div>

        <div class="col-12 mb-5">
          <p class="text-muted subtitulo">
                Debes poner mucha atención al usar nuestro servicio de liquidacion de sueldo masivo para calcular sueldo liquido.   
          </p>
        </div>

        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                          <th scope="col tabla_explicacion_masivo">Nombre</th>
                          <th scope="col tabla_explicacion_masivo">Apellido</th>
                          <th scope="col tabla_explicacion_masivo">Liquido</th>
                          <th scope="col tabla_explicacion_masivo">Movilizacion</th>
                          <th scope="col tabla_explicacion_masivo">Colacion</th>
                          <th scope="col tabla_explicacion_masivo" style="min-width: 10em;">AFP</th>
                          <th scope="col tabla_explicacion_masivo">Isapre</th>  
                          <th scope="col tabla_explicacion_masivo">Fun</th>
                          <th scope="col tabla_explicacion_masivo">TipoContrato</th>
                          <th scope="col tabla_explicacion_masivo">Cargas</th>
                          <th scope="col tabla_explicacion_masivo">Tramo</th>
                          <th scope="col tabla_explicacion_masivo">Mes</th>
                          <th scope="col tabla_explicacion_masivo">Anio</th>
                          <th scope="col tabla_explicacion_masivo">Gratificacion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                          <th scope="row">Los nombres del trabajador</th>
                          <td>Apellidos Del trabajador</td>
                          <td>Monto líquido a pagar (Pactado)</td>
                          <td>Monto a pagar por movilización</td>
                          <td>Monto a pagar por Colación</td>
                          <td>
                            <p>Debes rellenar solamente con el número. Ej, si es Modelo debes poner solamente un 6.</p>
                               <p>0-Provida</p> 
                               <p>1-Capital</p> 
                               <p>2-Cuprum</p> 
                               <p>3-PlanVital</p> 
                               <p>4-Uno</p> 
                               <p>5-IPS</p> 
                               <p>6-Modelo</p> 
                               <p>7-Habitat</p> 
                               <p>8-Pensionado</p> 

                           </td><!-- 'Provida', 'Capital', 'Cuprum', 'PlanVital', 'Uno', 'IPS', 'Modelo', 'Habitat', 'Pensionado' -->
                          <td>Fonasa o isapre. </td>
                          <td>Monto en UF separado por puntos. Ej: 1.52</td>
                          <td>Si es indefinido se escribe 1; si es fijo se escribe 2.</td>
                          <td>Numero de cargas. Escribir un número entero. Ej: 2</td>
                          <td>Escribir un 1 si es tramo 1. 2 para el tramo 2 y 3 para el tramo 3. </td>
                          <td>Escribir con un número entero el mes. Ej: 3 ( Marzo )</td>                                                    
                          <td>Escribir con un número entero el Año. Ej: 2020</td>                                                    
                          <td>Escribir con un número entero la gratificación, si es 1 será mensual. Si se escribe 2 se cancelará anual.</td>                                                    
                        </tr>


                </table>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <p>
                Puedes descargar el CSV que utilizamos desde el siguiente link. Debes mantener las cabeceras y completarlo simplemente.
            </p>
            <p>
                <a href="{{ asset('file/test_.csv') }}">Archivo CSV</a>
            </p>
        </div>
    </div>

    


    <div class="row ">
       
        <form  action="{{ route('importacion.csv') }}" method="post" enctype="multipart/form-data" >
        
        @csrf
        <input type="file" name="csv">

        <button>Importar</button>

        </form> 

    </div>


       </div>
    </div>
  </div>

   <!-- <form  action="{{ route('importacion.csv') }}" method="post" enctype="multipart/form-data" >
        
    @csrf
    <input type="file" name="csv">

    <button>Importar</button>

    </form> -->

    </body>
</html>
