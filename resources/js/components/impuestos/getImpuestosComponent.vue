<template>
    <div class="container impuestos-container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Impuestos</div>

                    <div class="card-body">
                       
                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Selecciona Mes</label>
                        <select  v-model="mes" class="form-control" id="exampleFormControlSelect1">
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
                        <select  v-model="anio" class="form-control" id="Anio">
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
                        <button @click="ConsultarBaseDatosImpuestosPorMes()" class="btn btn-primary">Visualizar</button>
                    </div>

                
                    <div class="container">
                        
                        <div class="row">
                            <div class="table-responsive impuestos-tabla">
                              <table class="table">
                                <table class="table table">
                                  <thead>
                                    <tr>

                                      <th scope="col">Tramo</th>
                                      <th scope="col">Desde</th>
                                      <th scope="col">Hasta</th>
                                      <th scope="col">Factor</th>
                                      <th scope="col">Descuento</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr v-for="impuesto in impuestoSeleccionado">

                                      <td>{{ impuesto.tramo }}</td>
                                      <td>{{ impuesto.desde }}</td>
                                      <td>{{ impuesto.hasta }}</td>
                                      <td>{{ impuesto.factor }}</td>
                                      <td>{{ impuesto.cantidadRebajar }}</td>   

                                    </tr>
                                  </tbody>
                                </table>
                              </table>
                            </div>
                        </div>      



                    


                    </div>




                    </div><!-- Fin body Card -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return{
                mes:1,
                anio: new Date().getFullYear(),
                impuestoSeleccionado: []
            }
        },
        methods:{
            ConsultarBaseDatosImpuestosPorMes(){
                axios
                .post('api/ImpuestosDelMes', {mes: this.mes, anio: this.anio})
                .then( response => {
                    console.log(response)
                    this.impuestoSeleccionado = response.data;
                })
            }
        }
    }
</script>
<style>

.impuestos-tabla{
    font-size:1.5em;
}

</style>
