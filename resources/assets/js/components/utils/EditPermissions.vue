<template>
  <div>
    <label for="input-group">Alterar o nome do perfil?</label>
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
                    <input class="magic-checkbox" type="checkbox" id="P201" value="1" v-model="permissoesBloco2"/>
                    <label for="P201">Visualizar Perfil</label>
                  </div>
                  <div>
                    <input class="magic-checkbox" type="checkbox" id="P202" value="2" v-model="permissoesBloco2"/>
                    <label for="P202">Remover Perfil</label>
                  </div>
                  <div>
                    <input class="magic-checkbox" type="checkbox" id="P203" value="3" v-model="permissoesBloco2"/>
                    <label for="P203">Visualizar Usuários</label>
                  </div>
                  <div>
                    <input class="magic-checkbox" type="checkbox" id="P204" value="4" v-model="permissoesBloco2"/>
                    <label for="P204">Cadastrar Usuários</label>
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
    setTimeout(() => {
      let temp = this.perfil;
      //console.log(temp);  
      this.getPerfilPermissoes();
    },500);  

    // console.log(perfil_test);  
  },
  data() {
    return {
      editNomePerfil: false,
      vefAlerta: false,
      iconF: false,
      iconE: false,
      checkRF: false,
      checkRF1: false,
      checkF: false,
      permissoesRF1: [],
      permissoesRF2: [],
      permissoesBloco2: [],
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
            console.log(data);  
            
          for(let i = 0; i <= arratTemp.lenght; i++){
            perfil_test[i] = arratTemp[i].id;
          }          
          });   
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
      let arr = this.permissoesRF1 + this.permissoesRF2
      this.$emit('teste', arr)
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
    atualizarPerfil() {
      console.log(this.perfil);
      let pedit = {
        id: this.perfil.id,
        name: this.perfil.nome,
        empresa_id: this.$store.state.empresaID,
        array_permissoes: [...this.permissoesRF1 , ...this.permissoesRF2, ...this.permissoesBloco2]
      }; 
      console.log(pedit);
      //  axios.put(`/api/user-perfil-json/${pedit.id}`, pedit)
      //   .then(({data}) => {
      //     console.log(data);
      //   });
    }
  }
}
</script>