<template>
  <div class="container">
    <div class="card">
  <div class="card-body">

    <div class="row mb-5">
        
        <div class="col-12 text-center">
            <h2 class="titulo mb-4">
                Calcular sueldo liquido
            </h2>
        </div>

        <div class="col-12">
          <p class="text-muted subtitulo">
           Ingresa el sueldo base de tu trabajador, elige si su gratificacion legal se paga de forma anual o mensual. Luego asigna movilizacion y colación si corresponde. Posteriormente elige la afp y salud de tu trabajador. Si usa isapre, agrega el pago del fun. 
          </p>
        </div>

    </div>

    <div class="row ">
        <div class="col-12 col-md-6 columna-derecha">
          <form>



                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Selecciona Mes</label>
                        <select  @change="EleccionMes()"    v-model="mes" class="form-control" id="exampleFormControlSelect1">
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
                        <select  @change="EleccionAnio()"  v-model="anio" class="form-control" id="Anio">
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
                <label for="SueldooLiqPactado">Sueldo Base</label>
                <input  v-model="sueldoBase" type="number" class="form-control" aria-describedby="sueldoAyuda">
                <small id="sueldoAyuda" class="form-text text-muted">Escribe el sueldo base</small>
              </div>


              <div class="form-group">
                <label for="diasTrabajados">Días Trabajados</label>
                <input max="30" min="0" v-model="diasTrabajados" type="number" class="form-control" aria-describedby="diasTrabajados">
                <small id="diasTrabajados" class="form-text text-muted">Días trabajados sobre la base de 30</small>
              </div>

               <div class="form-group">
                <label for="movilizacion">Movilización</label>
                <input v-model="movilizacion" type="number" class="form-control" aria-describedby="movilizacion">
                <small id="movilizacion" class="form-text text-muted">Asignación de movilización.</small>
              </div>

               <div class="form-group">
                <label for="colacion">Colacion</label>
                <input v-model="colacion" type="number" class="form-control" aria-describedby="colacion">
                <small id="colacion" class="form-text text-muted">Asignación de colación.</small>
              </div>              


               <div class="form-group">
                <label for="bonos">Bonos</label>
                <input v-model="bonos" type="number" class="form-control" aria-describedby="bonos">
                <small id="bonos" class="form-text text-muted">Cantidad a pagar en bonos imponibles.</small>
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
                
                  <option v-for="item in AFPS" :value="[item.comision, item.nombre_afp]">{{ item.nombre_afp }} - Comision {{item.comision}} </option>

                </select>
              </div>   

              <div class="form-group">
                <label for="Contrato">Contrato</label>
                <select  v-model="TipoContrato" class="form-control" id="Contrato">
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
                <select v-model="Tramocargas" class="form-control" id="Tramo">
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
                <button style="background-color: #dd6b4d; border: solid 0; min-width: 10em;" v-on:click="clikeando" class="btn btn-primary">Calcular sueldo líquido</button>
              </div>

          <div  v-if="!booleanoHayDatos"  class="alert alert-danger" role="alert">
            Para el mes {{mes}} en el año {{anio}} no hay datos disponibles. Intenta otra fecha.
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
      props:['parametros', 'afp', 'usuario'],
        mounted() {
          // Replicar acá: 
          this.actualizar_fecha()
          console.log(this.usuario);
          console.log(new Date().getFullYear())
        },
        data(){
            return{
                booleanoHayDatos: true,
                TipoContrato: 2,
                totalNoImponible:0,
                sueldoLiquidoPactado: 0,
                sueldoBase: 0,
                movilizacion: 0,
                colacion: 0,
                cargas: 0,
                Tramocargas: 0,
                gratificacionLegal: 1,
                SaludSeleccionada:'Fonasa',
                PrevisionSeleccionada:[],
                fun: 0,
                Parametros: JSON.parse(this.parametros)[0],
                AFPS: this.json2array(JSON.parse(this.afp)),
                sueldoBase:0,
                montoGratificacionLegal:0,
                impuestos: [],
                sueldoCalculado:{},
                liquidacion_terminada: false,
                bonos:0,
                mes: new Date().getMonth()+1,
                anio: new Date().getFullYear(),
                montoPorCargas:0,
                diasTrabajados:30 
            }
        },  
        methods: {
            
                clikeando(e){
                    
                    e.preventDefault()
                    console.log(new Date().getMonth());
                    if(this.diasTrabajados < 0 || this.diasTrabajados > 30) return this.mensajeErrorFuncion('Los días trabajados deben estar entre 0 y 30');

                    axios
                    .post('api/ImpuestosDelMes', {mes: this.mes, anio: this.anio }, { crossdomain: true })
                    .then(response => {

                        this.impuestos = response.data;
                        this.porFormula();
                        this.booleanoHayDatos = true;

                    })
                    .catch( (e) => {
                      
                      console.log("Otro Error", e);
                      
                      this.booleanoHayDatos = false;

                    } );                    

                },
                mensajeErrorFuncion(mensaje){
                  this.$swal({
                              icon: 'error',
                              title: 'Oops...',
                              text: mensaje,
                            });
                },
                actualizar_fecha(){

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
                  console.log("montoPorCargas", montoPorCargas);
                  this.montoPorCargas = montoPorCargas;
                  return montoPorCargas;
                },
                eleccionSalud(e){

                },
                eleccionPrevision(){

                },
                EleccionMes(){
                  this.actualizar_fecha();
                },
                EleccionAnio(){
                  this.actualizar_fecha();
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
                porFormula(){
                  
                  let imponible = ((this.sueldoBase*1) + (this.bonos*1))*1;

                  if(this.gratificacionLegal === 1 ){
                      if( imponible * 0.25 > 119146){
                        this.sueldoCalculado.sueldoBase = imponible;
                        this.sueldoCalculado.montoGratificacionLegal = 119146;
                      }else{
                        this.sueldoCalculado.sueldoBase = imponible;
                        this.sueldoCalculado.montoGratificacionLegal = imponible * 0.25;
                      }
                  }else{
                      this.sueldoCalculado.sueldoBase = imponible;
                      this.sueldoCalculado.montoGratificacionLegal = 0;
                  }
                  

                  imponible = this.sueldoCalculado.sueldoBase + this.sueldoCalculado.montoGratificacionLegal;
                  


                  this.totalNoImponible = (this.colacion*1) + (this.movilizacion*1);

                  let Coefcesantia = this.TipoContrato == 2 ? 0 : 0.006;
                        
                  var coficienteUniversal = 1 - ((this.PrevisionSeleccionada[0]/100) + 0.07 + Coefcesantia)
                        
                  let coficienteAFPISAPRE = 1 - ((this.PrevisionSeleccionada[0]/100) + 0.07 )

                  let coficienteAFP = this.PrevisionSeleccionada[0]/100;

                  let limiteAFPSALUD = 2242147;
                  
                  let limiteCesantia = 3366052;

                  console.log("imponible > limiteAFPSALUD", imponible > limiteAFPSALUD)

                  console.log("imponible", imponible)

                  console.log("limiteAFPSALUD", limiteAFPSALUD)

                  let montoAfp = ( imponible > limiteAFPSALUD) ? limiteAFPSALUD * coficienteAFP : coficienteAFP * imponible;

                  let montoIsapre = (  imponible > limiteAFPSALUD) ? limiteAFPSALUD *  0.07 : 0.07 * imponible;
                  
                  let montoCesantia = (  imponible > limiteCesantia) ? limiteCesantia *  Coefcesantia : Coefcesantia * imponible;

                  let tributable = imponible - (montoCesantia + montoAfp + montoIsapre);
                  this.liquidacion_terminada = true;
                  console.log("tributable", tributable)

                  console.log(this.impuestos)

                  if(this.impuestos[0].desde > tributable) return this.armarSueldoDesdeImponible(imponible, montoAfp, montoIsapre, montoCesantia, 0, 0);

                  
                  for (var i = 0; i < this.impuestos.length; i++) {
                    
                    if(tributable > this.impuestos[i].desde && tributable < this.impuestos[i].hasta){
                      
                      console.log("tributable > this.impuestos[i].desde", + tributable > this.impuestos[i].desde + " " + this.impuestos[i].desde)
                      console.log("tributable < this.impuestos[i].hasta", + tributable < this.impuestos[i].hasta + " " + this.impuestos[i].hasta)
                      
                      setTimeout( ()=> {
                      return this.armarSueldoDesdeImponible(imponible, montoAfp, montoIsapre, montoCesantia, this.impuestos[i].factor, this.impuestos[i].cantidadRebajar);


                      }, 1000 )
                      
                    break;
                    }
                  }

                

                  this.armarSueldoDesdeImponible()

                },  // Fin porFormula
                armarSueldoDesdeImponible(imponible, montoAfp, montoIsapre, montoCesantia, factor, descontar){
                  this.sueldoCalculado = null;
                  console.log("this.Parametros.UF * this.fun", this.Parametros.UF * this.fun )
                  
                  if(this.fun > 0){
                    this.sueldoCalculado.adicionalIsapre = Math.abs(this.Parametros.UF * this.fun -  montoIsapre)
                  }else{
                    this.sueldoCalculado.adicionalIsapre = 0;
                  }
                  this.sueldoCalculado.salud_nombre = this.SaludSeleccionada;
                  this.sueldoCalculado.cargas = this.cargas;
                  this.sueldoCalculado.nombre_afp = this.PrevisionSeleccionada[1];                  
                  this.sueldoCalculado.noImponible = (this.asignarCargas()*1) + (this.totalNoImponible * 1);
                  this.sueldoCalculado.imponible = (imponible/30) * this.diasTrabajados;

                  if(this.diasTrabajados < 25){
                  this.sueldoCalculado.MontoPorCargas = (this.asignarCargas()/30) * this.diasTrabajados;

                }else{
                  this.sueldoCalculado.MontoPorCargas = this.asignarCargas();

                }
                  this.sueldoCalculado.MontoAfp = montoAfp;
                  this.sueldoCalculado.MontoIsapre = montoIsapre;
                  this.sueldoCalculado.MontoCesantia = montoCesantia;
                  this.sueldoCalculado.impuesto = ((imponible - (montoAfp + montoCesantia + montoIsapre)) * factor) - descontar
                  this.sueldoCalculado.liquido = (imponible + this.sueldoCalculado.noImponible) - (montoAfp + montoCesantia + montoIsapre + this.sueldoCalculado.impuesto +this.sueldoCalculado.adicionalIsapre );                  
                  
                  this.sueldoCalculado.montoTributable=(imponible - (montoAfp + montoCesantia + montoIsapre));
                  this.sueldoCalculado.totalHaberes = imponible + this.sueldoCalculado.noImponible;
                  this.sueldoCalculado.totalDescuentos = (montoAfp + montoCesantia + montoIsapre+this.sueldoCalculado.impuesto+this.sueldoCalculado.adicionalIsapre)

                  this.sueldoCalculado.colacion = (this.colacion/30) * this.diasTrabajados
                  this.sueldoCalculado.movilizacion = (this.movilizacion/30) * this.diasTrabajados
                  this.sueldoCalculado.bonos = (this.bonos/30) * this.diasTrabajados;
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
                      user_id: 1,
                      invitado: true
                    })
                    .then(response => {

                      this.sueldoCalculado._idPdf = response.data.id;

                      setTimeout(( )=> {
                          this.$refs.metodoDentroDelComponente.verValor();
                      }, 500  );
      

                    });


                }
        },
        watch:{

          TipoContrato: function(previo, nuevo){
            this.TipoContrato = nuevo;
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
        color: #183661;
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