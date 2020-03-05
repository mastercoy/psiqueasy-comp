<template>
  <div class="form-temp">
    <h2>Página para testes de aplicação de botões</h2>
    <hr />
    <div class="container" v-if="verificaP">
      <div class="row">
        <button
          class="btn btn-primary btn-block"
          :disabled="checkPermissoes(1)"
          @click="testFunc"
        ><i class="fa fa-pencil-square" aria-hidden="true"></i> 
        Editar Empresa</button>
        <button
          class="btn btn-warning btn-block"
          :disabled="checkPermissoes(2)"
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
  //props: ['listPermissoes'],
  beforeMount() {
    this.pegaPermissoes()
    
  },
  data() {
    return {
      permissoes: [],
      tempArr: [],
      verificarP: true
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
        console.log(this.permissoes);
      });
    },
    testFunc() {
      console.log("Está ativo!");
    },
     checkPermissoes(e) {
      console.log('teste')
      console.log(this.permissoes);
      //Função que retorna se o
      let teste = true;
      // let arrayT = this.permissoes;
        // setTimeout(() => {
      console.log(e);
      if (this.permissoes.includes(e)) {
        console.log(this.permissoes.includes(e));
        teste = false;
      } else {
        teste = true;
      }
        // }, 1500);
      return teste;
    }
  }
};
</script>

<style>
</style>