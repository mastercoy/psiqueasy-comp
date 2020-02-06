<template>
  <div class="form-temp">
    <div class="row">
      <div class="col-md-9">
        <h4><i class="fa fa-building" aria-hidden="true"></i> Filiais</h4>
      </div>
      <div class="col-md-3">
         <router-link :to="{name:'NovaFilial', params: {filial} }" class="btn btn-primary">
              <i class="fa fa-plus-square" aria-hidden="true"></i> Nova Filial
         </router-link>
      </div>
    </div>   
      <hr>
     <div class="container">
       <div class="table-responsive">
         <table class="table table-sm">
           <thead>
              <tr>
              <th class="th-lg" scope="col">Código</th>
              <th class="th-lg" scope="col">Nome</th>              
              <th class="th-lg" scope="col">Localidade/UF</th>
              <th class="th-lg" scope="col"> Editar </th>
              <th class="th-lg" scope="col"> Deletar </th>
            </tr>
           </thead>          
          <tbody>
            <tr v-for="filial in filiais" :key="filial.id">              
              <td> {{ filial.id }} </td>
              <td> {{ filial.nome }}</td>
              <td> {{ filial.localidade }}</td>
              <td><router-link :to="{name:'EditFilial', params: {filial} }" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i></router-link></td>  
              <td><a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalCenter" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>              
            </tr>
          </tbody>
         </table>
       </div>
    </div>


       <!-- Modal para comfirmação de deletar -->
          <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Deleter Filial</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <h5>Voce tem certeza de que deseja deletar a filial selecionada?</h5>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-danger">Continuar</button>
                </div>
              </div>
            </div>
          </div>


  </div>
</template>

<script>
export default {
  // mounted(){
  //   axios.get('api/empresa-filial-json').then(({data}) => {
  //       console.log("Filiais montadas com sucesso")
  //   });
    
  // },
  data() {
    return {
      filial: {
      nome: '',
      localidade: '',
      complemento: ''
      },
      filiais: [
        {
          id: 1,
          nome: "Loja 1",
          localidade: "Vitoria da Conquista - BA"

        },
         {
           id: 2,
          nome: "Loja 2",
          localidade: "Firmino Alves - BA"

        },
         {
           id: 3,
          nome: "Loja 3",
          localidade: "Guanambi - BA"

        },
         {
           id: 4,
          nome: "Loja 4",
          localidade: "Salvador - BA"

        }
      ]
    }
    
  },
  methods: {
    editarFilial() {
      this.filial.nome = "Loja 2";
      this.filial.localidade = "Salvador/BA";

      this.vefEditFilial = true;
    },
    atualizaFilial() {
      console.log("Filial Atualizada!")
    }
  }
}
</script>
<!--
<style scoped>
  .form-temp {
   padding: 20px;
   background-color: #fff;
   border-radius: 5px;
  }

  h4 {
    color: rgb(112, 112, 112);
  }
  .container-new {
    border: 1px solid rgb(202, 202, 202);
    border-radius: 5px;
    padding: 10px;
  }
</style>
-->