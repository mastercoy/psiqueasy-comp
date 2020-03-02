<template>
  <div class="form-temp">
    <h2>Página para testes de aplicação de botões</h2>
    <hr />
    <input class="magic-checkbox" type="checkbox" id="checkbox-teste" />
    <label for="checkbox-teste">Checkbox para Teste</label>
    <div class="container">
      <div class="row">
        <button
          class="btn btn-primary btn-block"
          :disabled="checkPermissoes(1)"
          @click="testFunc"
        >Editar Empresa</button>
        <button
          class="btn btn-warning btn-block"
          :disabled="checkPermissoes(20)"
          @click="testFunc"
        >Adicionar Filial</button>
        <button
          class="btn btn-secondary btn-block"
          :disabled="checkPermissoes(3)"
          @click="testFunc"
        >Editar Filial</button>
        <button
          class="btn btn-danger btn-block"
          :disabled="checkPermissoes(4)"
          @click="testFunc"
        >Deletar Filial</button>
        <button
          class="btn btn-primary btn-block"
          :disabled="checkPermissoes(5)"
          @click="testFunc"
        >Adicionar User</button>
        <button
          class="btn btn-warning btn-block"
          :disabled="checkPermissoes(6)"
          @click="testFunc"
        >Editar User</button>
        <button
          class="btn btn-danger btn-block"
          :disabled="checkPermissoes(7)"
          @click="testFunc"
        >Deletar User</button>
        <button
          class="btn btn-secondary btn-block"
          :disabled="checkPermissoes(8)"
          @click="testFunc"
        >Editar Perfil</button>
        <button
          class="btn btn-secondary btn-block"
          :disabled="checkPermissoes(9)"
          @click="testFunc"
        >Editar Perfil</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    //checkbox-teste
    let checkTest = document.getElementById("checkbox-teste");
    checkTest.indeterminate = true;

    this.pegaPermissoes();
  },
  data() {
    return {
      permissoes: [],
      tempArr: []
    };
  },
  methods: {
    pegaPermissoes() {
      axios.get(`/api/permissoes-perfil-json/3`).then(({ data }) => {
        this.tempArr = data;
        for (let i = 0; i < this.tempArr.length; i++) {
          this.permissoes[i] = this.tempArr[i].id;
          console.log("OK!");
        }
        //console.log('testando...')
      });
    },
    testFunc() {
      console.log("Está ativo!");
    },
    checkPermissoes(e) {
      //Função que retorna se o
      let teste = true;
      let arrayT = this.$store.state.permissoes;
      //  setTimeout(() => {
      console.log(e);
      if (arrayT.includes(e)) {
        console.log(arrayT.includes(e));
        teste = false;
      } else {
        teste = true;
      }
      //  }, 1500);
      return teste;
    }
  }
};
</script>

<style>
</style>