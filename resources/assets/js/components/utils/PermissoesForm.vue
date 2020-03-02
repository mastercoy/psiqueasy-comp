<template>
  <div>
     <h4>Selecione as permissões de acesso do usuário</h4>     
      <hr />     
      <button type="button" class="btn btn-link mb-1">Marcas todos</button>      
      <br />      
      <div class="container">
        <div class="parent">         
            <input class="magic-checkbox" type="checkbox" id="Financeiro" value="Financeiro" @click="checkAll" v-model="checkF"/>
            <label for="Financeiro">Atendimento | Pagamento</label>       
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
                <label for="teste"> Atendimentos</label>
              </div>
              <div class="container">
                <div>
                  <input class="magic-checkbox" type="checkbox" id="P101" :value='1'  v-model="permissoes" @change="updateCheckRF1" />
                  <label for="P101"> Visualizar atendimentos</label> 
                </div>  
                <div>
                  <input class="magic-checkbox" type="checkbox" id="P102" :value='2' v-model="permissoes" @change="updateCheckRF1" />
                  <label for="P102">Editar atendimento</label>
                </div>
                <div>
                  <input class="magic-checkbox" type="checkbox" id="P103" :value='3' v-model="permissoes" @change="updateCheckRF1"/>
                  <label for="P103">Cancelar atendimento</label>
                </div>
                <div>
                  <input class="magic-checkbox" type="checkbox" id="P107" :value='4' v-model="permissoes" @change="updateCheckRF1"/>
                  <label for="P107">Agendar Atendimento</label>
                </div>
              </div>
              <br />
              <div class="row">
                <input class="magic-checkbox" type="checkbox" id="teste21" value="Pagamentos"  @click="checkAll" v-model="checkRF1" @change="updateAll"/>
                <label for="teste21">Pagamentos</label>
              </div>
                <div class="container">
                  <div>
                    <input class="magic-checkbox" type="checkbox" id="P104" :value='5' v-model="permissoes" @change="updateCheckRF2"/>
                    <label for="P104">Cadastrar Pagamentos</label>
                  </div>
                  <div>
                    <input class="magic-checkbox" type="checkbox" id="P105" :value='6'  v-model="permissoes" @change="updateCheckRF2"/>
                    <label for="P105">Visualizar status de Pagamento</label>
                  </div>
                  <div>
                    <input class="magic-checkbox" type="checkbox" id="P106" :value='7'  v-model="permissoes"  @change="updateCheckRF2"/>
                    <label for="P106">Gerar relaórios de pagamentos</label>
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
            <label for="Agendamentos">Perfis | Permissões</label>       
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
                <label for="teste">Perfil</label>
              </div>
                 <div class="container">
                  <div>
                    <input class="magic-checkbox" type="checkbox" id="P201" :value='8' v-model="permissoes"/>
                    <label for="P201">Visualizar Perfil</label>
                  </div>
                  <div>
                    <input class="magic-checkbox" type="checkbox" id="P202" :value='9' v-model="permissoes"/>
                    <label for="P202">Remover Perfil</label>
                  </div>
                  <div>
                    <input class="magic-checkbox" type="checkbox" id="P203" :value='10' v-model="permissoes"/>
                    <label for="P203">Visualizar Usuários</label>
                  </div>
                  <div>
                    <input class="magic-checkbox" type="checkbox" id="P204" :value='11' v-model="permissoes"/>
                    <label for="P204">Cadastrar Usuários</label>
                  </div>
                </div>
              <br />
              <div class="row">
                <input class="magic-checkbox" type="checkbox" id="teste21" value="teste21" />
                <label for="teste21">Relatórios</label>
              </div>
              <div class="container">
                <div>
                  <input class="magic-checkbox" type="checkbox" id="P206" :value='12' />
                  <label for="P206">Visualizar Relatórios</label>
                </div>
                <div>
                  <input class="magic-checkbox" type="checkbox" id="P207" :value='13' />
                  <label for="P207">Gerar novos relarórios</label>
                </div>
                <div>
                  <input class="magic-checkbox" type="checkbox" id="P205" :value='14' />
                  <label for="Teste3">Deletar relatórios</label>
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

      <hr>

       
    </div> 
</template>

<script>
export default {
  name: 'PermissoesForm',
  mounted() {
  },
  data() {
    return {
      vefAlerta: false,
      iconF: false,
      iconE: false,
      checkRF: false,
      checkRF1: false,
      checkF: false,
      permissoes: [],
      tempArry: [],
      presetPerfil: '',
      perfilName: '',
      showPresetPerfil: false,
      labelPerfil: '',
      perfisNew: []
    }
  },
  methods: {
     checkAll(e) {
      switch (e.target.value) {
        case 'Financeiro' :
          this.tempArry = [1, 2, 3, 4, 5, 6, 7]
          this.checkF = !this.checkF;          
          this.permissoes = this.permissoes.filter((p) => {
            if(!this.tempArry.includes(p)) return p; 
          });
          if(this.checkF) { 
            this.checkRF1 = true;  
            this.checkRF = true;                
            this.permissoes.push(1, 2, 3, 4, 5, 6, 7);       
          }else {
            this.checkRF = false;
            this.checkRF1 = false;
          }
          break;
        case 'Relatórios Financeiros' :
           this.tempArry = [1, 2, 3, 4]
          this.checkRF = !this.checkRF;
          this.permissoes = this.permissoes.filter((p) => {
            if(!this.tempArry.includes(p)) return p; 
          });
          if (this.checkRF) {
            this.permissoes.push(1, 2, 3, 4);
          }
          break;

        case 'Pagamentos' :
          this.tempArry = [5, 6, 7]
          this.checkRF1 = !this.checkRF1;
           this.permissoes = this.permissoes.filter((p) => {
            if(!this.tempArry.includes(p)) return p; 
          });
          if (this.checkRF1) {
            this.permissoes.push(5, 6, 7);
          }
          break;          
        default :
          console.log('Nenhuma opção');
      }
       this.$emit('teste', this.permissoes)
      //console.log(this.permissoes)  
    },   
    updateCheckRF1() {
     this.permissoes.includes([1, 2, 3, 4]) ?
        this.checkRF = true :
          this.checkRF = false
          this.checkF = false;

          
      this.$emit('teste', this.permissoes)
    },
    updateCheckRF2() {
     this.permissoes.includes([5, 6, 7]) ?
        this.checkRF1 = true :      
          this.checkRF1 = false
          this.checkF = false;

      this.$emit('teste', this.permissoes)
    },
    updateAll() {
      if(this.checkRF1 == true && this.checkRF == true){
        this.checkF = true;
      }else {
        this.checkF = false;
      }
    },
  }
}
</script>

<style scoped>
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