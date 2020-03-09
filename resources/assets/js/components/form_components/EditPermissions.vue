<template>
  <div>
    <label for="input-group">Alterar o nome do perfil?</label> 
    <!-- <input type="checkbox" id="some-checkbox" checked> -->
     <div class="input-group mb-3">
     <div class="input-group-prepend">
    <div class="input-group-text">      
      <input type="checkbox" aria-label="Checkbox for following text input" v-model=editNomePerfil>
    </div>
  </div>
  <input type="text" class="form-control" aria-label="Text input with checkbox" :disabled="!editNomePerfil" v-model="perfil.nome">
</div>
     <h4>Permissões de acesso do usuário</h4>     
      <hr />     
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
                <input class="magic-checkbox" type="checkbox" id="RF" value="Relatórios Financeiros" @click="checkAll" v-model="checkRF" @change="updateAll"/>
                <label for="RF"> Atendimentos </label>
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
                <input class="magic-checkbox" type="checkbox" id="Pag" value="Pagamentos"  @click="checkAll" v-model="checkRF1" @change="updateAll"/>
                <label for="Pag">Pagamentos</label>
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
            <input class="magic-checkbox" type="checkbox" id="Perf" value="VPerfil" v-model="checkF2" @click="checkAll"/>
            <label for="Perf">Perfis | Permissões</label>       
            <a class="btn btn-default" type="button" @click="iconE = !iconE" data-toggle="collapse" data-target="#collapseAgendamentos" aria-expanded="false" aria-controls="collapseAgendamentos">
               <i :class="[iconE ? 'fa-chevron-up' : 'fa-chevron-down', 'fa']" />
            </a>          
        </div>
        <br />
        <div class="collapse" id="collapseAgendamentos">
          <div class="container vl">
            <div class="container">
              <div class="row">
                <input class="magic-checkbox" type="checkbox" id="Perfil" value="Perfil" @click="checkAll" v-model="checkRF2"  @change="updateAll2"/>
                <label for="Perfil">Perfil</label>
              </div>
                <div class="container">
                  <div>
                    <input class="magic-checkbox" type="checkbox" id="P201" :value='8' v-model="permissoes" @change="updateCheckRF3"/>
                    <label for="P201">Visualizar Perfil</label>
                  </div>
                  <div>
                    <input class="magic-checkbox" type="checkbox" id="P202" :value='9' v-model="permissoes" @change="updateCheckRF3"/>
                    <label for="P202">Remover Perfil</label>
                  </div>
                  <div>
                    <input class="magic-checkbox" type="checkbox" id="P203" :value='10' v-model="permissoes" @change="updateCheckRF3"/>
                    <label for="P203">Visualizar Usuários</label>
                  </div>
                  <div>
                    <input class="magic-checkbox" type="checkbox" id="P204" :value='11' v-model="permissoes" @change="updateCheckRF3"/>
                    <label for="P204">Cadastrar Usuários</label>
                  </div>
                </div>
              <br />
              <div class="row">
                <input class="magic-checkbox" type="checkbox" id="teste21" value="teste21" />
                <label for="teste21">Visualização</label>
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
      </div><hr>

        <div class="container">
          <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
              <router-link to="/usuarios" class="btn btn-default mr-1">Voltar</router-link>
              <button class="btn btn-success" @click="atualizarPerfil">Atualizar</button>
            </div>
          </div>
        </div>
    </div> 
</template>

