<template>
<div class="form-temp">
  
    <h4>Novo Usuário</h4>
      <hr>
   <div class="container container-new">
      <form>
         <div class="form-group">
          <label for="nome"><strong>Nome: </strong></label>
          <input type="text" class="form-control" id="nome" v-model="newUser.nome" placeholder="Digite o nome do usuário">
        </div>

        <div class="form-group">
          <label for="descricao"><strong>Descrição: </strong></label>
          <input type="text" class="form-control" id="descricao" v-model="newUser.descricao" placeholder="Digite uma breve descrição da função exercida pela usuário">
        </div>

         <div class="form-group">
          <label for="alocacao"><strong>Alocação: </strong></label>
          <select class="form-control" v-model="newUser.aloc">
            <option disable value=""> </option>
            <option> Matriz </option>
          </select>
        </div>

        <div class="form-group">  
          <div class="container">
            <h5>Atribuições: </h5>
                <div class="row">
                  <div class="col-md-3">
                    <input class="magic-checkbox" type="checkbox" id="Agendamentos" value="Agendamentos" v-model="newUser.atribuicoes" /> 
                    <label for="Agendamentos">Agendamentos
                    <a href="#" for="Agendamentos" data-toggle="popover" data-trigger="hover" title="Atendimentos" data-placement="top"
                       data-content="Essa atribuição da acesso aos relatórios de agendamentos, pacientes e atendimentos">
                       <i class="fa fa-info-circle fa-lg" aria-hidden="true"></i>
                    </a></label>
                  </div>

                  <div class="col-md-3">
                    <input class="magic-checkbox" type="checkbox" id="Financas"  value="Financas" v-model="newUser.atribuicoes"/> 
                    <label for="Financas">Finanças
                    <a href="#" for="Financas" data-toggle="popover" data-trigger="hover" title="Finanças" data-placement="top"
                       data-content="Essa atribuição permite ao usuário gerenciar registros fiscais, pagamentos e  arquivos de contabilidade">
                       <i class="fa fa-info-circle fa-lg" aria-hidden="true"></i>
                    </a></label>
                  </div>    

                  <div class="col-md-3">
                    <input class="magic-checkbox" type="checkbox" id="Admin" value="admin"  v-model="newUser.atribuicoes"/> 
                     <label for="Admin">Admin
                       <a href="#" for="Admin" data-toggle="popover" data-trigger="hover" title="Finanças" data-placement="top"
                       data-content="Essa atribuição permite ao usuário gerenciar registros fiscais, pagamentos e  arquivos de contabilidade">
                       <i class="fa fa-info-circle fa-lg" aria-hidden="true"></i>
                    </a></label>
                  </div>
                   <div class="col-md-3">
                    <input class="magic-checkbox" type="checkbox" id="cadastros" value="cadastros" v-model="newUser.atribuicoes"/> 
                    <label for="cadastros">Outros</label>
                  </div>
                </div>   
          </div>       
        </div>
         <hr />
          <div class="row">          
            <div class="col-md-8"></div>
            <div class="col-md-4">
              <router-link to="/usuarios" type="button" class="btn btn-default mr-1">Cancelar</router-link>
               <button type="button" class="btn btn-success" @click="addUser"><i aria-hidden="true" class="fa fa-floppy-o"></i> <b>Salvar</b> </button>
            </div>
          </div>
      </form>
    </div>
</div>
</template>

<script>
export default {
  mounted() {
   //this.carregarLoad()
    $(document).ready(function(){
      $('[data-toggle="popover"]').popover();
    });
  },
  data() {
    return {
      loading: false,
      newUser: {
        nome: '',
        descricao: '',
        atribuicoes: [],
        aloc: ''
      }
    }
  },
  methods: {
    addUser() {
      console.log("+++");


      this.$router.push("/usuarios");
     }
    // carregarLoad() {

    //  setTimeout(this.carregarLoading(), 2000);
      
    // },
    // carregarLoading() {
    //     this.loading = true;
    //   }
  }
}
</script>

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
