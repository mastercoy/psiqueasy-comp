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

        <div class="form-temp">       
         <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <router-link v-if="this.$store.state.Status >= 1 " class="nav-link active" id="v-pills-empresa-tab" data-toggle="pill" href="#v-pills-empresa" role="tab" to="/cadastro" aria-selected="true"> Empresa </router-link>
            <router-link v-if="this.$store.state.Status === 2" class="nav-link" id="v-pills-filial-tab" data-toggle="pill" href="#v-pills-filial" role="tab" to="/filial" aria-selected="false"> Filiais </router-link>
            <router-link v-if="this.$store.state.Status === 2" class="nav-link" id="v-pills-users-tab" data-toggle="pill" href="#v-pills-users" role="tab" to="/usuarios" aria-selected="false"> Usuários </router-link>
            <!-- <router-link v-if="this.$store.state.Status === 2" class="nav-link" id="v-pills-permission-tab" data-toggle="pill" href="#v-pills-permissoes" role="tab" to="/usuarios/invite/permissions" aria-selected="false"> Permissoes </router-link>                         -->
            <router-link to="/teste" class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Botoes para Teste</router-link>
            <router-link to="/agendamentos" class="nav-link" id="v-pills-mark-tab" data-toggle="pill" href="#v-pills-mark" role="tab" aria-selected="false"> Agendamentos </router-link>
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
    //ADICIONAR MÉTODO PARA VERIFICAR QUAL O USUÁRIO QUE ESTÁ LOGADO E QUAIS AS PERMISSÕES DO MESMO
    
     },
  data() {
    return {
      nivelPermissao: 0
     
    }
  },
  methods: {
    imprimir(){
      console.log("OK!"); 
    },
    
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
   

</style>

