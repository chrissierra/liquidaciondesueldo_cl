<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Liquidacion de sueldo</title>
       <!-- <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">-->
    </head>
    <style type="text/css"  media="all">
      
      html{
        font-size: .8em;
      }


      .titulo_liquidacion{
  text-align: center;
  margin-bottom: 1em;
}
.datos_Empresa{
  display:flex;
  border-bottom: 2px solid;
}

.p_sin_margin_botom{
  margin-bottom:0;
}
.container-razonSocial, .container-razonSocial{
  flex-grow: 50%;
  flex-basis:50%;

}
.contenedor{
  padding:3em 4em;
  /*width: 50%;
  height: 30vh;*/
  width: 80%;
  height: 100vh;
  margin: 0 auto;
  background-color: white;
}



.datosTrabajador{
  display: flex;
  justify-content: space-between;
  border-bottom: 2px solid;
}

.prevision{
  display: flex;
  justify-content: space-between;
  border-bottom: 2px solid;
}

.prevision > div{
  flex-grow: 50%;
  flex-basis:50%;
}
.nombre_Afp, .afp-comision, .nombre_isapre{
  margin-top: 0;
  margin-bottom:0;
  font-size:.8em;
  opacity: .7;
}

.dias_cargas_tributable_imponible{
  display: flex;
  justify-content: space-between;
  border-bottom: 2px solid;
}

.container-titulo-haberes-descuento{
  border-bottom: 2px solid;
  justify-content: space-around;
  display: flex;
}

.no_margin_top{
  margin-top: .3em;
}

.haberes-descuentos{
  display: flex;
  min-height: 35%;
  border-bottom: 2px solid;
}
.haberes-descuentos > div {
  flex-grow: 50%;
  flex-basis:50%;
}

.item-liquidacion, .contenedor-totales-finales{
  display: flex;
  justify-content: space-between;
  margin: 0 auto;
}
.resumen-total{
  font-weight:800;
}
.container-haberes, .container-descuentos{
  margin-top:1em;
  padding:1em;
}
.mt2{
  margin-top: 2em;
}

