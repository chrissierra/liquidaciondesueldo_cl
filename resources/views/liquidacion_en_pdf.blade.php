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

      body{
        font-family: 'Courier';
        font-size: .8em;
      }

      p{
        margin: .3em 0;
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


      .col-2-pdf{
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

      .clearfix{
        clear:both;
      }

      .clearfix-left{
        clear:left;
      }
      .clearfix-right{
        clear:right;
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



      .firmas::before{
        content: '';
        display: block;
        height: 2px;
        width: 15em;
        background-color: black;
        position:relative;
        left: 4.5em;

        
      }  

    </style>
    <body>
        <div class="contenedor">
                 <div class="text-center">
                  <h2>LIQUIDACION DE SUELDO</h2>
                </div>
           <div class="row">


                <div class="subtitulo">
                  <h3>REMUNERACIONES MES DE: FEBRERO del 2019</h3>
                </div>

                <div class="col-2">
                  <p>RAZON SOCIAL:</p>
                  <p>RUT EMPRESA:</p>
                </div><div class="clearfix"></div>

                <div class="col-2" >
                  <p>{{ $modelo->trabajador->empresa->razonSocial }}</p>
                  <p >{{ $modelo->trabajador->empresa->rutEmpresa }}</p>
                </div><div class="clearfix" style="border-bottom: 2px solid;"></div>

                <div class="col-3"  style="border-bottom: 2px solid;">
                  <div class="text-center">
                    <p>Rut</p>
                    <p>{{ $modelo->trabajador->rut }}</p>
                  </div>
                  <div class="text-center">
                    <p>Trabajador</p>
                    <p>{{ $modelo->trabajador->nombre }} {{ $modelo->trabajador->apellidos }}</p>
                  </div>
                  <div class="text-center">
                    <p>C.Costo</p>
                    <p>Renca</p>
                  </div>                                                                      
                </div><div class="clearfix"></div>



                <div class="col-2">
                  <p>AFP</p>
                  <p>ISAPRE</p>
                </div><div class="clearfix"></div>


                <div class="col-2"  >
                  <p>{{ json_decode($modelo->objeto_liquidacion, true)['nombre_afp'] }}</p>
                  <p>{{ json_decode($modelo->objeto_liquidacion, true)['salud_nombre'] }}</p>
                </div><div class="clearfix" style="border-bottom: 2px solid;"></div>

              

               <div class="col-4"  style="border-bottom: 2px solid;">
                  <div class="text-center">
                    <p>Días</p>
                    <p>{{json_decode($modelo->objeto_liquidacion, true)['diasTrabajados']}}</p>
                  </div>
                  <div class="text-center">
                    <p>Cargas</p>
                     <p>{{ json_decode($modelo->objeto_liquidacion, true)['cargas'] }}</p>
                  </div>
                  <div class="text-center">
                    <p>Tributable</p>
                     <p>{{ number_format(json_decode($modelo->objeto_liquidacion, true)['montoTributable']) }}</p>
                  </div>   

                  <div class="text-center">
                    <p>Imponible</p>
                     <p>{{ number_format(json_decode($modelo->objeto_liquidacion, true)['imponible']) }}</p>
                  </div>                                                                      
                </div><div class="clearfix"></div>

                <div class="col-2"  style="text-align: center;">
                  <p>HABERES</p>
                  <p>DESCUENTOS</p>
                </div><div class="clearfix"  style="border-bottom: 2px solid;"></div>

               












                <!-- Comienzan haberes y descuentos. -->
                <!-- Comienzan haberes y descuentos. -->
                <!-- Comienzan haberes y descuentos. -->
                <!-- Comienzan haberes y descuentos. -->


                

              <div class="main-seccion">
                   <div class="col-4" >
                      <div class="text-center">
                        <p>Sueldo Base</p>
                        <p>Gratificación</p>
                      </div>
                      <div class="text-center">
                         <p>{{ number_format(json_decode($modelo->objeto_liquidacion, true)['sueldoBase'])}}</p>
                         <p>{{ number_format(json_decode($modelo->objeto_liquidacion, true)['montoGratificacionLegal'])}}</p>
                      </div>
                      <div class="text-center">
                        <p>Salud</p>
                        <p>AFP</p>
                      </div>   

                      <div class="text-center">
                         <p>{{ number_format(json_decode($modelo->objeto_liquidacion, true)['MontoIsapre'])}}</p>
                         <p>{{ number_format(json_decode($modelo->objeto_liquidacion, true)['MontoAfp'])}}</p>
                      </div>                                                                      
                    </div><div class="clearfix"></div>




                    
              
              <div class="LadoHaberes"  style="float:left;width: 50%;">
              
                                  @if (isset(json_decode($modelo->objeto_liquidacion, true)['bonos']) && json_decode($modelo->objeto_liquidacion, true)['bonos'] > 0)
                                  <div class="text-center" style="width:50%; float:left; margin:0">
                                    <p>Bonos</p>
                                  </div>
                                  <div class="text-center" style="width:50%; float:left; margin:0">
                                    <p>{{number_format(json_decode($modelo->objeto_liquidacion, true)['bonos'])}}</p>
                                  </div><div class="clearfix-right"></div>
                                  @endif
                                  
    
                                  @if (isset(json_decode($modelo->objeto_liquidacion, true)['montoHorasExtras']) && json_decode($modelo->objeto_liquidacion, true)['montoHorasExtras'] > 0)
                                  <div class="text-center" style="width:50%; float:left; margin:0">
                                    <p>Hrs. Extras</p>
                                  </div>
                                  <div class="text-center" style="width:50%; float:left; margin:0">
                                    <p>{{number_format(json_decode($modelo->objeto_liquidacion, true)['montoHorasExtras'])}}</p>
                                  </div><div class="clearfix-right"></div>
                                  @endif


                                  <div class="clearfix-left"></div>
                                  <div class="text-center" style="width:50%; float:left; margin:0">
                                    <p style="font-weight: 800">Total Imp</p>
                                  </div>
                                  <div class="text-center" style="width:50%; float:left; margin:0">
                                    <p style="font-weight: 800">{{number_format(json_decode($modelo->objeto_liquidacion, true)['imponible'])}}</p>
                                  </div><div class="clearfix-right"></div>



                                  @if (isset(json_decode($modelo->objeto_liquidacion, true)['movilizacion']) && json_decode($modelo->objeto_liquidacion, true)['movilizacion'] > 0)
                                  <div class="text-center" style="width:50%; float:left; margin:0">
                                    <p>Movilizacion</p>
                                  </div>
                                  <div class="text-center" style="width:50%; float:left; margin:0">
                                    <p>{{number_format(json_decode($modelo->objeto_liquidacion, true)['movilizacion'])}}</p>
                                  </div><div class="clearfix-right"></div>
                                  @endif



                                  @if (isset(json_decode($modelo->objeto_liquidacion, true)['colacion']) && json_decode($modelo->objeto_liquidacion, true)['colacion'] > 0)
                                  <div class="text-center" style="width:50%; float:left; margin:0">
                                    <p>Colación</p>
                                  </div>
                                  <div class="text-center" style="width:50%; float:left; margin:0">
                                    <p>{{number_format(json_decode($modelo->objeto_liquidacion, true)['colacion'])}}</p>
                                  </div><div class="clearfix-right"></div>
                                  @endif 


                                  @if (isset(json_decode($modelo->objeto_liquidacion, true)['MontoPorCargas']) && json_decode($modelo->objeto_liquidacion, true)['MontoPorCargas'] > 0)
                                  <div class="text-center" style="width:50%; float:left; margin:0">
                                    <p>Monto Cargas</p>
                                  </div>
                                  <div class="text-center" style="width:50%; float:left; margin:0">
                                    <p>{{number_format(json_decode($modelo->objeto_liquidacion, true)['MontoPorCargas'])}}</p>
                                  </div><div class="clearfix-right"></div>
                                  @endif                                   


                                  <div class="clearfix-left"></div>
                                  <div class="text-center" style="width:50%; float:left; margin:0">
                                    <p style="font-weight: 800">Total No Imp</p>
                                  </div>
                                  <div class="text-center" style="width:50%; float:left; margin:0">
                                    <p style="font-weight: 800">{{number_format(json_decode($modelo->objeto_liquidacion, true)['noImponible'])}}</p>
                                  </div><div class="clearfix-right"></div>                                                                                                     


              </div>










              <div class="LadoDescuentos" style="float:left;width: 50%;">
                            @if (json_decode($modelo->objeto_liquidacion, true)['MontoCesantia'] > 0)
                            <div class="text-center" style="width:50%; float:right; margin:0">
                               <p>{{number_format(json_decode($modelo->objeto_liquidacion, true)['MontoCesantia'])}}</p>
                            </div>
                            <div class="text-center" style="width:50%; float:right; margin:0">
                              <p>Seg. Cesantía</p>                    
                            </div><div class="clearfix-right"></div>
                            @endif



                            @if (json_decode($modelo->objeto_liquidacion, true)['impuesto'] > 0)
                            <div class="text-center" style="width:50%; float:right; margin:0">
                               <p>{{number_format(json_decode($modelo->objeto_liquidacion, true)['impuesto'])}}</p>
                            </div>
                            <div class="text-center" style="width:50%; float:right; margin:0">
                              <p>Impuesto</p>                    
                            </div><div class="clearfix-right"></div>
                            @endif

                            @if (json_decode($modelo->objeto_liquidacion, true)['adicionalIsapre'] > 0)
                            <div class="text-center" style="width:50%; float:right; margin:0">
                               <p>{{number_format(json_decode($modelo->objeto_liquidacion, true)['adicionalIsapre'])}}</p>
                            </div>
                            <div class="text-center" style="width:50%; float:right; margin:0">
                              <p>Adic. Isapre</p>                    
                            </div><div class="clearfix-left"></div>
                            @endif        


                            
                            <div class="text-center" style="width:50%; float:right; margin:0">
                               <p style="font-weight: 800">{{number_format(json_decode($modelo->objeto_liquidacion, true)['totalDescuentos'])}}</p>
                            </div>
                            <div class="text-center" style="width:50%; float:right; margin:0">
                              <p style="font-weight: 800">Total Dsc Leg</p>                    
                            </div><div class="clearfix-left"></div>


                            @if (isset(json_decode($modelo->objeto_liquidacion, true)['anticipo']) && json_decode($modelo->objeto_liquidacion, true)['anticipo'] > 0)
                            <div class="text-center" style="width:50%; float:right; margin:0">
                               <p>{{number_format(json_decode($modelo->objeto_liquidacion, true)['anticipo'])}}</p>
                            </div>
                            <div class="text-center" style="width:50%; float:right; margin:0">
                              <p>Anticipo</p>                    
                            </div><div class="clearfix-left"></div>
                            @endif    

                          @if (isset(json_decode($modelo->objeto_liquidacion, true)['descuentosTotales']) )
                            <div class="text-center" style="width:50%; float:right; margin:0">
                               <p style="font-weight: 800">{{number_format(json_decode($modelo->objeto_liquidacion, true)['descuentosTotales'])}}</p>
                            </div>
                            <div class="text-center" style="width:50%; float:right; margin:0">
                              <p style="font-weight: 800">Total Dsctos</p>                    
                            </div><div class="clearfix-left"></div>                                                      
                          @endif                        

                    </div>
                </div>                
                <!-- Comienzan haberes y descuentos, se usará un bucle. -->
                <!-- Comienzan haberes y descuentos, se usará un bucle. -->
                <!-- Comienzan haberes y descuentos, se usará un bucle. -->
                <!-- Comienzan haberes y descuentos, se usará un bucle. -->




















                <div class="seccion-resumen">
                    <div class="col-4" >
                      <div class="text-center">
                        <p>Total Haberes</p>
                        <p>Total Dsctos</p>
                      </div>
                      <div class="text-center">
                         <p>{{ number_format(json_decode($modelo->objeto_liquidacion, true)['totalHaberes'])}}</p>
                         <p>{{ number_format(json_decode($modelo->objeto_liquidacion, true)['totalDescuentos'])}}</p>
                      </div>
                      <div class="text-center">
                        <p>Fecha</p>
                        <p>Alcance Líquido</p>
                      </div>   

                      <div class="text-center">
                        <p>28/01/2020</p>
                        <p>{{ number_format(json_decode($modelo->objeto_liquidacion, true)['liquido'] )}}</p>
                      </div>                                                                      
                    </div><div class="clearfix"></div>
                </div>

                <div class="borde_inferior"  style="margin-bottom:1em">
                  SON: SETECIENTOS DIECIOCHO MIL SEISCIENTOS DIECIOCHO PESOS.

                </div>


                <div class="" style="margin-bottom: 13em">
                  Recibí conforme el alcance líquido de la presente
                  liquidación, no teniendo cargo o cobro alguno que
                  hacer por otro concepto.
                </div>

                
                <div class="col-2"  style="text-align: center;">
                  <p class="firmas">FIRMA EMPLEADOR</p>
                  <p class="firmas">FIRMA TRABAJADOR</p>
                </div> <div class="clearfix"></div>

  
            </div>  

        </div><!-- FIN CONTENEDOR DE LIQUIDACION DE SUELDO -->
    </body>
</html>