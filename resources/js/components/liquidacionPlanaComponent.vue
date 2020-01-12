<template>
   
  <div class="container-fluid">
      <h4 class="text-center mb-4">Liquidación de sueldo generada</h4>
    <div class="row">
          <div class="col-lg-6 col-sm-12 ">
              
              <h5  class="text-center text-muted">Haberes</h5>
              
              <div class="row">               
                <div class="col-lg-6 col-sm-12 item-liquidacion">
                  Sueldo Base:
                </div>  
                <div class="col-lg-6 col-sm-12 item-liquidacion">
                  {{ liquidacion_generada.sueldoBase | aproximarConPeso(0) }}
                </div>  
              </div>

              <div class="row">               
                <div class="col-lg-6 col-sm-12 item-liquidacion">
                  Gratificación:
                </div>  
                <div class="col-lg-6 col-sm-12 item-liquidacion">
                  {{ liquidacion_generada.montoGratificacionLegal | aproximarConPeso(0) }}
                </div>  
              </div>
             
          
          </div>
 
          <div class="col-lg-6 col-sm-12 ">
                        <h5  class="text-center  text-muted">Descuentos Legales</h5>
                        
                        <div class="row ">                        
                          <div class="col-lg-6 col-sm-12 item-liquidacion">
                            AFP:
                          </div>  
                          <div class="col-lg-6 col-sm-12 item-liquidacion">
                            {{ liquidacion_generada.MontoAfp | aproximarConPeso(0) }}
                          </div>  
                        </div>

                        <div class="row">                         
                          <div class="col-lg-6 col-sm-12 item-liquidacion">
                            Isapre:
                          </div>  
                          <div class="col-lg-6 col-sm-12 item-liquidacion">
                            {{ liquidacion_generada.MontoIsapre  | aproximarConPeso(0) }}
                          </div>  
                        </div>

                        <div class="row">                         
                          <div class="col-lg-6 col-sm-12 item-liquidacion">
                            Cesantía:
                          </div>  
                          <div class="col-lg-6 col-sm-12 item-liquidacion">
                            {{ liquidacion_generada.MontoCesantia  | aproximarConPeso(0)}}
                          </div>  
                        </div>

                        <div class="row">                         
                          <div class="col-lg-6 col-sm-12 item-liquidacion">
                            Impuesto:
                          </div>  
                          <div class="col-lg-6 col-sm-12 item-liquidacion">
                            {{ liquidacion_generada.impuesto  | aproximarConPeso(0)}}
                          </div>  
                        </div>           

                        <div class="row">                         
                          <div class="col-lg-6 col-sm-12 item-liquidacion">
                            Adicional Isapre:
                          </div>  
                          <div class="col-lg-6 col-sm-12 item-liquidacion">
                            {{ liquidacion_generada.adicionalIsapre  | aproximarConPeso(0)}}
                          </div>  
                        </div>                                        
            </div>
    </div>


    <div class="row mt-3" >
            <div class="col-lg-6 col-sm-12">
              <h5  class="text-center  text-muted">Haberes no imponibles</h5>
              <!-- Row con cada item -->
                        <div class="row">                         
                          <div class="col-lg-7 col-sm-12 item-liquidacion">
                            No&nbsp;imponibles:
                          </div>  
                          <div class="col-lg-5 col-sm-12 item-liquidacion">
                            {{ liquidacion_generada.noImponible  | aproximarConPeso(0) }}
                          </div>  
                        </div>

              <!-- Row con cada item -->
            </div>
            <div class="col-lg-6 col-sm-12">
              <h5  class="text-center  text-muted">Otros descuentos</h5>
              <!-- Row con cada item -->


              <!-- Row con cada item -->
            </div>
    </div>


    <div class="row mt-4">
      <div class="col-12 text-center">
       <p class="text-muted" style="font-size: 1.3em;"> Sueldo Líquido a pago:</p>
      </div>
      <div class="col-12 text-center">
        {{ liquidacion_generada.liquido | aproximarConPeso(0) }}
      </div>
    </div>

  </div>



</template>

<script>
    export default {
      props:['liquidacion'],
        mounted() {
        },

        data(){
            return{
              liquidacion_generada: null
            }
        },  
        methods: {
            verValor(){
              //alert(JSON.stringify(this.liquidacion));
              console.log("verValor", this.liquidacion.MontoAfp);
              this.liquidacion_generada = this.liquidacion;
              this.liquidacion_generada = null;
              this.liquidacion_generada = this.liquidacion;
            }
        
        },
        watch:{
          liquidacion_generada: function (newQuestion, oldQuestion) {
             this.liquidacion_generada = newQuestion;
             console.log("en watch", newQuestion)
          }            
        }
    }
</script>


<style>

  .item-liquidacion{
    font-size: .9em;
  }

</style>