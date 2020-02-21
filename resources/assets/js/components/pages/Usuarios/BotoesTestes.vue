<template>
  <div class="form-temp">
    <h2>Página para testes de aplicação de botões</h2><hr>
    <div class="container">
      <div class="row">
        <button class="btn btn-primary btn-block" :disabled="!checkPermissoes(1)" @click="testFunc">
          Editar Empresa
        </button>
        <button class="btn btn-warning btn-block" :disabled="!checkPermissoes(2)" @click="testFunc">
          Adicionar Filial
        </button>
        <button class="btn btn-secondary btn-block" :disabled="!checkPermissoes(10)" @click="testFunc">
          Editar Filial
        </button>
        <button class="btn btn-danger btn-block" :disabled="!checkPermissoes(10)" @click="testFunc">
          Deletar Filial
        </button>
        <button class="btn btn-primary btn-block" :disabled="!checkPermissoes(4)" @click="testFunc">
          Adicionar User
        </button>
        <button class="btn btn-warning btn-block" :disabled="!checkPermissoes(1)" @click="testFunc">
          Editar User
        </button>
        <button class="btn btn-danger btn-block" :disabled="!checkPermissoes(1)" @click="testFunc">
          Deletar User
        </button>
        <button class="btn btn-secondary btn-block" :disabled="!checkPermissoes(1)" @click="testFunc">
          Editar Perfil
        </button>
        <button class="btn btn-secondary btn-block" :disabled="!checkPermissoes(1)" @click="testFunc">
          Editar Perfil
        </button>
      </div>
    </div>  

  </div>
</template>

<script>
export default {
  data() {
    return {
      permissoes: [1, 30]
    }
  },
  methods: {
    testFunc() {
      console.log("Está ativo!");
    },
     checkPermissoes(e) { //Função que retorna se o 
          if( this.permissoes.includes(e)){
            return true;
          }else {
            return false;
          }
        }    
  }
}
</script>

<style>

</style>