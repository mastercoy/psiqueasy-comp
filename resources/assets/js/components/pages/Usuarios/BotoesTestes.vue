<template>
  <div class="form-temp">
    <h2>Página para testes de aplicação de botões</h2>
    <hr />
    <div class="container" v-if="loading">
      <h3>Carregando...</h3>
    </div>
    <div v-else class="container">
      <div class="row">
        <button
          class="btn btn-primary btn-block"
          :disabled="permissao_1"
          @click="testFunc"
        ><i class="fa fa-pencil-square" aria-hidden="true"></i> 
        Editar Empresa</button>
        <button
          class="btn btn-warning btn-block"
          :disabled="permissao_2"
          @click="testFunc"
        >Adicionar Filial</button>
        <button
          class="btn btn-secondary btn-block"
          :disabled="permissao_3"
          @click="testFunc"
        >Editar Filial</button>
        <button
          class="btn btn-danger btn-block"
          :disabled="permissao_4"
          @click="testFunc"
        >Deletar Filial</button>
        <button
          class="btn btn-primary btn-block"
          :disabled="permissao_5"
          @click="testFunc"
        >Adicionar User</button>
        <button
          class="btn btn-warning btn-block"
          :disabled="permissao_6"
          @click="testFunc"
        >Editar User</button>
        <button
          class="btn btn-danger btn-block"
          :disabled="permissao_7"
          @click="testFunc"
        >Deletar User</button>
        <button
          class="btn btn-secondary btn-block"
          :disabled="permissao_8"
          @click="testFunc"
        >Editar Perfil</button>
        <button
          class="btn btn-secondary btn-block"
          :disabled="permissao_9"
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
      permissao_1: true,
      permissao_2: true,
      permissao_3: true,
      permissao_4: true,
      permissao_5: true,
      permissao_6: true,
      permissao_7: true,
      permissao_8: true,
      permissao_9: true,
      permissao_10: true,
      permissao_11: true,
      permissao_12: true,
      permissao_13: true,
      permissao_14: true,

      loading: true
    };
  },  
  methods: {
  async pegaPermissoes() {

     const test = await axios.get(`/api/permissoes-perfil-json/3`).then(({ data }) => {
        this.tempArr = data;
        for (let i = 0; i < this.tempArr.length; i++) {
          this.permissoes[i] = this.tempArr[i].id;
          //console.log("OK!");
        }
       this.loading = true;
        console.log(this.permissoes);
          for(let i=0;i<= this.permissoes.length;i++){
            console.log(this.permissoes[i]);
            switch(this.permissoes[i]) {
              case 1:
                this.permissao_1 = false;
                break;
              case 2:
                this.permissao_2 = false;
                break;
              case 3:
                this.permissao_3 = false;
                break;
              case 4:
                this.permissao_4 = false;
                break;
              case 5:
                this.permissao_5 = false;
                break;
              case 6:
                this.permissao_6 = false;
                break;
              case 7:
                this.permissao_7 = false;
                break;
              case 8:
                this.permissao_8 = false;
                break;
              case 9:
                this.permissao_9 = false;
                break;
              case 10:
                this.permissao_10 = false;
                break;
              case 11: 
                this.permissao_11 = false;
                break;
              case 12:
                this.permissao_12 = false;
                break;
              default :
                console.log('Nao existe permissão!');                
            }
          }
        this.loading = false;
      });
    },
    testFunc() {
      console.log("Está ativo!");
    },
     checkPermissoes(e) {
       
      //    this.verificarP = false;
      //    console.log(this.verificarP);
       
      // console.log('teste')
      // console.log(this.permissoes);
      // //Função que retorna se o
      // let teste = true;
      // // let arrayT = this.permissoes;
      //   // setTimeout(() => {
      // console.log(e);
      // if (this.permissoes.includes(e)) {
      //   console.log(this.permissoes.includes(e));
      //   teste = false;
      // } else {
      //   teste = true;
      // }
      //   // }, 1500);
      // return teste;
    }
  }
};
</script>

<style>
</style>