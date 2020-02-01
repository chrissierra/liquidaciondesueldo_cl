<template>
   
  <div  v-if="liquidacion_generada"  class="container-fluid">
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


    <div class="row mt-4 mb-5">
      <div class="col-12 text-center">
       <p class="text-muted" style="font-size: 1.3em;"> Sueldo Líquido a pago:</p>
      </div>
      <div class="col-12 text-center">
        {{ liquidacion_generada.liquido | aproximarConPeso(0) }}

      
      </div>

      <div class="col-12 text-center">
          <button @click="generarPDF" class="btn btn-primary">Generar PDF</button>
      </div>
    </div>




    <hr>
    <div  v-if="showFormInvitado"  class="row"><!-- Comienzo formulario invitados -->
      
     <h3 class="mb-4">¿ Quieres realizar la liquidación en PDF ?</h3>





      <div class="formulario">
        
        <div class="col-12">
          <p class="text-muted" ><h4>Datos Empresa</h4></p>
        </div>
          
        <div class="form-group">
          <label>Razón social empresa</label>
          <input v-model="razonSocial" type="text" class="form-control" name="razonSocial">
          <small class="form-text text-muted">Nombre de la empresa</small>
        </div>

        <div class="form-group">
          <label>Rut Empresa</label>
          <input v-model="rutEmpresa" type="text" class="form-control" name="razonSocial" placeholder="Sin puntos: 76355851-7">
          <small class="form-text text-muted">Rut sin puntos: 76355851-7</small>
        </div>


        <div class="row"><!-- Incluir acá el select para empresas registradas -->
        
            <div class="col-12">
                <p class="text-muted" ><h4>Selecciona trabajador o ingresa uno nuevo</h4></p>
            


              <div class="form-group">
                <label for="trabajadores">Seleccion Trabajador</label>
                <select class="form-control" id="trabajadores" v-model="trabajadorSeleccionadoEnSelect">
                
                  <option v-for="(trabajador_, index) in datosSelectTrabajadores" :value="index">{{ trabajador_.nombre }}  {{trabajador_.apellidos}}</option>

                </select>
              </div>    

            </div>
            <div class="col-12">
              <button  @click="liquidacionFromSelect" class="btn btn-danger" >Genera liquidacion pdf</button>
            </div>



        </div><!-- Incluir acá el select para empresas registradas -->





        <div class="col-12">
          <p class="text-muted" ><h4>Datos Trabajador</h4></p>
        </div>

        <div class="form-group">
          <label>Rut Trabajador</label>
          <input v-model="rutTrabajador" type="text" class="form-control" name="rutTrabajador" placeholder="Sin puntos: 17961493-7">
          <small class="form-text text-muted">Rut sin puntos: 76355851-7</small>
        </div>

        <div class="form-group">
          <label>Nombre Trabajador</label>
          <input v-model="nombreTrabajador" type="text" class="form-control" name="nombreTrabajador" placeholder="Juan Carlos">
          <small class="form-text text-muted">Escribe los nombres de tu trabajador</small>
        </div>


        <div class="form-group">
          <label>Apellidos Trabajador</label>
          <input v-model="apellidosTrabajador" type="text" class="form-control" name="apellidosTrabajador" placeholder="Perez Gonzalez">
          <small class="form-text text-muted">Escribe los apellidos de tu trabajador</small>
        </div>

        <div class="form-group">
          <label>Cargo Trabajador</label>
          <input v-model="CargoTrabajador" type="text" class="form-control" name="CargoTrabajador" placeholder="Analista RRHH">
          <small class="form-text text-muted">Escribe el cargo de tu trabajador</small>
        </div>        


        <div class="form-group">
          <label>Sucursal o establecimiento</label>
          <input v-model="sucursal" type="text" class="form-control" name="sucursal" placeholder="Ej: Planta Pirque">
          <small class="form-text text-muted">Escribe el nombre de tu sucursal</small>
        </div>  

        <div class="form-group">
          <label>Dirección sucursal o establecimiento</label>
          <input v-model="DireccionSucursal" type="text" class="form-control" name="DireccionSucursal" placeholder="Ej: Av. Vivaceta 1144">
          <small class="form-text text-muted">Escribe la dirección de tu sucursal</small>
        </div>  

        <div class="form-group">
          <label>Fecha ingreso a empresa</label>
          <input v-model="fechaIngreso" type="date" class="form-control" name="fechaIngreso" >
          <small class="form-text text-muted">Escribe la fecha de ingreso de tu trabajador a tu empresa</small>
        </div> 


        <div class="ultimo-form-group" style="text-align: center; margin-bottom: 3em;"> 
                <button style="background-color: #dd6b4d; border: solid 0; width: 10em;" v-on:click="guardarDatos" class="btn btn-primary">Guardar Datos</button>
        </div>

      <div v-if="id_liquidacion_boolean" class="row mt-4">
              <div class="col-12 text-center">
               <p class="text-muted" style="font-size: 1.3em;"> Convertir a PDF: </p>
              </div>
              <div class="col-12 text-center">
              

               <a v-bind:href="'/Descargar_liquidacion/'+ id_liquidacion">VER</a>
              </div>
        </div>  

      </div>
    </div><!-- Fin formulario invitados -->

  </div>



