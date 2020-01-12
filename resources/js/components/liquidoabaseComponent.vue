<template>
  <div class="container">
    <div class="card">
  <div class="card-body">

    <div class="row mb-5">
        
        <div class="col-12 text-center">
            <h2 class="titulo mb-4">
                Obtén tu sueldo base desde el sueldo líquido
            </h2>
        </div>

        <div class="col-12">
          <p class="text-muted subtitulo">
            Desde este formulario podrás llegar al sueldo base que tendría un sueldo líquido dado. Debes ingresar correctamente los datos previsionales de tu trabajador. Debes considerar que la asignación de movilización y colación son haberes no imponibles. 
          </p>
        </div>

    </div>

    <div class="row ">
        <div class="col-12 col-md-6 columna-derecha">
          <form>
              <div class="form-group">
                <label for="SueldooLiqPactado">Sueldo Liquido</label>
                <input v-model="sueldoLiquidoPactado" type="number" class="form-control" aria-describedby="sueldoAyuda">
                <small id="sueldoAyuda" class="form-text text-muted">Escribe el sueldo líquido pactado {{ sueldoLiquidoPactado }}</small>
              </div>

               <div class="form-group">
                <label for="totalNoImponibleLabel">Total no imponible</label>
                <input v-model="totalNoImponible" type="number" class="form-control" aria-describedby="TotalNoImponible">
                <small id="totalNoImponible" class="form-text text-muted">Total no imponible como movilizacion, colacion o viaticos.</small>
              </div>
  

              <div class="form-group">
                <label for="Salud_Input">Salud</label>
                <select @change="eleccionSalud()" class="form-control" id="Salud_Input" v-model="SaludSeleccionada">
                  <option value="Fonasa">Fonasa</option>
                  <option value="banmedica">Isapre Banmédica</option>
                  <option value="cruzBlanca">Isapre Cruz Blanca</option>
                  <option value="colmena">Isapre Colmena</option>
                  <option value="MasVida">Isapre Mas vida</option>
                </select>
              </div>

             <div v-if="SaludSeleccionada != 'Fonasa'" class="form-group">
                <label for="fun">Monto Pactado UF: </label>
                <input v-model="fun" type="number" class="form-control" aria-describedby="fun">
                <small id="fun" class="form-text text-muted">Monto pactado en UF</small>
              </div>

              <div class="form-group">
                <label for="AFP_Input">AFP</label>
                <select  @change="eleccionPrevision()"  class="form-control" id="AFP_Input"  v-model="PrevisionSeleccionada">
                
                  <option v-for="item in AFPS" :value="item.comision">{{ item.nombre_afp }}</option>

                </select>
              </div>   

              <div class="form-group">
                <label for="Contrato">Contrato</label>
                <select v-model="TipoContrato" class="form-control" id="Contrato">
                  <option value="1">Indefinido</option>
                  <option value="2">Plazo Fijo</option>
                </select>
              </div>   

              <div class="form-group">
                <label for="NumeroCargas">Cargas</label>
                <input v-model="cargas" type="number" name="NumeroCargas" class="form-control">
              </div>  

              <div class="form-group">
                <label for="Tramo">Tramo Cargas</label>
                <select class="form-control" id="Tramo">
                  <option tramo="1">Tramo 1</option>
                  <option tramo="2">Tramo 2</option>
                  <option tramo="3">Tramo 3</option>
                </select>
               <small id="tramoAyuda" class="form-text text-muted">Si no tiene cargas, no consideres éste campo</small>
              </div>    

              <div class="form-group mb-5">
                <label for="GratificacionLegal">Gratificación Legal</label>
                <select v-model="gratificacionLegal" class="form-control" id="GratificacionLegal">
                  <option value="1">Mensual</option>
                  <option value="2">Anual</option>
                </select>
              </div>                             
        
              <div class="ultimo-form-group" style="text-align: center; margin-bottom: 3em;"> 
                <button style="background-color: #dd6b4d; border: solid 0; width: 10em;" v-on:click="clikeando" class="btn btn-primary">Calcular</button>
              </div>
            </form>  
        </div>
        

        <div  v-if="liquidacion_terminada"  class="col-12 col-md-6">
          <liquidacion-plana v-bind:liquidacion.sync="sueldoCalculado" ref="metodoDentroDelComponente" ></liquidacion-plana>
        </div>
    </div>


       </div>
    </div>
  </div>
</template>

