<template>
<div class="form-temp">
  
    <h4>Novo Usuário</h4>
      <hr>
   <div class="container container-new">
      <form>
         <div class="form-group">
          <label for="nome"><strong>Nome: </strong></label>
          <input type="text" class="form-control" id="nome" v-bind:class="{ 'is-invalid': $v.name.$error}" v-model="$v.name.$model" placeholder="Digite o nome completo do usuário">
          <p v-if="$v.name.$error"> O campo é obrigatório </p>
        </div>

        <div class="form-group">
          <label for="e-mail"><strong>E-mail: </strong></label>
          <input type="text" class="form-control" v-bind:class="{ 'is-invalid': $v.email.$error}" id="e-mail" v-model="$v.email.$model" placeholder="Digite o e-mail do usuário">
          <p v-if="$v.email.$error"> Digite um e-mail válido </p>
        </div>

         <div class="form-group">
          <label for="descricao"><strong>Descrição: </strong></label>
          <input type="text" class="form-control" id="descricao" placeholder="Digite uma breve descrição da função exercida pela usuário">
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label for="password"><strong>Digite uma senha de 4 digitos: </strong></label>
              <input class="form-control" v-bind:class="{ 'is-invalid': $v.senha.$error}" v-model="$v.senha.$model" type="password" name="senha" id="senha" >
               <small id="psenhadHelp" class="form-text text-muted">A senha será utilizada pelo usuário cadastrado ao logar.</small>
              <p v-if="$v.senha.$error"> O campo é obrigatório </p>
            </div>
            <div class="col-md-6">
              <label for="password"><strong>Confirme a senha: </strong></label>
              <input class="form-control" v-bind:class="{ 'is-invalid': $v.confirmaSenha.$error}" v-model="$v.confirmaSenha.$model" type="password" name="senhaC" id="senhaC" >
               <small id="psenhadHelp" class="form-text text-muted">A senhas precisam ser iguais.</small>
              <p v-if="$v.confirmaSenha.$error"> O campo é obrigatório </p>
            </div>
          </div>
        </div>

         <div class="form-group">
          <label for="alocacao"><strong>Alocação: </strong></label>
          <select class="form-control">
            <option disable value=""> </option>
            <option> Matriz </option>
          </select>
        </div>

        <div class="form-group">  
          <div class="container">
            <h5>Atribuições: </h5>
                <div class="row">
                  <div class="col-md-3">
                    <input class="magic-checkbox" type="checkbox" id="Agendamentos" value="Agendamentos" v-model="atribuicoes"/> 
                    <label for="Agendamentos">Agendamentos
                    <a href="#" for="Agendamentos" data-toggle="popover" data-trigger="hover" title="Atendimentos" data-placement="top"
                       data-content="Essa atribuição da acesso aos relatórios de agendamentos, pacientes e atendimentos">
                       <i class="fa fa-info-circle fa-lg" aria-hidden="true"></i>
                    </a></label>
                  </div>

                  <div class="col-md-3">
                    <input class="magic-checkbox" type="checkbox" id="Financas"  value="Financas" v-model="atribuicoes"/> 
                    <label for="Financas">Finanças
                    <a href="#" for="Financas" data-toggle="popover" data-trigger="hover" title="Finanças" data-placement="top"
                       data-content="Essa atribuição permite ao usuário gerenciar registros fiscais, pagamentos e  arquivos de contabilidade">
                       <i class="fa fa-info-circle fa-lg" aria-hidden="true"></i>
                    </a></label>
                  </div>    

                  <div class="col-md-3">
                    <input class="magic-checkbox" type="checkbox" id="Admin" value="admin"  v-model="atribuicoes"/> 
                     <label for="Admin">Admin
                       <a href="#" for="Admin" data-toggle="popover" data-trigger="hover" title="Finanças" data-placement="top"
                       data-content="Essa atribuição permite ao usuário gerenciar registros fiscais, pagamentos e  arquivos de contabilidade">
                       <i class="fa fa-info-circle fa-lg" aria-hidden="true"></i>
                    </a></label>
                  </div>
                   <div class="col-md-3">
                    <input class="magic-checkbox" type="checkbox" id="cadastros" value="cadastros" v-model="atribuicoes"/> 
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
import { required, sameAs, minLength, email  } from 'vuelidate/lib/validators'

export default {
  mounted() {
   //this.carregarLoad()
    $(document).ready(function(){
      $('[data-toggle="popover"]').popover();
    });
  },
  data() {
    return {   
      name: '',
      email: '',
      senha: '',
      confirmaSenha: '',
      loading: false,
      atribuicoes: []
    }
  },
  methods: {
    addUser() {
      this.$v.$touch()
      if (this.$v.$invalid) {
        console.log("Preencha os campos necessários!")
      } else {
        let newUser = {
          name: this.name,
          email: this.email,
          password: this.senha
        }

        axios.post('api/user-json',newUser).then(({ data }) => {
          console.log('Funcionou!')
        });

        this.$router.push("/usuarios");

         let toast = this.$toasted.show("Usuário cadastrado com Sucesso!!", { 
          theme: "toasted-primary", 
          position: "bottom-right", 
          duration : 1500
        });

      }
     }
  },
  validations: {
    name: {
      required
    },
    email: {
      required,
      email
    },
    senha: {
      required,
       minLength: minLength(4)
    },
     confirmaSenha: {
      sameAsPassword: sameAs('senha')
    }
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
  p {
    color: red;
  }
</style>