<script>
export default {
  name: 'PermissoesForm',
  props: ['perfil'],
  mounted() { 
    this.checkboxFinanceiro = document.getElementById("Financeiro");
    this.checkboxAtendimentos = document.getElementById("RF");  // Pag
    this.checkboxPagamentos = document.getElementById("Pag");  
    /***************************** */
    this.checkboxAgendamentos = document.getElementById("Perfil");
     setTimeout(() => {
       let temp = this.perfil;
       this.getPerfilPermissoes();
       },200);      
  },
  data() {
    return {
      checkboxFinanceiro: '',
      checkboxAtendimentos: '',
      checkboxPagamentos: '',
      //
      checkboxAgendamentos: '',
      editNomePerfil: false,
      vefAlerta: false,
      iconF: false,
      iconE: false,
      checkRF: false,
      checkRF1: false,
      checkRF2: false,
      checkF: false,
      checkF2: false,
      permissoes: [],
      tempArry: [],
      presetPerfil: '',
      perfilName: '',
      showPresetPerfil: false,
      labelPerfil: '',
      perfisNew: [],
      p_perfil_user: []
    }
  },
  methods: {
    getPerfilPermissoes() {
      let arratTemp = []; 
      let perfil_test = [];     
        axios.get(`/api/permissoes-perfil-json/${this.perfil.id}`)
          .then(({data}) => {
             arratTemp = data;
            console.log(arratTemp);  
            let i = 0;
            arratTemp.forEach((p) => {
              perfil_test[i] = p.id;
              i++
            });
            console.log(perfil_test);
            this.permissoes = perfil_test;
            this.updateCheckRF2();
            this.updateCheckRF1();
            //this.updateAll();
            //console.log('funciona!');
          }); 
    },    
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
           this.updateAll();
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
           //this.updateAll();
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
          //this.updateAll();
          break;  
        case 'VPerfil' :
          this.tempArr = [8,9,10,11];
          this.checkRF2 = !this.checkRF2;
          this.permissoes = this.permissoes.filter((p) => {
            if(!this.tempArry.includes(p)) return p; 
          });
          if(this.checkRF2) {
            this.permissoes.push(8, 9, 10, 11);
          }

        default :
          console.log('Nenhuma opção');
      }
      // this.$emit('teste', arr)
      //console.log(this.permissoes)  
    },   
    updateCheckRF1() {
      let temp = 0;
      this.permissoes.forEach((p) => {
        if([1,2,3,4].includes(p))
          temp++
      });      
      //console.log(temp)
      if(temp === 0) {        
        this.checkboxAtendimentos.indeterminate = false;
        this.checkboxFinanceiro.indeterminate = true;
        this.checkRF =false;
      } else if(temp === 4) {
        //console.log("AteAoui")
        this.checkRF = true; 
        this.checkboxFinanceiro.indeterminate = true;
        this.checkboxAtendimentos.indeterminate = false;
        }else {
          this.checkboxFinanceiro.indeterminate = true;
          this.checkboxAtendimentos.indeterminate = true;
          this.checkRF = false;
          this.checkF = false;
      }          
       this.updateAll();
    },
    updateCheckRF2() {
     let temp = 0;
      this.permissoes.forEach((p) => {
        if([5, 6, 7].includes(p))
          temp++
      });      
      //console.log(temp)
      if(temp === 0) {        
        this.checkboxPagamentos.indeterminate = false;
        this.checkboxFinanceiro.indeterminate = true;
        this.checkRF1 =false;
      } else if(temp === 3) {
        //console.log("AteAoui")
        this.checkRF1 = true; 
        this.checkboxFinanceiro.indeterminate = true;
        this.checkboxPagamentos.indeterminate = false;
        }else {
          this.checkboxFinanceiro.indeterminate = true;
          this.checkboxPagamentos.indeterminate = true;
          this.checkRF1 = false;
          //this.checkF = false;
      }          
      this.updateAll();
    },
    updateCheckRF3() {
      let temp = 0;
      this.permissoes.forEach((p) => {
        if([8, 9, 10, 11].includes(p))
          temp++
      });      
      console.log(temp)
      if(temp === 0) {        
        this.checkboxPagamentos.indeterminate = false;
        this.checkboxFinanceiro.indeterminate = true;
        this.checkRF1 =false;
      } else if(temp === 3) {
        //console.log("AteAoui")
        this.checkRF1 = true; 
        this.checkboxFinanceiro.indeterminate = true;
        this.checkboxPagamentos.indeterminate = false;
        }else {
          this.checkboxFinanceiro.indeterminate = true;
          this.checkboxPagamentos.indeterminate = true;
          this.checkRF1 = false;
          //this.checkF = false;
      }    
    },
    updateAll() {
      let temp = 0;
       this.permissoes.forEach((p) => {
        if([1,2,3,4,5,6,7].includes(p))
          temp++
      });      
      console.log('testando...'+temp)
      if(temp === 0){
       this.checkboxFinanceiro.indeterminate = false;
      } else {
        this.checkboxFinanceiro.indeterminate = true;

        
        if(this.checkRF1 == true && this.checkRF == true){
           this.checkF = true;
           this.checkboxFinanceiro.indeterminate = false;
         }else {
           this.checkF = false;
           //
         }
      }
    },
    updateAll2() {
      console.log('teste...');
    },
    atualizarPerfil() { 
      let pedit = {
        id: this.perfil.id,
        name: this.perfil.nome,
        empresa_id: this.$store.state.empresaID,
        array_permissoes: this.permissoes   //VERIFICAR SE AS PERMISSOES ESCOLHIDAS ATENDEM AS DEMANDAS
      }; 
          //console.log(pedit);
      axios.patch(`/api/user-perfil-json/${pedit.id}`, {name: pedit.name, empresa_id: pedit.empresa_id})
                .then(({data}) => {
                  //console.log(pedit.array_permissoes);                   
               });
      axios.patch(`/api/sync-permissoes-perfil/${pedit.id}`, pedit.array_permissoes)
                    .then(({data}) => {
                      //console.log(data);    
                       this.$router.push("/usuarios");
                    });

           let toast = this.$toasted.success("As permissões foram atualizadas com Sucesso!!", {
                      iconPack: 'fontawesome',
                      icon: "fa-exclamation-circle",
                      theme: "bubble", 
                      position: "bottom-right", 
                      duration : 1500
                      });

       
    }
  }
}
</script>