<script>
    export default {
      props:['parametros', 'afp'],
        mounted() {
        },
        data(){
            return{
                TipoContrato: 2,
                totalNoImponible:0,
                sueldoLiquidoPactado: 0,
                cargas: 0,
                gratificacionLegal: 1,
                SaludSeleccionada:'Fonasa',
                PrevisionSeleccionada:0,
                fun: 0,
                Parametros: JSON.parse(this.parametros)[0],
                AFPS: this.json2array(JSON.parse(this.afp)),
                sueldoBase:0,
                montoGratificacionLegal:0,
                impuestos: [],
                sueldoCalculado:{},
                liquidacion_terminada: false
            }
        },  
        methods: {
            
                clikeando(e){
                    
                    e.preventDefault()
                    /*
                    if( (totalImponible/1.25) * 0.25 > 119146){
                      this.sueldoBase = totalImponible - 119146;
                      this.montoGratificacionLegal = 119146;
                    }else{
                      this.sueldoBase = totalImponible /1.25;
                      this.montoGratificacionLegal = totalImponible * 0.25;

                    }*/

                    axios
                    .post('api/ImpuestosDelMes', {mes:1, anio:2020}, { crossdomain: true })
                    .then(response => {

                        let cesantia = this.TipoContrato === 2 ? 0 : 0.006;
                        
                        var coficienteUniversal = 1 - ((this.PrevisionSeleccionada/100) + 0.07 + cesantia)
                        
                        let coficienteAFPISAPRE = 1 - ((this.PrevisionSeleccionada/100) + 0.07 )
                        
                        let tributable = (this.sueldoLiquidoPactado - this.totalNoImponible );
                        
                        coficienteUniversal = coficienteAFPISAPRE + cesantia;
                        
                        let descuentosAfpIsapre = (tributable / coficienteUniversal) * (1-coficienteAFPISAPRE);
                        
                        let descuentosCesantia = (tributable / coficienteUniversal) * cesantia;

                        let totalImponible = tributable + descuentosCesantia + descuentosAfpIsapre;

                        this.impuestos = response.data;

                        this.desdeBaseDarLiquidoDefinito(totalImponible, coficienteAFPISAPRE, cesantia, this.sueldoLiquidoPactado, coficienteAFPISAPRE+cesantia, (this.PrevisionSeleccionada/100), 0.07, this.Parametros);

                    });

                },
                eleccionSalud(e){

                },
                eleccionPrevision(){

                },
                json2array(json){
                      var result = [];
                      Object.entries(json).forEach(([key, value]) => {                            
                               /*let rObj = {}
                               rObj[key] = value;
                               result.push(rObj) */
                               result.push({
                                nombre_afp: key,
                                comision: value
                               })
                                                       
                      });

                      return result;
                },
                desdeBaseDarLiquidoDefinito(imponible_preliminar, coef_afpsalud, coef_cesantia, LiqPactado, coef_universal, afp, salud, parametros){
                  if(this.impuestos[0].desde > imponible_preliminar)   return this.porFormula((0.07),afp,coef_cesantia, 0, 0, LiqPactado, coef_afpsalud, parametros, coef_universal );

                  this.impuestos.forEach(value => {
              
                    if(imponible_preliminar > value.desde && imponible_preliminar < value.hasta){
                      
                      this.porFormula((0.07), (this.PrevisionSeleccionada/100),coef_cesantia, value.factor, value.cantidadRebajar, LiqPactado, coef_afpsalud, parametros, coef_universal);

                    }

                  })
              
                }, // Fin desdebasedarliquidodefinito
                gradienteAscedenteSueldo(imponible_preliminar, coef_afpsalud, coef_cesantia, LiqPactado, impuesto){
                      let descuentos_afpsalud = imponible_preliminar *(1-coef_afpsalud);
                      let descuentos_cesantia = imponible_preliminar *(coef_cesantia);
                      let tributable = imponible_preliminar - (descuentos_cesantia + descuentos_afpsalud);
                      let impuesto_a_rebajar =((tributable * impuesto.factor) - impuesto.cantidadRebajar);
                      let liquido_calculado = tributable - impuesto_a_rebajar;
                      return liquido_calculado;
                },
                porFormula(salud, afp, cesantiaFactor,factor, descontar, liquido, coefAFPISAPRE, Parametros, coef_universal){
                 
                  let limiteAFPSALUD = 2242147;
                  let limiteCesantia = 3366052;
                  let parteArriba = liquido - descontar;
                  let parteAbajo = 1 - salud - afp - cesantiaFactor - factor + (factor*afp) + (factor*salud) + (factor * cesantiaFactor);
                  let sueldo = parteArriba / parteAbajo;

                  if(sueldo > limiteCesantia){
                    // Listo..!!
                    let tImponible_superior_lim_cesantia = (((liquido - (factor*limiteAFPSALUD*afp) - (factor*limiteAFPSALUD*salud)-(factor*limiteCesantia*cesantiaFactor))-descontar + (limiteAFPSALUD*afp) + (limiteAFPSALUD*salud)+(limiteCesantia*cesantiaFactor))/     ( 1-factor))

                    this.armarSueldoDesdeImponible(tImponible_superior_lim_cesantia, limiteAFPSALUD*afp, limiteAFPSALUD*salud, limiteCesantia*cesantiaFactor ,factor, descontar)
                  
                  }else if(sueldo < limiteAFPSALUD){
                      
                      let descuentos = (sueldo*salud) + (afp*sueldo) + (cesantiaFactor*sueldo);
                      let liquido_calculado_ = sueldo - descuentos - ( ( (sueldo-descuentos)*factor) - descontar  );
                      console.log("Liquido Calculado ", liquido_calculado_);
                      this.armarSueldoDesdeImponible(sueldo, (afp*sueldo), (sueldo*salud), (cesantiaFactor*sueldo) ,factor, descontar);

                  }else if(sueldo > limiteAFPSALUD && sueldo < limiteCesantia){

                    let parteArriba_entrerangos = liquido-descontar+(limiteAFPSALUD*salud)+(limiteAFPSALUD*afp)-(limiteAFPSALUD*factor*afp)-(limiteAFPSALUD*factor*salud);

                    let parteAbajo_entrerangos= 1-cesantiaFactor - factor +( factor*cesantiaFactor);

                    let sueldoEntreRangos = parteArriba_entrerangos / parteAbajo_entrerangos;

                     this.armarSueldoDesdeImponible(sueldoEntreRangos, (limiteAFPSALUD*afp), (limiteAFPSALUD*salud), (cesantiaFactor*sueldoEntreRangos) ,factor, descontar)
                  }

                },  // Fin porFormula
                armarSueldoDesdeImponible(imponible, montoAfp, montoIsapre, montoCesantia, factor, descontar){

                    if( (imponible/1.25) * 0.25 > 119146){
                      this.sueldoCalculado.sueldoBase = imponible - 119146;
                      this.sueldoCalculado.montoGratificacionLegal = 119146;
                    }else{
                      this.sueldoCalculado.sueldoBase = imponible /1.25;
                      this.sueldoCalculado.montoGratificacionLegal = imponible * 0.25;

                    }
                  
                  this.sueldoCalculado.noImponible = this.totalNoImponible * 1;
                  this.sueldoCalculado.imponible = imponible;
                  this.sueldoCalculado.MontoAfp = montoAfp;
                  this.sueldoCalculado.MontoIsapre = montoIsapre;
                  this.sueldoCalculado.MontoCesantia = montoCesantia;
                  this.sueldoCalculado.impuesto = ((imponible - (montoAfp + montoCesantia + montoIsapre)) * factor) - descontar
                  this.sueldoCalculado.liquido = imponible - (montoAfp + montoCesantia + montoIsapre + this.sueldoCalculado.impuesto)                  
                  console.log("sueldoCalculado", this.sueldoCalculado);
                  this.liquidacion_terminada = true;
                  setTimeout(( )=> {
                    this.$refs.metodoDentroDelComponente.verValor();
                  }, 500  )

                }
        }
    }
</script>


<style>

    body{
      background-color: #dae1e7;
    }

    .titulo{
        font-family: 'Roboto', monospace;
        font-weight: 800;
    }

    .subtitulo{
      font-family: 'Roboto Mono', monospace;
    }

  .card{
    border-radius: .9em;
  }

 @media (max-width: 575.98px) { 
  
    .columna-derecha{
      border-bottom: solid 1px hsla(0, 100%, 0%, 0.1);
    }


  } /* Fin media breakpoint dispositivos chicos */


@media (min-width: 992px) {
  .columna-derecha{
    border-right: solid 1px hsla(0, 100%, 0%, 0.1);
  }


 } /* Fin media breakpoint dispositivos medianos */




</style>