.texto-space-between{
  display: -webkit-flex;
  display: -moz-flex;
  display: -ms-flex;
  display: -o-flex;
  display: flex;
  justify-content: space-between;
}



    </style>
    <body>
        <div class="contenedor">
  <div class="titulo_liquidacion">LIQUIDACION DE SUELDO</div>
  
  <div class="mes_anio">
    Remuneraciones Mes de noviembre 2020
  </div>
  
  <div class="datos_Empresa">
    <div class="container-razonSocial">
      <p>RAZON SOCIAL: </p>
      <p class="p_sin_margin_botom">{{ $modelo->trabajador->empresa->razonSocial }} </p>
    </div>
    <div class="container-rutEmpresa">
      <p>RUT EMPRESA: </p>
      <p  class="p_sin_margin_botom">76.355.851-7 </p>
    </div>
  </div>
  
  
  
  <div class="datosTrabajador">
    <div class="rut-container">
      <p  class="p_sin_margin_botom">RUT</p>
      <p  class="p_sin_margin_botom no_margin_top">{{ $modelo->trabajador->rut }}</p>
    </div>
    <div class="nombre-container">
      <p  class="p_sin_margin_botom">Trabajador</p>
      <p  class="p_sin_margin_botom no_margin_top">{{ $modelo->trabajador->nombre }} {{ $modelo->trabajador->empresa->apellidos }}</p>
    </div>
    <div class="centroCosto-container">
      <p  class="p_sin_margin_botom">Centro</p>
      <p  class="p_sin_margin_botom no_margin_top">Municipalidad Renca</p>
    </div>    
  </div>
  
  
  <div class="prevision">
    <div class="afp-container">
      <p class="p_sin_margin_botom">AFP</p>
      <p class="nombre_Afp">
        Modelo
      </p>
      <p class="afp-comision">
        10.69
      </p>
    </div>
    <div class="isapre-container">
      <p class="p_sin_margin_botom">ISAPRE</p>
      <p class="nombre_isapre">Fonasa</p>
    </div>
  </div>
  
  
  
  <div class="dias_cargas_tributable_imponible">
    <div class="container-dias">
      <p  class="p_sin_margin_botom no_margin_top">Dias</p>
      <p  class="p_sin_margin_botom no_margin_top">30</p>
    </div>
    <div class="container-cargas">
      <p  class="p_sin_margin_botom no_margin_top">Cargas</p>
      <p  class="p_sin_margin_botom no_margin_top">0</p>
    </div>
    <div class="container-tributable">
      <p  class="p_sin_margin_botom no_margin_top">Tributable</p>
      <p  class="p_sin_margin_botom no_margin_top">301.203</p>
    </div>
    <div class="container-imponible">
      <p  class="p_sin_margin_botom no_margin_top">Imponible</p>
      <p  class="p_sin_margin_botom no_margin_top">301.000</p>
    </div>
  </div>
  
  
  <div class="container-titulo-haberes-descuento">
   <p  class="p_sin_margin_botom no_margin_top">HABERES</p>
    <p  class="p_sin_margin_botom no_margin_top">DESCUENTOS</p>  
  </div>
  
  
  <div class="haberes-descuentos"><!-- **** Comienzo sección haberes descuentos -->
    
    <div class="container-haberes">
      
      <div class="container-imponibles">
            <p class="item-liquidacion">
              <span>Sueldo Base</span>
              <span>$600.000</span>
            </p>
            <p class="item-liquidacion p_sin_margin_botom">
              <span>Bono Responsabilidad</span>
              <span>$600.000</span>
            </p>
      </div>
      
     <div class="container-imponibles">
        <p class="item-liquidacion resumen-total">
          <span>Total Imponible</span>
          <span>$600.000</span>
        </p>
      </div><!-- Fin imponible -->
      
      
      
      
      
    <div class="container-noImponibles mt2">
                       
              <div class="container-imponibles">
                <p class="item-liquidacion">
                  <span>Sueldo Base</span>
                  <span>$600.000</span>
                </p>
                <p class="item-liquidacion p_sin_margin_botom">
                  <span>Bono Responsabilidad</span>
                  <span>$600.000</span>
                </p>
              </div>
           
                
              <div class="container-imponibles">
                <p class="item-liquidacion resumen-total">
                  <span>Total No Imponible</span>
                  <span>$600.000</span>
                </p>
              </div><!-- Fin NO  imponible -->
        
      </div>  <!-- Fin container no imponible -->
      
    </div><!-- ****  FIN container-haberes  **** -->
    
    
    
    
    
    <div class="container-descuentos">
      
            <div class="container-imponibles">
              <p class="item-liquidacion">
                <span>Sueldo Base</span>
                <span>$600.000</span>
              </p>
              <p class="item-liquidacion p_sin_margin_botom">
                <span>Bono Responsabilidad</span>
                <span>$600.000</span>
              </p>
            </div>
            
            <div class="container-imponibles">
              <p class="item-liquidacion resumen-total">
                <span>Total Dsctos. Legales</span>
                <span>$600.000</span>
              </p>
            </div>
   
      
      
      
            <div class="container-imponibles mt2">
              <p class="item-liquidacion">
                <span>Sueldo Base</span>
                <span>$600.000</span>
              </p>
              <p class="item-liquidacion p_sin_margin_botom">
                <span>Bono Responsabilidad</span>
                <span>$600.000</span>
              </p>
            </div>
            
            <div class="container-imponibles">
              <p class="item-liquidacion resumen-total">
                <span>Total otros dsctos.</span>
                <span>$600.000</span>
              </p>
            </div>
      
    </div><!--container-descuentos -->
    
  </div><!-- ******  Fin de toda la seccion de haberes-descuentos  *****  -->
  
  <div class="contenedor-totales-finales">
      
      <div class="container-imponibles" style="width:48%">
        <p class="item-liquidacion">
          <div class="texto-space-between">
                <span>Total Haberes</span>
                <span>$600.000</span>
          </div>
        </p>
        <p class="item-liquidacion">
          <div class="texto-space-between">
                <span>Fecha</span>
                <span>28/02/2020</span>
          </div>
        </p>
      </div>

      <div class="container-imponibles" style="width:48%">
        <p class="item-liquidacion">
          <div class="texto-space-between">
                <span>Total Descuentos</span>
                <span>$600.000</span>
          </div>
        </p>
        <p class="item-liquidacion">
          <div class="texto-space-between">
                <span>Alcance Líquido</span>
                <span>$600.000</span>
          </div>
        </p>
      </div>





  </div>

  <div class="sueldo-escrito" style="border-bottom: 2px solid;">
        Son SEISCIENTOS CINCUENTA Y OCHO MIL NOVECIENTOS CINCUENTA Y TRES PESOS.
  </div>

  <div>
    Recibí conforme el alcance líquido de la presente
liquidación, no teniendo cargo o cobro alguno que
hacer por otro concepto.
  </div>



  <div class="footer-liquidacion mt4">
    
    <p class="firmaEmpleador firma">FIRMA EMPLEADOR</p>

    <p class="firmaTrabajador firma">FIRMA TRABAJADOR</p>


  </div>

  <style type="text/css"  media="all">
  .mt4{
    margin-top: 4em;
  }


    .footer-liquidacion{
      display: flex;
     justify-content: space-around; 
    }

    .firma{
      width: 30%;
    }

    .firma::before{
      content:'';
      display: block;
      height:2px;
      width: 10em;
      background-color: black;
      transform: translateX(-.4em) translateY(-.2em);
    }


  </style>
  


</div><!-- FIN CONTENEDOR DE LIQUIDACION DE SUELDO -->

      

      


    </body>

    

</html>
