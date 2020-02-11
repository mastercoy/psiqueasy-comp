<template>
  <div class="container">
    <div class="form-temp">
      <div class="row">
        <div class="docker">
         <i class="fa fa-user fa-4x" aria-hidden="true"></i>
        
        
          <label>{{ user }}</label>
        
        
          <router-link to="/usuarios/invite">Alterar</router-link>
        </div>
      </div>
    </div>

    <div class="form-temp">
      <div class="container ">
        <h4>Quem terá acesso a esse usuário</h4>
        <hr />
        <div>
          <input class="magic-radio" type="radio" name="radio" id="11" />
          <label for="11">Todos os usuários</label>
        </div>
        <div>
          <input class="magic-radio" type="radio" name="radio" id="21" />
          <label for="21">Apenas o usuário atual</label>
        </div>
      </div>
    </div><br>

    <div class="form-temp">
      <h4>Selecione as permissões de acesso do usuário</h4>
      <hr />
      <!-- <label>Marcas todos</label><br> -->
      <button type="button" class="btn btn-link mb-1">Marcas todos</button>
      <br />
      <div class="container">
        <div class="parent">         
            <input class="magic-checkbox" type="checkbox" id="Financeiro" value="Financeiro" @click="checkAll" v-model="checkF"/>
            <label for="Financeiro">Financeiro</label>       
            <a class="btn btn-default" @click="iconF = !iconF" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
               <i :class="[iconF ? 'fa-chevron-up' : 'fa-chevron-down', 'fa']" />
            </a>          
        </div>
        <br />
        <div class="collapse" id="collapseExample">
          <div class="container vl">
            <div class="container">
              <div class="row">
                <input class="magic-checkbox" type="checkbox" id="teste" value="Relatórios Financeiros" @click="checkAll" v-model="checkRF" />
                <label for="teste"> Relatórios Financeiros</label>
              </div>
              <div class="container">
                <div>
                  <input class="magic-checkbox" type="checkbox" id="op1" value="op1"  v-model="permissoesRF1" @change="updateCheckRF1" />
                  <label for="op1">Cadastrar relatórios financeiros</label>
                </div>
                <div>
                  <input class="magic-checkbox" type="checkbox" id="op2" value="op2" v-model="permissoesRF1" @change="updateCheckRF1" />
                  <label for="op2">Editar relatórios financeiros</label>
                </div>
                <div>
                  <input class="magic-checkbox" type="checkbox" id="op3" value="op3" v-model="permissoesRF1" @change="updateCheckRF1"/>
                  <label for="op3">Deletar relatórios financeiros</label>
                </div>
              </div>
              <br />
              <div class="row">
                <input class="magic-checkbox" type="checkbox" id="teste21" value="Pagamentos"  @click="checkAll" v-model="checkRF1"/>
                <label for="teste21">Pagamentos</label>
              </div>
                <div class="container">
                  <div>
                    <input class="magic-checkbox" type="checkbox" id="teste1" value="teste1"  v-model="permissoesRF2" @change="updateCheckRF2"/>
                    <label for="teste1">Visualizar Pagamentos</label>
                  </div>
                  <div>
                    <input class="magic-checkbox" type="checkbox" id="teste2" value="teste2"  v-model="permissoesRF2"  @change="updateCheckRF2"/>
                    <label for="teste2">Agendar Pagamentos</label>
                  </div>
                  <div>
                    <input class="magic-checkbox" type="checkbox" id="teste3" value="teste3"  v-model="permissoesRF2"  @change="updateCheckRF2"/>
                    <label for="teste3">Gerar relaórios de pagamentos</label>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div> 

       <div class="container">
        <div class="parent">         
            <input class="magic-checkbox" type="checkbox" id="Agendamentos" value="Agendamentos" />
            <label for="Agendamentos">Agendamentos</label>       
            <a class="btn btn-default" type="button" @click="iconE = !iconE" data-toggle="collapse" data-target="#collapseAgendamentos" aria-expanded="false" aria-controls="collapseAgendamentos">
               <i :class="[iconE ? 'fa-chevron-up' : 'fa-chevron-down', 'fa']" />
            </a>          
        </div>
        <br />
        <div class="collapse" id="collapseAgendamentos">
          <div class="container vl">
            <div class="container">
              <div class="row">
                <input class="magic-checkbox" type="checkbox" id="teste" value="teste" />
                <label for="teste">Teste11</label>
              </div>
                <div class="container">
                  <div>
                    <input class="magic-checkbox" type="checkbox" id="Teste1" value="teste1" />
                    <label for="teste1">Teste1</label>
                  </div>
                  <div>
                    <input class="magic-checkbox" type="checkbox" id="Teste2" value="Teste2" />
                    <label for="Teste2">Teste2</label>
                  </div>
                  <div>
                    <input class="magic-checkbox" type="checkbox" id="Teste3" value="Teste3" />
                    <label for="Teste3">Teste3</label>
                  </div>
                </div>
              <br />
              <div class="row">
                <input class="magic-checkbox" type="checkbox" id="teste21" value="teste21" />
                <label for="teste21">Teste21</label>
              </div>
              <div class="container">
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste1" value="teste1" />
                  <label for="teste1">Teste1</label>
                </div>
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste2" value="Teste2" />
                  <label for="Teste2">Teste2</label>
                </div>
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste3" value="Teste3" />
                  <label for="Teste3">Teste3</label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>   

     

       <div class="collapse" id="collapseExample1">
          <div class="container vl">
            <div class="container">
              <div class="row">
                <input class="magic-checkbox" type="checkbox" id="teste" value="teste" />
                <label for="teste">Teste11</label>
              </div>
              <div class="container">
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste1" value="teste1" />
                  <label for="teste1">Teste1</label>
                </div>
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste2" value="Teste2" />
                  <label for="Teste2">Teste2</label>
                </div>
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste3" value="Teste3" />
                  <label for="Teste3">Teste3</label>
                </div>
              </div>
              <br />
              <div class="row">
                <input class="magic-checkbox" type="checkbox" id="teste21" value="teste21" />
                <label for="teste21">Teste21</label>
              </div>
              <div class="container">
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste1" value="teste1" />
                  <label for="teste1">Teste1</label>
                </div>
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste2" value="Teste2" />
                  <label for="Teste2">Teste2</label>
                </div>
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste3" value="Teste3" />
                  <label for="Teste3">Teste3</label>
                </div>
              </div>
            </div>
          </div>
        </div>

       <div class="container">
        <div class="parent">         
            <input class="magic-checkbox" type="checkbox" id="Pacientes" value="Pacientes" />
            <label for="Pacientes">Pacientes</label>       
            <!-- <a class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
               <i class="fa fa-chevron-down" aria-hidden="true"></i>
            </a>           -->
        </div>
      </div>
    </div>

    <div class="form-temp">
      <h4>
        Crie um perfil com essas permissões 
        <a href="#" for="Admin" data-toggle="popover" data-trigger="hover" title="Finanças" data-placement="top"
                data-content="Essa funcionalidade permite que voce salve as permissões selecionadas em um perfil, para que possa ser reutilizada posteriormente.">
                 <i class="fa fa-info-circle fa-lg" aria-hidden="true"></i>
             </a>
      </h4><hr>

     <div class="container">
        <div class="form-group">
          <label for="Perfil" class="pf">
            Nome do Perfil:              
          </label>
          <input type="text" class="form-control" id="Perfil" placeholder="Exemplo: Secretária, Administração Financeira" v-model="presetPerfil">
           <small id="perfilHelp" class="form-text text-muted">Esse campo é opcional.</small>
        </div>
     </div>
      <hr>
      <div class="row">
        <div class="col-md-8"></div>
        <div class="col-md-4">
          <button class="btn btn-deafult mr-1">Voltar</button>
          <button class="btn btn-primary" @click="getPermissoes">Continuar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["user"],
  mounted() {
     $(document).ready(function(){
      $('[data-toggle="popover"]').popover();

      //Metodo para carregar os perfis salvos!
    });
  },
  data() {
    return { 
      iconF: false,
      iconE: false,
      checkRF: false,
      checkRF1: false,
      checkF: false,
      permissoesRF1: [],
      permissoesRF2: [],
      presetPerfil: '',
       
    };
  },
  methods: {
    getPermissoes() {
      let var1 = this.permissoesRF1;
      let var2 = this.permissoesRF2
      let arrayPermissoes = [];

      arrayPermissoes = var1;
      arrayPermissoes = [...arrayPermissoes, var2];
      console.log(this.user + " " + arrayPermissoes + " " + this.presetPerfil );
    },
    checkAll(e) {

      switch (e.target.value) {
        case 'Financeiro' :
          this.checkF = !this.checkF;                    
          this.permissoesRF1 = [];
          this.permissoesRF2 = [];
          if(this.checkF) { 
            this.checkRF1 = true;  
            this.checkRF = true;                
            this.permissoesRF1 = ["op1", "op2", "op3"];
            this.permissoesRF2 = ["teste1", "teste2", "teste3"];        
          }else {
            this.checkRF = false;
            this.checkRF1 = false;
          }
          break;
        case 'Relatórios Financeiros' :
          //console.log("Relatórios Financeiros");
          this.checkRF = !this.checkRF;
          this.permissoesRF1 = [];
          if (this.checkRF) {
            this.permissoesRF1 = ["op1", "op2", "op3"]
          }
          break;
        case 'Pagamentos' :
          console.log('Pagamentos');
           this.checkRF1 = !this.checkRF1;
          this.permissoesRF2 = [];
          if (this.checkRF1) {
            this.permissoesRF2 = ["teste1", "teste2", "teste3"]
          }
          break;
        default :
          console.log('Nenhuma opção');
      }
    },
    updateCheckRF1() {
      //Método para verificar todas as chechboxs
      if (this.permissoesRF1  == 3) {
        this.checkRF = true;
      } else {
        this.checkRF = false;
      }
      if( this.permissoesRF1 === 3 && this.permissoesRF2 === 3 ){
        this.checkF = true;
      }else {
        this.checkF = false;
      }
    },
    updateCheckRF2() {
      //Método para verificar todas as chechboxs
      if (this.permissoesRF2  == 3) {
        this.checkRF1 = true;
      } else {
        this.checkRF1 = false;
      }
      if( this.permissoesRF1 === 3 && this.permissoesRF2 === 3 ){
        this.checkF = true;
      }else {
        this.checkF = false;
      }
    },
   }
}
</script>

<style>
.form-temp {
  margin-bottom: 30px;
}

.parent {
  padding: 10px;
  width: 100%;
  display: flex;
  justify-content: space-between;
  background-color: #eee;
  border-radius: 5px;
}

.vl {
  border-left: 3px solid #eee;
  height: 300px;
  margin-bottom: 30px;
}

.container-n1 {
  padding: 20px;
} 

.pf {
  color: rgb(112, 112, 112);
}

.docker {
  padding: 20px;
  width: 100%;
  display: flex;
  justify-content: space-between;
  vertical-align: middle;
}

</style>