</template>

<script>
    export default {
      props:['liquidacion'],
        mounted() {

        },

        data(){
            return{
              liquidacion_generada: null,
              showFormInvitado: false,
              razonSocial: '',
              rutEmpresa: '',
              rutTrabajador: '',
              nombreTrabajador: '',
              apellidosTrabajador: '',
              CargoTrabajador: '',
              sucursal: '',
              DireccionSucursal: '',
              fechaIngreso: '',
              id_liquidacion: '',
              id_liquidacion_boolean:false,
              invitado: '',
              usuario_id: null,
              select_boolean: false,
              datosSelectTrabajadores: [],
              trabajadorSeleccionadoEnSelect: ''
            }
        },  
        methods: {
            verValor(){
              //alert(JSON.stringify(this.liquidacion));
              console.log("verValor", this.liquidacion.MontoAfp);
              this.liquidacion_generada = this.liquidacion;
              this.liquidacion_generada = null;
              this.liquidacion_generada = this.liquidacion;
            },
            generarPDF(){
                console.log(this.liquidacion);
                this.showFormInvitado = true;
                if(this.liquidacion.usuario == 'invitado'){
                  this.invitado = true;
                  this.usuario_id = null;
                }else{
                  this.invitado = false;
                  this.usuario_id = this.liquidacion.usuario.id
                  this.armarSelect_CargarDatosEmpresa();
                }
            },
            armarSelect_CargarDatosEmpresa(){

              axios.
              post('./GetTrabajadoresPorIdUsuario', {
                user_id: this.liquidacion.usuario.id
              }).then( response => {
                // Conseguir de ésta ruta los trabajadores y también los datos de la empresa.
                console.log(response)
                this.select_boolean = true;
                this.datosSelectTrabajadores = response.data.trabajadores;
                this.razonSocial = response.data.datosEmpresa.razonSocial;
                this.rutEmpresa = response.data.datosEmpresa.rutEmpresa;
              }).catch(err => {
                console.log(err)
              })

            },
            liquidacionFromSelect(event){
                  event.preventDefault()
                  console.log(this.datosSelectTrabajadores[this.trabajadorSeleccionadoEnSelect]);
                  this.trabajadorSeleccionadoEnSelect = this.datosSelectTrabajadores[this.trabajadorSeleccionadoEnSelect];
                  this.rutTrabajador = this.trabajadorSeleccionadoEnSelect.rut;
                  this.nombreTrabajador = this.trabajadorSeleccionadoEnSelect.nombre;
                  this.apellidosTrabajador = this.trabajadorSeleccionadoEnSelect.apellidos;
                  this.CargoTrabajador = this.trabajadorSeleccionadoEnSelect.cargo;
                  this.sucursal = this.trabajadorSeleccionadoEnSelect.establecimiento;
                  this.DireccionSucursal = this.trabajadorSeleccionadoEnSelect.direccionEstablecimiento;
                  this.fechaIngreso = this.trabajadorSeleccionadoEnSelect.fechaIngreso;
                  
                  



            },
            guardarDatos(){
              axios.
              post('./GuardarDatosInvitadoLiquidacion', {

                  razonSocial: this.razonSocial,
                  rutEmpresa: this.rutEmpresa,
                  rutTrabajador: this.rutTrabajador,
                  nombreTrabajador: this.nombreTrabajador,
                  apellidosTrabajador: this.apellidosTrabajador,
                  CargoTrabajador: this.CargoTrabajador,
                  sucursal: this.sucursal,
                  DireccionSucursal: this.DireccionSucursal,
                  fechaIngreso: this.fechaIngreso,
                  liquidacionGenerada: this.liquidacion_generada,
                  usuario_id: this.usuario_id


              }).then(response => {
                console.log(response);
                this.id_liquidacion = response.data;
                this.id_liquidacion_boolean = true;
              })
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


.formulario{
  display: flex;
  flex-direction: column;
}

<style>

  .item-liquidacion{
    font-size: .9em;
  }

</style>