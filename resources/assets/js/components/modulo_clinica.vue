<template>
  <div class="container">
    <h2>Módulo - Clínica</h2> 

    <p>
      Implementação do Módulo Clínica para a aplicação Psiqueasy em um sistems SPA. 
      Módulo implementado com duas colunas principais, com a coluna da esquerda relacionado aos menus, implementado o recurso do <i>router-link</i> e a coluna da direita
      implementa o recurso <b><i>router-view</i></b> para exibição dos conteúdos.
    </p>  

    <div class="row">

      <div class="col-md-3">


         <!-- <ul v-if="this.$store.state.Status === 0">
            <li> Perfil </li>
            <li> Configurações </li>
            <li> E-Mail </li>
            <li> Senha </li>
            <li> Idioma </li>
          </ul>  
        
          <ul v-else-if="this.$store.state.Status === 1">
            <li><router-link to="/cadastro">Empresa</router-link></li>
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
          </ul>   -->

        <div class="form-temp">       
         <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <router-link class="nav-link active" id="v-pills-empresa-tab" data-toggle="pill" href="#v-pills-empresa" role="tab" to="/cadastro" aria-selected="true"> Empresa </router-link>
            <router-link class="nav-link" id="v-pills-filial-tab" data-toggle="pill" href="#v-pills-filial" role="tab" to="/filial" aria-selected="false"> Filiais </router-link>
            <router-link class="nav-link" id="v-pills-users-tab" data-toggle="pill" href="#v-pills-users" role="tab" to="/usuarios" aria-selected="false"> Usuários </router-link>
            <router-link class="nav-link" id="v-pills-permission-tab" data-toggle="pill" href="#v-pills-permissoes" role="tab" to="/usuarios/invite/permissions" aria-selected="false"> Permissoes </router-link>                        
            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Configurações</a>
            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">E-mail</a>
            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Idioma</a>
          </div>                
        </div>
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
  mounted() {
    // let newUser = this.user
    // axios.post('api/user-json', newUser).then(({ data }) => {
    //      console.log("Usuário criado com sucesso!");
    //    });
     },
  data() {
    return {
      nivelPermissao: 0,
      // user: {
      //   name: 'Matheus Henrique',
      //   email: 'teteu@gmail.com',
      //   password: '1234'
      // }
    }
  },
  methods: {
    imprimir(){
      console.log("OK!"); 
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

