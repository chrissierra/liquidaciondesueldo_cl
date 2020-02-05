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

          <p class="text-muted subtitulo">
           Este formulario deberás utilizarlo como base para armar el sueldo base. No es recomendable usarlo para generar una liquidación
           real y válida. Es cierto que se pactan sueldos líquidos y sobre eso se podría generar el base y los demás elementos de la liquidación, sin embargo no es lo que debe hacerse. Por ese motivo sólo podrás generar una liquidación en PDF desde un sueldo base a un sueldo líquido. 
          </p>
        </div>

    </div>

    <div class="row ">
        <div class="col-12 col-md-6 columna-derecha">
          <form>

                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Selecciona Mes</label>
                        <select  @change="EleccionMes()"  v-model="mes" class="form-control" id="exampleFormControlSelect1">
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                          <option>6</option>
                          <option>7</option>
                          <option>8</option>
                          <option>9</option>
                          <option>10</option>
                          <option>11</option>
                          <option>12</option>
                        </select>
                      </div>


                    <div class="form-group">
                        <label for="Anio">Selecciona Año</label>
                        <select   @change="EleccionAnio()"  v-model="anio" class="form-control" id="Anio">
                          <option>2019</option>
                          <option>2020</option>
                          <option>2021</option>
                          <option>2022</option>
                          <option>2023</option>
                          <option>2024</option>
                          <option>2025</option>
                        </select>
                      </div>


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
                <select class="form-control" id="AFP_Input"  v-model="PrevisionSeleccionada">
                
                  <option v-for="item in AFPS" :value="[item.comision, item.nombre_afp]">{{ item.nombre_afp }} - Comision {{item.comision}}</option>

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
                <label for="Tramocargas">Tramo Cargas</label>
                <select v-model="Tramocargas"  class="form-control" id="Tramo">
                  <option value="0">Sin Cargas</option>
                  <option value="1">Tramo 1</option>
                  <option value="2">Tramo 2</option>
                  <option value="3">Tramo 3</option>
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

          <div  v-if="!booleanoHayDatos"  class="alert alert-danger" role="alert">
            Para el mes {{mes}} en el año {{anio}} no hay datos disponibles. Intenta otra fecha.
          </div>


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
      props:['parametros', 'afp', 'usuario'],
        mounted() {                  
          this.actualizar_fecha();
          this.mensajeLiquidoAbase();
        },
        data(){
            return{
                booleanoHayDatos: true,
                TipoContrato: 2,
                totalNoImponible:0,
                sueldoLiquidoPactado: 0,
                cargas: 0,
                Tramocargas: 0,
                gratificacionLegal: 1,
                SaludSeleccionada:'Fonasa',
                PrevisionSeleccionada:[],
                fun: 0,
                Parametros: '',
                AFPS: '',
                sueldoBase:0,
                montoGratificacionLegal:0,
                impuestos: [],
                sueldoCalculado:{},
                liquidacion_terminada: false,
                montoPorCargas: 0,
                mes: new Date().getMonth()+1,
                anio: new Date().getFullYear()                 
            }
        },  
        methods: {
                mensajeLiquidoAbase(){
                  this.$swal({
                              icon: 'info',
                              title: 'ATENCIÓN',
                              text: 'Este formulario deberás utilizarlo como base para armar el sueldo base. No es recomendable usarlo para generar una liquidación real y válida. Por ese motivo sólo podrás generar una liquidación en PDF desde un sueldo base a un sueldo líquido. ',
                            });
                },
                clikeando(e){
                    
                    e.preventDefault();
                    let respaldo_mes = this.mes;
                    let respaldo_anio = this.anio;
                    axios
                    .post('api/ImpuestosDelMes', {mes:this.mes, anio:this.anio}, { crossdomain: true })
                    .then(response => {

                        let cesantia = this.TipoContrato == 2 ? 0 : 0.006;
                        
                        var coficienteUniversal = 1 - ((this.PrevisionSeleccionada[0]/100) + 0.07 )
                        
                        let coficienteAFPISAPRE = 1 - ((this.PrevisionSeleccionada[0]/100) + 0.07 )

                        let coef_afp = 1 - ((this.PrevisionSeleccionada[0]/100) )
                        
                        let coef_isapre = 1 - ( 0.07 )
                        
                        let tributable = (this.sueldoLiquidoPactado - this.totalNoImponible );
                        
                        coficienteUniversal = coficienteAFPISAPRE + cesantia;
                        
                        let descuentosAfpIsapre = (tributable / coficienteUniversal) * (1-coficienteAFPISAPRE);

                        let descuento_afp = (tributable / coficienteUniversal) * (1-coef_afp);
                        
                        let descuentosIsapre = (tributable / coficienteUniversal) * (1-coef_isapre);

                        let descuentosCesantia = (tributable / coficienteUniversal) * cesantia;

                        this.analizarSiFun(descuentosIsapre);

                        let totalImponible = tributable + this.diferencia_salud;

                        this.impuestos = response.data;

                        this.desdeBaseDarLiquidoDefinito((totalImponible - this.totalNoImponible), coficienteAFPISAPRE, cesantia, this.sueldoLiquidoPactado, coficienteAFPISAPRE+cesantia, (this.PrevisionSeleccionada[0]/100), 0.07, this.Parametros);

                        this.booleanoHayDatos = true;

                    })
                    .catch( (e) => {
                      
                      console.log("Otro Error", e);

                      this.booleanoHayDatos = false;

                    } )

                },
                EleccionMes(){
                  this.actualizar_fecha();
                },
                EleccionAnio(){
                  this.actualizar_fecha();
                },
                analizarSiFun(descuentosIsapre_en_funcion){
                  let limiteAFPSALUD = 2272728;
                  let limiteCesantia = 3409091;
                  if(limiteAFPSALUD * 0.07 < descuentosIsapre_en_funcion ){
                    descuentosIsapre_en_funcion = limiteAFPSALUD * 0.07;
                  }
                  if( this.fun > 0 ){

                    let saludFun = parseFloat(this.Parametros.UF * this.fun);

                    if(saludFun > descuentosIsapre_en_funcion){
                      
                      this.MontoSaludDefinitivo = saludFun;

                      this.diferencia_salud = (Math.abs(saludFun - descuentosIsapre_en_funcion) * 1);
                      
                    }else{

                      this.MontoSaludDefinitivo = descuentosIsapre_en_funcion;
                  
                      this.diferencia_salud = 0;
                    }              

                  }else{
                    
                      this.MontoSaludDefinitivo = descuentosIsapre_en_funcion;
                  
                      this.diferencia_salud = 0;
                  }
                },
                actualizar_fecha(){

                            let mes = this.mes;
                            let anio = this.anio;
                            axios
                            .post('api/ParametrosPorMes', {mes: this.mes, anio: this.anio})
                            .then( response => {


                                this.Parametros = response.data[0];
                                this.booleanoHayDatos = true;
                            })
                            .catch( (err) => {

                              this.booleanoHayDatos = false;
                              console.log("Hubo un error", err);
                            } );


                            
                            axios
                            .post('api/AfpPorMes', {mes: this.mes, anio: this.anio})
                            .then( response => {
                                console.log(response.data)
                                this.AFPS = this.json2array(response.data);
                                this.booleanoHayDatos = true;
                            })
                            .catch( (err) => {

                              this.booleanoHayDatos = false;
                              console.log("Hubo un error", err);
                            } );
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
                asignarCargas(){
                  let montoPorCargas = 0;
                  console.log("this.Tramocargas", this.Tramocargas)
                  this.cargas= this.cargas*1;
                  console.log("this.cargas", this.cargas)
                  
                  if(this.Tramocargas == 1){
                    console.log("this.Parametros.AsignFamA ", this.Parametros.AsignFamA )
                    montoPorCargas = this.Parametros.AsigFamA * this.cargas;
                  }else if(this.Tramocargas == 2){
                    console.log("this.Parametros.AsignFamA ", this.Parametros.AsignFamB )
                    montoPorCargas = this.Parametros.AsigFamB * this.cargas;

                  }else if(this.Tramocargas == 3){
                    console.log("this.Parametros.AsignFamA ", this.Parametros.AsignFamC )
                    montoPorCargas = this.Parametros.AsigFamC * this.cargas;

                  }else{
                    montoPorCargas = 0;
                  }
                  console.log("montoPorCargas", montoPorCargas)
                  this.montoPorCargas = montoPorCargas;
                },
                desdeBaseDarLiquidoDefinito(imponible_preliminar, coef_afpsalud, coef_cesantia, LiqPactado, coef_universal, afp, salud, parametros ){
                  
                  let primer_liquido_simulado_por_tabla_imp = parseInt((this.impuestos[0].desde - (( this.impuestos[0].desde * this.impuestos[0].factor ) -  this.impuestos[0].cantidadRebajar)));

                  if(  primer_liquido_simulado_por_tabla_imp  > LiqPactado)   return this.porFormula((0.07) ,afp,coef_cesantia, 0, 0, LiqPactado, coef_afpsalud, parametros, coef_universal, );

                  


                  this.impuestos.forEach(value => {
              

                    let segundo_liquido_simulado_por_tabla_imp_uno = parseInt((value.desde - (( value.desde * value.factor ) -  value.cantidadRebajar)));

                    let segundo_liquido_simulado_por_tabla_imp_dos = parseInt((value.hasta - (( value.hasta * value.factor ) -  value.cantidadRebajar)));


                    if(LiqPactado > segundo_liquido_simulado_por_tabla_imp_uno && LiqPactado < segundo_liquido_simulado_por_tabla_imp_dos){
                      
                      this.porFormula((0.07), (this.PrevisionSeleccionada[0]/100),coef_cesantia, value.factor, value.cantidadRebajar, LiqPactado, coef_afpsalud, parametros, coef_universal);

                    }

                  })
              
                }, // Fin desdebasedarliquidodefinito
                porFormula(salud, afp, cesantiaFactor,factor, descontar, liquido, coefAFPISAPRE, Parametros, coef_universal){
                 
                  let limiteAFPSALUD = 2242147;
                  let limiteCesantia = 3366052;
                  liquido = liquido - this.totalNoImponible;

                  if( this.fun > 0 ){
                      let parteArriba = parseInt(liquido) + parseInt(this.MontoSaludDefinitivo)  - parseInt(descontar);
                      let parteAbajo = 1  - afp - cesantiaFactor - factor + (factor*afp) + (factor*salud) + (factor * cesantiaFactor);
                      let sueldo = parteArriba / parteAbajo;

                      if(sueldo > limiteCesantia){
                                // Listo..!!
                                let tImponible_superior_lim_cesantia = (((parseInt(liquido)+ parseInt(this.MontoSaludDefinitivo)  - (factor*limiteAFPSALUD*afp) - (factor*limiteAFPSALUD*salud)-(factor*limiteCesantia*cesantiaFactor))-descontar + (limiteAFPSALUD*afp) +(limiteCesantia*cesantiaFactor))/     ( 1-factor))

                                this.armarSueldoDesdeImponible(tImponible_superior_lim_cesantia, limiteAFPSALUD*afp, parseInt(limiteAFPSALUD*salud) , limiteCesantia*cesantiaFactor ,factor, descontar)
                              
                      }else if(sueldo < limiteAFPSALUD){
                                  
                                  //let descuentos = (sueldo*salud) + (afp*sueldo) + (cesantiaFactor*sueldo);
                                  //let liquido_calculado_ = sueldo - descuentos - ( ( (sueldo-descuentos)*factor) - descontar  );
                                  this.armarSueldoDesdeImponible(sueldo, (afp*sueldo), (sueldo*salud), (cesantiaFactor*sueldo) ,factor, descontar);

                      }else if(sueldo > limiteAFPSALUD && sueldo < limiteCesantia){

                                let parteArriba_entrerangos = liquido-descontar+ parseInt(this.MontoSaludDefinitivo) +(limiteAFPSALUD*afp)-(limiteAFPSALUD*factor*afp)-(limiteAFPSALUD*factor*salud);

                                let parteAbajo_entrerangos= 1-cesantiaFactor - factor +( factor*cesantiaFactor);

                                let sueldoEntreRangos = parteArriba_entrerangos / parteAbajo_entrerangos;

                                this.armarSueldoDesdeImponible(sueldoEntreRangos, (limiteAFPSALUD*afp), (limiteAFPSALUD*salud), (cesantiaFactor*sueldoEntreRangos) ,factor, descontar)
                      }










                  }else{
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
                                  this.armarSueldoDesdeImponible(sueldo, (afp*sueldo), (sueldo*salud), (cesantiaFactor*sueldo) ,factor, descontar);

                      }else if(sueldo > limiteAFPSALUD && sueldo < limiteCesantia){

                                let parteArriba_entrerangos = liquido-descontar+(limiteAFPSALUD*salud)+(limiteAFPSALUD*afp)-(limiteAFPSALUD*factor*afp)-(limiteAFPSALUD*factor*salud);

                                let parteAbajo_entrerangos= 1-cesantiaFactor - factor +( factor*cesantiaFactor);

                                let sueldoEntreRangos = parteArriba_entrerangos / parteAbajo_entrerangos;

                                this.armarSueldoDesdeImponible(sueldoEntreRangos, (limiteAFPSALUD*afp), (limiteAFPSALUD*salud), (cesantiaFactor*sueldoEntreRangos) ,factor, descontar)
                      }
                  }

                  
                  






                },  // Fin porFormula
                armarSueldoDesdeImponible(imponible, montoAfp, montoIsapre, montoCesantia, factor, descontar){
                  this.asignarCargas();
                  if( (imponible/1.25) * 0.25 > 119146){
                      this.sueldoCalculado.sueldoBase = imponible - 119146;
                      this.sueldoCalculado.montoGratificacionLegal = 119146;
                  }else{
                      this.sueldoCalculado.sueldoBase = imponible /1.25;
                      this.sueldoCalculado.montoGratificacionLegal = imponible * 0.25;
                  }

                  if(this.fun > 0){
                    this.sueldoCalculado.adicionalIsapre = Math.abs(this.Parametros.UF * this.fun -  montoIsapre)
                  }else{
                    this.sueldoCalculado.adicionalIsapre = 0;
                  }
                  this.sueldoCalculado.salud_nombre = this.SaludSeleccionada;
                  this.sueldoCalculado.cargas = this.cargas;
                  this.sueldoCalculado.nombre_afp = this.PrevisionSeleccionada[1];
                  this.sueldoCalculado.noImponible = (this.montoPorCargas*1) + (this.totalNoImponible * 1);
                  this.sueldoCalculado.imponible = imponible;
                  this.sueldoCalculado.MontoAfp = montoAfp;
                  this.sueldoCalculado.MontoIsapre = parseInt(this.MontoSaludDefinitivo);
                  this.sueldoCalculado.MontoCesantia = montoCesantia;
                  this.sueldoCalculado.MontoPorCargas = this.montoPorCargas;
                  this.sueldoCalculado.impuesto = ((imponible - (montoAfp + montoCesantia + montoIsapre)) * factor) - descontar
                  this.sueldoCalculado.liquido = ( parseInt(imponible) + parseInt(this.sueldoCalculado.noImponible) ) - (montoAfp + montoCesantia + parseInt(this.MontoSaludDefinitivo) + this.sueldoCalculado.impuesto)                  
                 
                   this.sueldoCalculado.montoTributable=(imponible - (montoAfp + montoCesantia + montoIsapre));
                   this.sueldoCalculado.totalHaberes = imponible + this.sueldoCalculado.noImponible;
                   this.sueldoCalculado.totalDescuentos = (montoAfp + montoCesantia + montoIsapre+this.sueldoCalculado.impuesto+this.sueldoCalculado.adicionalIsapre)
                  this.liquidacion_terminada = true;
                  this.sueldoCalculado.pdf = false;
                  //this.usuario = (this.usuario == 'invitado') ? 'invitado' : JSON.parse(this.usuario);
                  let usuario = (this.usuario == 'invitado') ? 'invitado' : JSON.parse(this.usuario);
                 
                  let user_id_ = (this.usuario == 'invitado') ? null : this.usuario.id;
                  let invitado_ = (this.usuario == 'invitado') ? true : false;
                  this.sueldoCalculado.usuario = usuario;
                  axios
                    .post('/ProcesarLiquidacionPdf', { 
                      objeto_liquidaciones: JSON.stringify(this.sueldoCalculado),
                      mes: this.mes,
                      anio: this.anio,
                      user_id: user_id_,
                      invitado: invitado_
                    })
                    .then(response => {
                      this.sueldoCalculado._idPdf = response.data.id;
                          setTimeout(( )=> {
                              this.$refs.metodoDentroDelComponente.verValor();
                          }, 500  );
      
                    });




                 // setTimeout(( )=> {
                 //   this.$refs.metodoDentroDelComponente.verValor();
                 // }, 500  )

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