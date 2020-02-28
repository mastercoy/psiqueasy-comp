<template>
  <div class="form-temp">
    <h2>Página para testes de aplicação de botões</h2><hr>
    <div class="container">
      <div class="row">
        <button class="btn btn-primary btn-block" :disabled="checkPermissoes(1)" @click="testFunc">
          Editar Empresa
        </button>
        <button class="btn btn-warning btn-block" :disabled="checkPermissoes(20)" @click="testFunc">
          Adicionar Filial
        </button>
        <button class="btn btn-secondary btn-block" :disabled="checkPermissoes(3)" @click="testFunc">
          Editar Filial
        </button>
        <button class="btn btn-danger btn-block" :disabled="checkPermissoes(4)" @click="testFunc">
          Deletar Filial
        </button>
        <button class="btn btn-primary btn-block" :disabled="checkPermissoes(5)" @click="testFunc">
          Adicionar User
        </button>
        <button class="btn btn-warning btn-block" :disabled="checkPermissoes(6)" @click="testFunc">
          Editar User
         </button>
        <!--<button class="btn btn-danger btn-block" :disabled="checkPermissoes(7)" @click="testFunc">
          Deletar User
        </button>
        <button class="btn btn-secondary btn-block" :disabled="checkPermissoes(8)" @click="testFunc">
          Editar Perfil
        </button>
        <button class="btn btn-secondary btn-block" :disabled="checkPermissoes(9)" @click="testFunc">
          Editar Perfil
        </button> -->
      </div>
    </div>  

  </div>
</template>

<script>
export default {
  mounted() {
     axios.get(`/api/permissoes-perfil-json/3`)
          .then(({data}) => {
            this.tempArr = data;
            for(let i = 0; i < this.tempArr.length; i++) {
              this.permissoes[i] = this.tempArr[i].id;
              console.log('OK!');
            } 
            //console.log('testando...')    
          }); 
  },
  data() {
    return {
      permissoes: [],
      tempArr: []
    }
  },
  methods: {
    testFunc() {
      console.log("Está ativo!");
    },
     checkPermissoes(e) { //Função que retorna se o
        let vef;
        setTimeout(() => {  
          vef = this.permissoes.includes(e); 
               
          console.log(this.permissoes.includes(e));          
        },500);
        return vef;
        }    
  }
}
</script>

<style>

</style>