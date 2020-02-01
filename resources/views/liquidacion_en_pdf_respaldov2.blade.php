<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Liquidacion de sueldo</title>
       <!-- <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">-->
    </head>
    <style type="text/css"  media="all">
      /*
      *,
      ::before,
      ::after {
       box-sizing: border-box;
      }  */

      p{
        margin: 0;
        padding: 0;
      }

      .borde_inferior{
        border-bottom: 2px solid;
      }

      .text-center{
        text-align: center;
      }
      .col-2 > * {
        width: 50%;
        float:left;

      }

      .main-seccion{
        height: 18em;
        border-bottom:2px solid;
      }

      .col-3 > div {
        width: 33.333%;
        float:left;
      }

      .col-4 > div {
        width: 25%;
        float:left;
      }


      [class*="col-"]::after {
       content: " ";
       display: block;
       clear: both;
      }
    
      .contenedor{
        padding:2em;
      }


      .mb1{
        margin-bottom:1em;
      }

      .mb2{
        margin-bottom:2em;
      }


/*
      .firmas::before{
        content: '';
        display: block;
        height: 2px;
        width: 15em;
        background-color: black;
        position:relative;

        
      }  
/*
    </style>
    <body>
        <div class="contenedor">
 
           <div class="row">
                <div class="text-center">
                  <h2>LIQUIDACION DE SUELDO</h2>
                </div>

                <div class="subtitulo">
                  <h3>REMUNERACIONES MES DE: FEBRERO del 2019</h3>
                </div>

                <div class="col-2">
                  <p>RAZON SOCIAL:</p>
                  <p>RUT EMPRESA:</p>
                </div>

                <div class="col-2 borde_inferior">
                  <p>{{ $modelo->trabajador->empresa->razonSocial }}</p>
                  <p class="">{{ $modelo->trabajador->empresa->rutEmpresa }}</p>
                </div>

                <div class="col-3 borde_inferior">
                  <div class="text-center">
                    <p>Rut</p>
                    <p>17961493-6</p>
                  </div>
                  <div class="text-center">
                    <p>Trabajador</p>
                    <p>Christopher Sierra</p>
                  </div>
                  <div class="text-center">
                    <p>C.Costo</p>
                    <p>Renca</p>
                  </div>                                                                      
                </div>



                <div class="col-2">
                  <p>AFP</p>
                  <p>ISAPRE</p>
                </div>


                <div class="col-2 borde_inferior">
                  <p>Modelo</p>
                  <p>Fonasa</p>
                </div>



             <!--  <div class="col-4 borde_inferior">
                  <div class="text-center">
                    <p>Días</p>
                    <p>30</p>
                  </div>
                  <div class="text-center">
                    <p>Cargas</p>
                    <p>0</p>
                  </div>
                  <div class="text-center">
                    <p>Tributable</p>
                    <p>$305.000</p>
                  </div>   

                  <div class="text-center">
                    <p>Imponible</p>
                    <p>$450.000</p>
                  </div>                                                                      
                </div>

                <div class="col-2 borde_inferior text-center">
                  <p>HABERES</p>
                  <p>DESCUENTOS</p>
                </div> -->

                <!-- Comienzan haberes y descuentos, se usará un bucle. -->

              <!--  <div class="main-seccion">
                         <div class="col-2">
                            <div class="col-2 text-center">
                              <p>Sueldo Base</p>
                              <p>$301.000</p>
                            </div>
                            <div class="col-2 text-center">
                              <p>Previsión</p>
                              <p>$75.000</p>
                            </div>                                                                     
                        </div>

                        <div class="col-2">
                            <div class="col-2 text-center">
                              <p>Gratificación Legal</p>
                              <p>$75.250</p>
                            </div>
                            <div class="col-2 text-center">
                              <p>Salud</p>
                              <p>$75.000</p>
                            </div>                                                                     
                        </div>
                </div>
                
                <div class="col-2">
                            <div class="col-2 text-center mb1">
                              <p>Total Haberes</p>
                              <p>$301.000</p>
                            </div>
                            <div class="col-2 text-center mb1">
                              <p>Total Descuentos</p>
                              <p>$75.000</p>
                            </div>                                                                     
                </div>

                <div class="col-2">
                            <div class="col-2 text-center mb1">
                              <p>Fecha</p>
                              <p>28/01/2020</p>
                            </div>

                            <div class="col-2 text-center mb1">
                              <p>Alcance líquido</p>
                              <p>$75.000</p>
                            </div>                                                                     
                </div>

                <div class="borde_inferior mb1">
                  SON: SETECIENTOS DIECIOCHO MIL SEISCIENTOS DIECIOCHO PESOS.

                </div>


                <div class="mb2">
                  Recibí conforme el alcance líquido de la presente
                  liquidación, no teniendo cargo o cobro alguno que
                  hacer por otro concepto.
                </div>


                <div class="col-2 text-center">
                  <h4 class="firmas">FIRMA EMPLEADOR</h4>
                  <h4 class="firmas">FIRMA TRABAJADOR</h4>
                </div>

  
            </div>  -->

        </div><!-- FIN CONTENEDOR DE LIQUIDACION DE SUELDO -->
    </body>
</html>
