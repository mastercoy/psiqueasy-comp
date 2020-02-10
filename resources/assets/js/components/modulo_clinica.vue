<template>
  <div class="container">
    <h2>Modulo - Clinica</h2> 

    <p>
      Implementação do Módulo Clínica para a aplicação Psiqueasy em um sistems SPA. 
      Módulo implementado com duas colunas principais, com a coluna da esquerda relacionado aos menus, implementado o recurso do <i>router-link</i> e a coluna da direita
      implementa o recurso <i>router-view</i> para exibição dos conteúdos.
    </p>  

    <div class="row">

      <div class="col-md-3">


         <ul v-if="this.$store.state.Status === 0">
            <li> Perfil </li>
            <li> Configurações </li>
            <li> E-Mail </li>
            <li> Senha </li>
            <li> Idioma </li>
          </ul>  
        
          <ul v-else-if="this.$store.state.Status === 1">
            <li><router-link to="/cadastro">Empresa</router-link></li>
            <!-- <li @click="imprimir"> <router-link to="/filial">Filiais</router-link></li> 
            <li><router-link to="/usuarios">Usuários</router-link></li> v-if="$store.getters.isLoggedIn"  -->
            <li> Perfil </li>
            <li> Configurações </li>
            <li> E-Mail </li>
            <li> Senha </li>
            <li> Idioma </li>
          </ul>  

          <ul v-else-if="this.$store.state.Status === 2">
            <li><router-link to="/cadastro">Empresa</router-link></li>
            <li> <router-link to="/filial">Filiais</router-link></li>
            <li><router-link to="/usuarios">Usuários</router-link></li>
            <li ><router-link to="/usuarios/invite/permissions"> Permissoes </router-link></li>
            <li> Configurações </li>
            <li> E-Mail </li>
            <li> Senha </li>
            <li> Idioma </li>
          </ul>                  
        
      </div> <!-- FIM DA DIV DA COL MD-3 -->

      <div class="col-md-9">
        <router-view />
      </div><!-- FIM DA DIV DA COL MD-9 -->
    </div>


  </div>
</template>

<script>

export default {
  name: "modulo_clinica",
  // mounted() {
  //   let newUser = this.user
  //   axios.post('api/user-json', newUser).then(({ data }) => {
  //        console.log("Usuário criado com sucesso!");
  //      });
  //   },
  data() {
    return {
      // nivelPermissao: 0,
      // user: {
      //   name: 'Matheus Henrique',
      //   email: 'teteu@gmail.com',
      //   password: 'teteu'
      // }
    }
  },
  methods: {
    imprimir(){
      console.log("OK!")
    }
  }
}
</script>

<style >
  body {
    background-color: #e5edfa;
  }

  ul {
    width: 150px;
    background: #fff;
    border-radius: 5px;
    padding: 20px 10px;
  }

  li {
    margin-left: 20px;
  }

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
   span {
    color: red;
    font-weight: bold
  }

</style>

