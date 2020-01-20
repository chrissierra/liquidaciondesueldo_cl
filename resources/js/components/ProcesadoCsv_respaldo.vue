<template>
    <div class="container">
        
    <div class="row">
        
        <div class="col-12 text-center titulo mb-4">
            <h1>
                Obtiene tu sueldo base desde el sueldo líquido
            </h1>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
         
          <p>Ver si funciona</p>
          <button  v-on:click="Proceso1Sueldos" >Calcular</button>
          <button  v-on:click="VisualizarResultado">Visualizar</button>

         <div  class="table-responsive">
            <table v-if="visualizarBooleano" class="table">
             <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Apellido</th>
                  <th scope="col">Rut</th>
                  <th scope="col">Líquido</th>
                  <th scope="col">Gratificación</th>
                  <th scope="col">Sueldo Base</th>
                  <th scope="col">Total Imponible</th>
                  <th scope="col">Mes</th>
                  <th scope="col">Año</th>
                  <th scope="col">AFP</th>
                  <th scope="col">Monto AFP</th>
                  <th scope="col">Monto Salud</th>
                  <th scope="col">Cesantia</th>
                  <th scope="col">Impuesto</th>
                  <th scope="col">Colacion</th>
                  <th scope="col">Movilizacion</th>
                </tr>
              </thead>
              <tbody>

                <tr v-for="trabajador in datosTrabajador">
                  <td scope="row">#</td>
                  <td >{{ trabajador.nombre }}</td>
                  <td >{{ trabajador.apellido }}</td>
                  <td >{{ trabajador.rut }}</td>
                  <td >{{ trabajador.liquido | aproximar(0)  }}</td>
                  <td >{{ trabajador.montoGratificacionLegal | aproximar(0)  }}</td>
                  <td >{{ trabajador.sueldoBase | aproximar(0) }} </td>
                  <td >{{ trabajador.imponible | aproximar(0)  }} </td>
                  <td >{{ trabajador.mes }}</td>
                  <td >{{ trabajador.anio }}</td>
                  <td >{{ trabajador.objetoAfp.nombre_afp }}</td>
                  <td >{{ trabajador.MontoAfp | aproximar(0)  }} </td>
                  <td >{{ trabajador.MontoIsapre | aproximar(0)  }} </td>
                  <td >{{ trabajador.MontoCesantia | aproximar(0)  }}</td>
                  <td >{{ trabajador.impuesto | aproximar(0)  }}</td>
                  <td >{{ trabajador.colacion | aproximar(0)  }}</td>
                  <td >{{ trabajador.movilizacion | aproximar(0)  }}</td>
                </tr>

              </tbody>
            </table>
          </div>    <!-- Fin Tabla -->

        </div>
    </div>



    </div>
</template>

