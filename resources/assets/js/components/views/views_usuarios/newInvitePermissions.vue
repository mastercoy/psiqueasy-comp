<template>
  <div class="container">
    <div class="form-temp">

      <div v-if="vefAlerta" class="alert alert-warning alert-dismissible fade show" role="alert">
        Voce não os campos corretamente, por favor complete o formulário e tente novamente!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="row">
        <div class="docker">
         <i class="fa fa-user fa-4x" aria-hidden="true"></i>
        
        
          <label>{{ emailUser }}</label>
        
        
          <router-link to="/usuarios/invite">Alterar</router-link>
        </div>
      </div>
    </div>

    <div class="form-temp">
      <div class="container ">
        <h4>Como deseja associar as permissoes ao usuário</h4>               
        <hr />
        <div class="row">
          <div class="col md-6">
            <div>
              <input class="magic-radio" type="radio" name="radio" id="11" value="old" v-model="showPresetPerfil">
              <label for="11">Utilizar um perfil já criado</label>
            </div>
          </div>
          <div class="col md-6">
            <div>
              <input class="magic-radio" type="radio" name="radio" id="12" value="new" v-model="showPresetPerfil">
              <label for="12">Criar um novo Pefil</label>
            </div>
          </div>
          <div>       
        </div>
       </div>               
      
      </div>
    </div>

    <div class="form-temp" v-if="showPresetPerfil === 'old' ">
          <div class="container">
             <div  class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <select class="form-control" v-model="presetPerfil" :disabled="!showPresetPerfil" >
                    <option v-for="perf in perfisNew" :key="perf.id">
                    <option > {{ perf.nome }}</option>                    
                    </option>
                  </select>
                </div>
              </div>
            </div>  
          </div>
        </div>

    <div class="form-temp" v-if="showPresetPerfil === 'new' ">

        <h4>Nome do Perfil <span> * </span></h4>
        <hr>

      <div class="container">
          <div class="form-group">
            <input 
              type="text" 
              class="form-control" 
              v-bind:class="{ 'is-invalid': $v.labelPerfil.$error}" 
              id="Perfil" 
              placeholder="Exemplo: Secretária, Administração Financeira" 
              v-model="$v.labelPerfil.$model" >
              <span v-if="$v.labelPerfil.$error"> O campo é obrigatório </span>
             <small id="perfilHelp" class="form-text text-muted">Esse campo é o identificador do perfil de usuário a ser criado.</small> 
          </div>
      </div>
          

      <h4>Selecione as permissões de acesso do usuário</h4>     
      <hr />
     
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
          <div class="overflow-auto">
          <div class="container vl">
            <div class="container">
              <div class="row">
                <input class="magic-checkbox" type="checkbox" id="teste" value="Relatórios Financeiros" @click="checkAll" v-model="checkRF" @change="updateAll"/>
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
                <input class="magic-checkbox" type="checkbox" id="teste21" value="Pagamentos"  @click="checkAll" v-model="checkRF1" @change="updateAll"/>
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
        </div>
      </div>
    </div>

    <!-- <div class="form-temp">
     <div class="container-new">
      
    </div> 
    </div> -->

    <div class="row">
        <div class="col-md-8"></div>
          <div class="col-md-4">
            <button class="btn btn-deafult mr-1">Voltar</button>
            <button class="btn btn-primary" @click="getPermissoes">Continuar <i class="fa fa-arrow-right" aria-hidden="true"></i> </button>
          </div>
      </div>
   <br>
  </div>
</template>

