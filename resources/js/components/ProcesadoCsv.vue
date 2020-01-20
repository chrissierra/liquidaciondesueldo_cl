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
                  <td >{{ trabajador.imponible  | aproximar(0) }} </td>
                  <td >{{ trabajador.mes }}</td>
                  <td >{{ trabajador.anio }}</td>
                  <td >{{ trabajador.objetoAfp.nombre_afp }}</td>
                  <td >{{ trabajador.MontoAfp  | aproximar(0) }} </td>
                  <td >{{ trabajador.MontoIsapre  | aproximar(0) }} </td>
                  <td >{{ trabajador.MontoCesantia | aproximar(0)  }}</td>
                  <td >{{ trabajador.impuesto | aproximar(0)  }}</td>
                  <td >{{ trabajador.colacion   }}</td>
                  <td >{{ trabajador.movilizacion   }}</td>
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
          console.log(this.parametros)
          console.log("thisParametros", this.Parametros);
          ////console.log(JSON.parse(this.datos)[0]);
          //this.Proceso1Sueldos()  

        },
        data(){
            return{
              datosTrabajador: JSON.parse(this.datos)[0],
              impuestos: [],
              visualizarBooleano: false,
              fun:0,
              Parametros: JSON.parse(this.parametros)[0],
              MontoSaludDefinitivo:0,
              diferencia_salud:0,
              totalNoImponible: 0,
              PrevisionSeleccionada:0,
              montoPorCargas:0
            }
        },  
        methods: {

                VisualizarResultado(){
                  this.visualizarBooleano = true;
                },               
                Proceso1Sueldos(){

                    this.datosTrabajador.forEach( (value, key) => {
                      
                      this.Proceso2Sueldos(value, key);

                    });

                    alert("Funciona....")

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

                Proceso2Sueldos(trabajador, indice_trabajador){

                    axios
                    .post('./api/ImpuestosDelMes', {mes:trabajador.mes, anio:trabajador.anio}, { crossdomain: true })
                    .then(response => {

                      axios
                      .post('./api/AfpPorMes', {mes: trabajador.mes, anio: trabajador.anio})
                      .then(afp => {  
                        // *** Poner catch para error de si no encuentra.
                        this.PrevisionSeleccionada = this.json2array(afp.data)[trabajador.afp].comision;

                        console.log("VER IMOIRTANTE AFO", this.json2array(afp.data))

                        console.log("RUT "+ trabajador.rut, this.json2array(afp.data)[trabajador.afp]) 
                        
                        let cesantia = trabajador.tipocontrato === 2 ? 0 : 0.006;
                        
                        var coficienteUniversal = 1 - ((this.json2array(afp.data)[trabajador.afp].comision/100) + 0.07 + cesantia)
                        
                        let coficienteAFPISAPRE = 1 - ((this.json2array(afp.data)[trabajador.afp].comision/100) + 0.07 )
                        
                        let coef_afp = 1 - ((this.json2array(afp.data)[trabajador.afp].comision/100) )
                        
                        let coef_isapre = 1 - ( 0.07 );           

                        this.totalNoImponible =  parseInt(trabajador.movilizacion)  + parseInt(trabajador.colacion);                                 

                        let tributable = (trabajador.liquido - (trabajador.movilizacion  + trabajador.colacion) );
                        
                        coficienteUniversal = coficienteAFPISAPRE + cesantia;                        
                        
                        let descuentosAfpIsapre = (tributable / coficienteUniversal) * (1-coficienteAFPISAPRE);

                        let descuento_afp = (tributable / coficienteUniversal) * (1-coef_afp);
                        
                        let descuentosIsapre = (tributable / coficienteUniversal) * (1-coef_isapre);
                       
                        let descuentosCesantia = (tributable / coficienteUniversal) * cesantia;

                        this.fun = trabajador.fun;

                        this.analizarSiFun(descuentosIsapre, tributable);

                        this.asignarCargas(trabajador.tramo, trabajador.cargas);

                        let totalImponible = tributable + this.diferencia_salud;

                        this.impuestos = response.data;

                        this.desdeBaseDarLiquidoDefinito((totalImponible - this.totalNoImponible), coficienteAFPISAPRE, cesantia, trabajador.liquido, coficienteAFPISAPRE+cesantia, (this.PrevisionSeleccionada/100), 0.07, this.Parametros, indice_trabajador, this.json2array(afp.data)[trabajador.afp]);

                        /*

                        *****
                        _____

                        */






                     });




                    });
                },                
                analizarSiFun(descuentosIsapre_en_funcion, tributable){
                  let limiteAFPSALUD = 2272728;
                  let limiteCesantia = 3409091;
                  if(limiteAFPSALUD * 0.07 < descuentosIsapre_en_funcion ){
                    descuentosIsapre_en_funcion = limiteAFPSALUD * 0.07;
                  }


                  if( this.fun > 0 ){

                    let saludFun = parseFloat(this.Parametros.UF * this.fun);

                    if(saludFun > descuentosIsapre_en_funcion){
                      
                      this.MontoSaludDefinitivo = saludFun;
                      console.log("MontoSaludDefinitivo", this.MontoSaludDefinitivo)
                      this.diferencia_salud = (Math.abs(saludFun - descuentosIsapre_en_funcion) * 1);
                      
                    }else{

                      this.MontoSaludDefinitivo = descuentosIsapre_en_funcion;
                      console.log("MontoSaludDefinitivo", this.MontoSaludDefinitivo)
                      this.diferencia_salud = 0;
                    }              

                  }else{
                    
                      this.MontoSaludDefinitivo = descuentosIsapre_en_funcion;
                  console.log("MontoSaludDefinitivo segundo else.", this.MontoSaludDefinitivo)
                      this.diferencia_salud = 0;
                  }
                  console.log("thisdiferenciasalud" , this.diferencia_salud )
                },
                asignarCargas(Tramocargas,cargas){
                  let montoPorCargas = 0;
                  console.log("this.Tramocargas", Tramocargas)
                  cargas= cargas*1;
                  console.log("this.cargas", cargas)
                  
                  if(Tramocargas == 1){
                    //console.log("this.Parametros.AsignFamA ", this.Parametros.AsignFamA )
                    this.montoPorCargas = this.Parametros.AsigFamA * cargas;
                  }else if(Tramocargas == 2){
                    //console.log("this.Parametros.AsignFamA ", this.Parametros.AsignFamB )
                    this.montoPorCargas = this.Parametros.AsigFamB * cargas;

                  }else if(Tramocargas == 3){
                    //console.log("this.Parametros.AsignFamA ", this.Parametros.AsignFamC )
                    this.montoPorCargas = this.Parametros.AsigFamC * cargas;

                  }else{
                    this.montoPorCargas = 0;
                  }
                  console.log("montoPorCargas", this.montoPorCargas)
                  return this.montoPorCargas;
                },
                desdeBaseDarLiquidoDefinito(imponible_preliminar, coef_afpsalud, coef_cesantia, LiqPactado, coef_universal, afp, salud, parametros,indice_trabajador, afpSeleccionadaObjeto){
                  
                  let primer_liquido_simulado_por_tabla_imp = parseInt((this.impuestos[0].desde - (( this.impuestos[0].desde * this.impuestos[0].factor ) -  this.impuestos[0].cantidadRebajar)));

                  if(  primer_liquido_simulado_por_tabla_imp  > LiqPactado)   return this.porFormula((0.07) ,afp,coef_cesantia, 0, 0, LiqPactado, coef_afpsalud, parametros, coef_universal,indice_trabajador, afpSeleccionadaObjeto );

                  


                  this.impuestos.forEach(value => {
              

                    let segundo_liquido_simulado_por_tabla_imp_uno = parseInt((value.desde - (( value.desde * value.factor ) -  value.cantidadRebajar)));

                    let segundo_liquido_simulado_por_tabla_imp_dos = parseInt((value.hasta - (( value.hasta * value.factor ) -  value.cantidadRebajar)));


                    if(LiqPactado > segundo_liquido_simulado_por_tabla_imp_uno && LiqPactado < segundo_liquido_simulado_por_tabla_imp_dos){
                      
                      this.porFormula((0.07), (this.PrevisionSeleccionada/100),coef_cesantia, value.factor, value.cantidadRebajar, LiqPactado, coef_afpsalud, parametros, coef_universal,indice_trabajador, afpSeleccionadaObjeto);

                    }

                  })
              
                }, // Fin desdebasedarliquidodefinito
                porFormula(salud, afp, cesantiaFactor,factor, descontar, liquido, coefAFPISAPRE, Parametros, coef_universal, indice_trabajador, afpSeleccionadaObjeto){
                 
                  let limiteAFPSALUD = 2272728;
                  let limiteCesantia = 3409091;
                  liquido = liquido - this.totalNoImponible;
                  console.log("this.fun", this.fun)
                  if( this.fun > 0 ){
                      
                      let parteArriba = parseInt(liquido) + parseInt(this.MontoSaludDefinitivo)  - parseInt(descontar);
                      let parteAbajo = 1  - afp - cesantiaFactor - factor + (factor*afp) + (factor*salud) + (factor * cesantiaFactor);
                      let sueldo = parteArriba / parteAbajo;
                 




                  console.log("sueldo > limiteCesantia", sueldo > limiteCesantia)
                  console.log("sueldo > ", sueldo  )
                  console.log(" > limiteCesantia",   limiteCesantia)
                      if(sueldo > limiteCesantia){
                                // Listo..!!
                                let tImponible_superior_lim_cesantia = (((parseInt(liquido)+ parseInt(this.MontoSaludDefinitivo)  - (factor*limiteAFPSALUD*afp) - (factor*limiteAFPSALUD*salud)-(factor*limiteCesantia*cesantiaFactor))-descontar + (limiteAFPSALUD*afp) +(limiteCesantia*cesantiaFactor))/     ( 1-factor))

                                this.armarSueldoDesdeImponible(tImponible_superior_lim_cesantia, limiteAFPSALUD*afp, parseInt(limiteAFPSALUD*salud) , limiteCesantia*cesantiaFactor ,factor, descontar, indice_trabajador, afpSeleccionadaObjeto)
                              
                      }else if(sueldo < limiteAFPSALUD){
                                  
                                  //let descuentos = (sueldo*salud) + (afp*sueldo) + (cesantiaFactor*sueldo);
                                  //let liquido_calculado_ = sueldo - descuentos - ( ( (sueldo-descuentos)*factor) - descontar  );
                                  this.armarSueldoDesdeImponible(sueldo, (afp*sueldo), (sueldo*salud), (cesantiaFactor*sueldo) ,factor, descontar, indice_trabajador, afpSeleccionadaObjeto);

                      }else if(sueldo > limiteAFPSALUD && sueldo < limiteCesantia){

                                let parteArriba_entrerangos = liquido-descontar+ parseInt(this.MontoSaludDefinitivo) +(limiteAFPSALUD*afp)-(limiteAFPSALUD*factor*afp)-(limiteAFPSALUD*factor*salud);

                                let parteAbajo_entrerangos= 1-cesantiaFactor - factor +( factor*cesantiaFactor);

                                let sueldoEntreRangos = parteArriba_entrerangos / parteAbajo_entrerangos;

                                this.armarSueldoDesdeImponible(sueldoEntreRangos, (limiteAFPSALUD*afp), (limiteAFPSALUD*salud), (cesantiaFactor*sueldoEntreRangos) ,factor, descontar, indice_trabajador, afpSeleccionadaObjeto)
                      }


                  }else{
                      let parteArriba = liquido - descontar;
                      console.log("En else, viendo q tiene el liquido", liquido)
                      console.log("En else, viendo q tiene el descontar", descontar)
                      let parteAbajo = 1 - salud - afp - cesantiaFactor - factor + (factor*afp) + (factor*salud) + (factor * cesantiaFactor);
                      console.log("parte arriba", parteArriba)
                      console.log("parte parteAbajo", parteAbajo)
                      let sueldo = parteArriba / parteAbajo;
                  console.log("sueldo > limiteCesantia", sueldo > limiteCesantia)
                  console.log("sueldo > ", sueldo  )
                  console.log(" > limiteCesantia",   limiteCesantia)
                      if(sueldo > limiteCesantia){
                                // Listo..!!
                                let tImponible_superior_lim_cesantia = (((liquido - (factor*limiteAFPSALUD*afp) - (factor*limiteAFPSALUD*salud)-(factor*limiteCesantia*cesantiaFactor))-descontar + (limiteAFPSALUD*afp) + (limiteAFPSALUD*salud)+(limiteCesantia*cesantiaFactor))/     ( 1-factor))

                                this.armarSueldoDesdeImponible(tImponible_superior_lim_cesantia, limiteAFPSALUD*afp, limiteAFPSALUD*salud, limiteCesantia*cesantiaFactor ,factor, descontar, indice_trabajador, afpSeleccionadaObjeto)
                              
                      }else if(sueldo < limiteAFPSALUD){
                                  
                                  let descuentos = (sueldo*salud) + (afp*sueldo) + (cesantiaFactor*sueldo);
                                  let liquido_calculado_ = sueldo - descuentos - ( ( (sueldo-descuentos)*factor) - descontar  );
                                  this.armarSueldoDesdeImponible(sueldo, (afp*sueldo), (sueldo*salud), (cesantiaFactor*sueldo) ,factor, descontar, indice_trabajador, afpSeleccionadaObjeto);

                      }else if(sueldo > limiteAFPSALUD && sueldo < limiteCesantia){

                                let parteArriba_entrerangos = liquido-descontar+(limiteAFPSALUD*salud)+(limiteAFPSALUD*afp)-(limiteAFPSALUD*factor*afp)-(limiteAFPSALUD*factor*salud);

                                let parteAbajo_entrerangos= 1-cesantiaFactor - factor +( factor*cesantiaFactor);

                                let sueldoEntreRangos = parteArriba_entrerangos / parteAbajo_entrerangos;

                                this.armarSueldoDesdeImponible(sueldoEntreRangos, (limiteAFPSALUD*afp), (limiteAFPSALUD*salud), (cesantiaFactor*sueldoEntreRangos) ,factor, descontar, indice_trabajador, afpSeleccionadaObjeto)
                      }


                  }




                  
                  






                },  // Fin porFormula
               /* armarSueldoDesdeImponible(imponible, montoAfp, montoIsapre, montoCesantia, factor, descontar, indice, afpSeleccionadaObjeto, indice_trabajador){
                   if( (imponible/1.25) * 0.25 > 119146){
                      this.datosTrabajador[indice_trabajador].sueldoBase = imponible - 119146;
                      this.datosTrabajador[indice_trabajador].montoGratificacionLegal = 119146;
                    }else{
                      this.datosTrabajador[indice_trabajador].sueldoBase = imponible /1.25;
                      this.datosTrabajador[indice_trabajador].montoGratificacionLegal = imponible * 0.25;

                    }
                  this.datosTrabajador[indice_trabajador].objetoAfp = afpSeleccionadaObjeto;
                  this.datosTrabajador[indice_trabajador].imponible = imponible;
                  this.datosTrabajador[indice_trabajador].MontoAfp = montoAfp;
                  this.datosTrabajador[indice_trabajador].MontoIsapre = montoIsapre;
                  this.datosTrabajador[indice_trabajador].MontoCesantia = montoCesantia;
                  this.datosTrabajador[indice_trabajador].impuesto = ((imponible - (montoAfp + montoCesantia + montoIsapre)) * factor) - descontar
                  this.datosTrabajador[indice_trabajador].liquido = imponible+this.datosTrabajador[indice_trabajador].colacion + this.datosTrabajador[indice_trabajador].movilizacion - (montoAfp + montoCesantia + montoIsapre + this.datosTrabajador[indice_trabajador].impuesto)                  
                },*/
                armarSueldoDesdeImponible(imponible, montoAfp, montoIsapre, montoCesantia, factor, descontar,indice_trabajador ,afpSeleccionadaObjeto){
                  //alert("Adfsasdfasdfasfd")
                  this.asignarCargas(this.datosTrabajador[indice_trabajador].tramo, this.datosTrabajador[indice_trabajador].cargas);
                  if( (imponible/1.25) * 0.25 > 119146){
                      this.datosTrabajador[indice_trabajador].sueldoBase = imponible - 119146;
                      this.datosTrabajador[indice_trabajador].montoGratificacionLegal = 119146;
                  }else{
                      this.datosTrabajador[indice_trabajador].sueldoBase = imponible /1.25;
                      this.datosTrabajador[indice_trabajador].montoGratificacionLegal = imponible * 0.25;

                  }
                  if(this.fun > 0){
                    this.datosTrabajador[indice_trabajador].adicionalIsapre = Math.abs(this.Parametros.UF * this.fun -  montoIsapre)
                  }else{
                    this.datosTrabajador[indice_trabajador].adicionalIsapre = 0;
                  }
                  console.log(afpSeleccionadaObjeto)
                  this.datosTrabajador[indice_trabajador].objetoAfp = afpSeleccionadaObjeto;
                  this.datosTrabajador[indice_trabajador].noImponible = parseInt((this.montoPorCargas) + (this.totalNoImponible));
                  this.datosTrabajador[indice_trabajador].imponible = imponible;
                  this.datosTrabajador[indice_trabajador].MontoAfp = montoAfp;
                  this.datosTrabajador[indice_trabajador].MontoIsapre = parseInt(this.MontoSaludDefinitivo);
                  this.datosTrabajador[indice_trabajador].MontoCesantia = montoCesantia;
                  this.datosTrabajador[indice_trabajador].MontoPorCargas = this.montoPorCargas;
                  this.datosTrabajador[indice_trabajador].impuesto = ((imponible - (montoAfp + montoCesantia + montoIsapre)) * factor) - descontar
                 


                  this.datosTrabajador[indice_trabajador].liquido = parseInt( parseInt(imponible) + parseInt(this.datosTrabajador[indice_trabajador].noImponible) ) - (parseInt(montoAfp) + parseInt(montoCesantia) + parseInt(this.MontoSaludDefinitivo) + parseInt(this.datosTrabajador[indice_trabajador].impuesto))      

                  console.log("El (this.montoPorCargas)n1", (this.montoPorCargas) )            
                  console.log("el factor usado es.. .", factor)
                  console.log("El descontadoes ", descontar)

                  console.log("E (this.totalNoImponible)", (this.totalNoImponible)  )            
           

                  console.log(this.datosTrabajador[indice_trabajador]);
                  console.log("parseInt(this.datosTrabajador[indice_trabajador].impuesto)", parseInt(this.datosTrabajador[indice_trabajador].impuesto))

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