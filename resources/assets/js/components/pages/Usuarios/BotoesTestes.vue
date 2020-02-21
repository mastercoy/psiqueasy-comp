<template>
  <div class="form-temp">
    <h2>Página para testes de aplicação de botões</h2><hr>
    <div class="container">
      <div class="row">
        <button class="btn btn-primary btn-block" :disabled="!permissoes.includes(30)" @click="testFunc">
          Editar Empresa
        </button>
        <button class="btn btn-warning btn-block" :disabled="!permissoes.includes(2)" @click="testFunc">
          Adicionar Filial
        </button>
        <button class="btn btn-secondary btn-block" :disabled="!permissoes.includes(1)" @click="testFunc">
          Editar Filial
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
    }
  }

}
</script>

<style>

</style>