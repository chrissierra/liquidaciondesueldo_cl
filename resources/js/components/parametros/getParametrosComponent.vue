<template>
    <div class="container impuestos-container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Parametros</div>

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
                        <button @click="ConsultarBaseDatosPorMes()" class="btn btn-primary">Visualizar</button>
                    </div>

                
                    <div class="container">
                        
                        <div class="row">
                            <div class="table-responsive impuestos-tabla">
                              <table class="table">
                                <table class="table table">
                                  <thead>
                                    <tr>

                                      <th scope="col"> Modelo </th> 
                                      <th scope="col"> Habitat </th> 
                                      <th scope="col"> Provida </th> 
                                      <th scope="col"> Cuprum </th> 
                                      <th scope="col"> PlanVital </th> 
                                      <th scope="col"> Uno </th> 
                                      <th scope="col"> UF </th> 
                                      <th scope="col"> Cesantia </th> 
                                      <th scope="col"> AsigFamA </th> 
                                      <th scope="col"> AsigFamB </th> 
                                      <th scope="col"> AsigFamC </th> 
                                      <th scope="col"> TopeImpAFP </th> 
                                      <th scope="col"> TopeImpIPS </th> 
                                      <th scope="col"> TopeImpSegCesantia </th> 
                                      <th scope="col"> mes </th> 
                                      <th scope="col"> anio </th> 

                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr v-for="parametro in ParametroSeleccionado">

                                      <td> {{ parametro.Modelo }} </td> 
                                      <td> {{ parametro.Habitat }} </td> 
                                      <td> {{ parametro.Provida }} </td> 
                                      <td> {{ parametro.Cuprum }} </td> 
                                      <td> {{ parametro.PlanVital }} </td> 
                                      <td> {{ parametro.Uno }} </td> 
                                      <td> {{ parametro.UF }} </td> 
                                      <td> {{ parametro.Cesantia }} </td> 
                                      <td> {{ parametro.AsigFamA }} </td> 
                                      <td> {{ parametro.AsigFamB }} </td> 
                                      <td> {{ parametro.AsigFamC }} </td> 
                                      <td> {{ parametro.TopeImpAFP }} </td> 
                                      <td> {{ parametro.TopeImpIPS }} </td> 
                                      <td> {{ parametro.TopeImpSegCesantia }} </td> 
                                      <td> {{ parametro.mes }} </td> 
                                      <td> {{ parametro.anio }} </td> 



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
                ParametroSeleccionado: []
            }
        },
        methods:{
            ConsultarBaseDatosPorMes(){
                axios
                .post('api/ParametrosPorMes', {mes: this.mes, anio: this.anio})
                .then( response => {
                    console.log(response)
                    this.ParametroSeleccionado = response.data;
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