<script>
    export default {
      props:['datos','parametros'],
        mounted() {
          
          ////console.log(JSON.parse(this.datos)[0]);
          //this.Proceso1Sueldos()  

        },
        data(){
            return{
              datosTrabajador: JSON.parse(this.datos)[0],
              impuestos: [],
              visualizarBooleano: false
            }
        },  
        methods: {

                VisualizarResultado(){
                  this.visualizarBooleano = true;
                },
                
                Proceso1Sueldos(){

                    this.datosTrabajador.forEach( (value, key) => {
                      
                      //console.log(key)
                      this.Proceso2Sueldos(value, key);

                      ////console.log(value)
                    })


                    //console.log(this.datosTrabajador)


                },

                json2array(json){
                      var result = [];
                      Object.entries(json).forEach(([key, value]) => {                            
                               result.push({
                                nombre_afp: key,
                                comision: value
                               })                                                      
                      });

                      return result;
                },

                Proceso2Sueldos(trabajador, indice){

                    axios
                    .post('./api/ImpuestosDelMes', {mes:trabajador.mes, anio:trabajador.anio}, { crossdomain: true })
                    .then(response => {

                        //console.log(trabajador);

                      axios
                      .post('./api/AfpPorMes', {mes: trabajador.mes, anio: trabajador.anio})
                      .then(afp => {  
                        // *** Poner catch para error de si no encuentra.
                        console.log("VER IMOIRTANTE AFO", this.json2array(afp.data)[0])
                      //.log(afp.data) 
                        console.log("RUT "+ trabajador.rut, this.json2array(afp.data)[trabajador.afp]) 
                        
                        let cesantia = trabajador.tipocontrato === 2 ? 0 : 0.006;
                        
                        var coficienteUniversal = 1 - ((this.json2array(afp.data)[trabajador.afp].comision/100) + 0.07 + cesantia)
                        
                        let coficienteAFPISAPRE = 1 - ((this.json2array(afp.data)[trabajador.afp].comision/100) + 0.07 )
                        
                        let tributable = (trabajador.liquido - (trabajador.movilizacion  + trabajador.colacion) );
                        
                        coficienteUniversal = coficienteAFPISAPRE + cesantia;
                        
                        let descuentosAfpIsapre = (tributable / coficienteUniversal) * (1-coficienteAFPISAPRE);
                        
                        let descuentosCesantia = (tributable / coficienteUniversal) * cesantia;

                        let totalImponible = tributable + descuentosCesantia + descuentosAfpIsapre;

                        this.impuestos = response.data;



                        this.desdeBaseDarLiquidoDefinito(totalImponible, coficienteAFPISAPRE, cesantia, tributable, coficienteAFPISAPRE+cesantia, (this.json2array(afp.data)[trabajador.afp].comision/100), 0.07, '', indice, this.json2array(afp.data)[trabajador.afp]); 


                     });




                    });
                },

                desdeBaseDarLiquidoDefinito(imponible_preliminar, coef_afpsalud, coef_cesantia, LiqPactado, coef_universal, afp, salud, parametros, indice, afpSeleccionadaObjeto){
                    //console.log("En por desdeBaseDarLiquidoDefinito", this.impuestos)

                  if(this.impuestos[0].desde > imponible_preliminar)   return this.porFormula((0.07),afp,coef_cesantia, 0, 0, LiqPactado, coef_afpsalud, parametros, coef_universal, indice, afpSeleccionadaObjeto);

                  this.impuestos.forEach(value => {
                    if(imponible_preliminar > value.desde && imponible_preliminar < value.hasta){


                      return this.porFormula((0.07),afp,coef_cesantia, value.factor, value.cantidadRebajar, LiqPactado, coef_afpsalud, parametros, coef_universal, indice, afpSeleccionadaObjeto);

                    }

                  });

                   
              
                }, // Fin desdebasedarliquidodefinito
                porFormula(salud, afp, cesantiaFactor,factor, descontar, liquido, coefAFPISAPRE, Parametros, coef_universal, indice, afpSeleccionadaObjeto){
                 
                  let limiteAFPSALUD = 2242147;
                  let limiteCesantia = 3366052;
                  let parteArriba = liquido - descontar;
                  let parteAbajo = (1 - (salud + afp + cesantiaFactor + factor)) + (factor*afp) + (factor*salud) + (factor * cesantiaFactor);
                  let sueldo = parteArriba / parteAbajo;

                  if(sueldo > limiteCesantia){
                    // Listo..!!
                    let tImponible_superior_lim_cesantia = (((liquido - (factor*limiteAFPSALUD*afp) - (factor*limiteAFPSALUD*salud)-(factor*limiteCesantia*cesantiaFactor))-descontar + (limiteAFPSALUD*afp) + (limiteAFPSALUD*salud)+(limiteCesantia*cesantiaFactor))/     ( 1-factor))

                    this.armarSueldoDesdeImponible(tImponible_superior_lim_cesantia, limiteAFPSALUD*afp, limiteAFPSALUD*salud, limiteCesantia*cesantiaFactor ,factor, descontar, indice, afpSeleccionadaObjeto)
                  
                  }else if(sueldo < limiteAFPSALUD){
                      
                      let descuentos = (sueldo*salud) + (afp*sueldo) + (cesantiaFactor*sueldo);
                      let liquido_calculado_ = sueldo - descuentos - ( ( (sueldo-descuentos)*factor) - descontar  );
                      //console.log("Liquido Calculado ", liquido_calculado_);
                      this.armarSueldoDesdeImponible(sueldo, (afp*sueldo), (sueldo*salud), (cesantiaFactor*sueldo) ,factor, descontar, indice, afpSeleccionadaObjeto);

                  }else if(sueldo > limiteAFPSALUD && sueldo < limiteCesantia){

                    let parteArriba_entrerangos = liquido-descontar+(limiteAFPSALUD*salud)+(limiteAFPSALUD*afp)-(limiteAFPSALUD*factor*afp)-(limiteAFPSALUD*factor*salud);

                    let parteAbajo_entrerangos= 1-cesantiaFactor - factor +( factor*cesantiaFactor);

                    let sueldoEntreRangos = parteArriba_entrerangos / parteAbajo_entrerangos;

                     this.armarSueldoDesdeImponible(sueldoEntreRangos, (limiteAFPSALUD*afp), (limiteAFPSALUD*salud), (cesantiaFactor*sueldoEntreRangos) ,factor, descontar, indice, afpSeleccionadaObjeto)
                  }

                },  // Fin porFormula
                armarSueldoDesdeImponible(imponible, montoAfp, montoIsapre, montoCesantia, factor, descontar, indice, afpSeleccionadaObjeto){
                  console.log("EL IMPONIBLE ES.... ", imponible)
                   if( (imponible/1.25) * 0.25 > 119146){
                      this.datosTrabajador[indice].sueldoBase = imponible - 119146;
                      this.datosTrabajador[indice].montoGratificacionLegal = 119146;
                    }else{
                      this.datosTrabajador[indice].sueldoBase = imponible /1.25;
                      this.datosTrabajador[indice].montoGratificacionLegal = imponible * 0.25;

                    }

                  this.datosTrabajador[indice].objetoAfp = afpSeleccionadaObjeto;
                  this.datosTrabajador[indice].imponible = imponible;
                  this.datosTrabajador[indice].MontoAfp = montoAfp;
                  this.datosTrabajador[indice].MontoIsapre = montoIsapre;
                  this.datosTrabajador[indice].MontoCesantia = montoCesantia;
                  this.datosTrabajador[indice].impuesto = ((imponible - (montoAfp + montoCesantia + montoIsapre)) * factor) - descontar
                  this.datosTrabajador[indice].liquido = imponible+this.datosTrabajador[indice].colacion + this.datosTrabajador[indice].movilizacion - (montoAfp + montoCesantia + montoIsapre + this.datosTrabajador[indice].impuesto)                  
                  console.log("sueldoCalculado", this.datosTrabajador)
                }
                
        }
    }
</script>


<style>




    table{
      overflow: auto;
      font-size: .8em;
    }


</style>