<script>
import { required } from 'vuelidate/lib/validators'
export default {
  props: ["emailUser"],
  mounted() {
     $(document).ready(function(){
      $('[data-toggle="popover"]').popover();

      //Metodo para carregar os perfis salvos!
    });

    this.carregaPerfis();
  },
   validations: {
    labelPerfil: {required}
  },
  data() {
    return { 
      userInvite: {
        email: '',
        permissoes: '',
        label: '',
        selectedPerfil: ''
      },
      vefAlerta: false,
      iconF: false,
      iconE: false,
      checkRF: false,
      checkRF1: false,
      checkF: false,
      permissoesRF1: [],
      permissoesRF2: [],
      presetPerfil: '',
      perfilName: '',
      showPresetPerfil: false,
      labelPerfil: '',
      perfisNew: []
       
    };
  },
  methods: {
    getPermissoes() {
      let toast;
      let checkPerfil = '';      
      let var1 = this.permissoesRF1;
      let var2 = this.permissoesRF2
      let arrayPermissoes = [];
      let newp = {
                name: this.labelPerfil,
                empresa_id: this.$store.state.empresaID
              }

      arrayPermissoes = var1 + var2;
      this.userInvite.email = this.user;
      this.userInvite.permissoes = arrayPermissoes;
      this.userInvite.label = this.labelPerfil;

      switch(this.showPresetPerfil) {
        case 'old' :
          if(this.presetPerfil === ''){
            console.log('Por favor selecione um perfil para o usuário!');

             let toast = this.$toasted
                  .error("Por favor selecione um perfil para o usuário!", 
                {
                  iconPack: 'fontawesome',
                  icon: "fa-exclamation-circle",
                  theme: "bubble", 
                  position: "bottom-right", 
                  duration : 1500
                });
          }else {
              toast = this.$toasted.success("O convite para o usuário foi criado com Sucesso!!", {
              iconPack: 'fontawesome',
              icon: "fa-exclamation-circle",
              theme: "bubble", 
              position: "bottom-right", 
              duration : 1500
              });
            this.$router.push("/usuarios");
          }
          break;
        case 'new' :
          this.$v.$touch()
          if (this.$v.$invalid) {
            console.log("Preencha os campos necessários!")
          } else {
              if(this.userInvite.permissoes === ''){
                let toast = this.$toasted
                  .error("As opções de permissões não foram preenchidas corretamente, por favor verifique os campos e tente novamente!!", 
                {
                  iconPack: 'fontawesome',
                  icon: "fa-exclamation-circle",
                  theme: "bubble", 
                  position: "bottom-right", 
                  duration : 1500
                });
             } else {          
              //console.log(this.userInvite);
              
              //console.log(newp)
              axios.post('/api/user-perfil-json', newp)
                .then(({data}) => {
                  checkPerfil = data;    
                  
                   if(checkPerfil === 'já existe') {
                      toast = this.$toasted.error("O nome escolhido para o perfil já existe! Por favor digite outro nome", {
                      iconPack: 'fontawesome',
                      icon: "fa-exclamation-circle",
                      theme: "bubble", 
                      position: "bottom-right", 
                      duration : 2000
                      });
                    }else {
                      toast = this.$toasted.success("O perfil para o usuário convidado, foi criado com Sucesso!!", {
                      iconPack: 'fontawesome',
                      icon: "fa-exclamation-circle",
                      theme: "bubble", 
                      position: "bottom-right", 
                      duration : 2000
                    });
                    
                    }

                    this.$router.push("/usuarios");

                    axios.post(`/api/setar-permissoes/${checkPerfil}`)
                      .then(({data}) => {
                        
                      });
              });
              
             
            } 
          }
          break;
        default: 
        console.log('teste');
      }     
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
        this.checkF = false;
      }
      
    },
    updateCheckRF2() {
      //Método para verificar todas as chechboxs
      if (this.permissoesRF2  == 3) {
        this.checkRF1 = true;
      } else {
        this.checkRF1 = false;
        this.checkF = false;
      }
    },
    updateAll() {
      if(this.checkRF1 == true && this.checkRF == true){
        this.checkF = true;
      }else {
        this.checkF = false;
      }
    },
    carregaPerfis() { 
     let temp = 0;
     let perfis = [];
     //Metodo para carregar os perfis salvos!
      axios.get("/api/user-perfil-json").then(({data}) => {
        console.log(data);
        perfis = data;
        //console.log(this.perfis[0].name);
        for(let i=0; i <= perfis.length; i++) {
          if(typeof perfis[i] === "object") {
            this.perfisNew[temp] = {
              id: perfis[i].id,
              nome: perfis[i].name, 
              quantidade: perfis[i + 1]  
            }
            temp++;
          }        
        }
        console.log(this.perfisNew);  //Modificar depois **      
      });    
    }
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