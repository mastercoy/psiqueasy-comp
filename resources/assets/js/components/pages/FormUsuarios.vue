<template>
<div>
  <div class="form-temp">  
    <div class="row">
      <div class="col-md-9">
          <h4> <i class="fa fa-users" aria-hidden="true"></i> Usuários</h4> 
      </div>
      <div class="col-md-3">
       <router-link to="/usuarios/invite" class="btn btn-primary">
          <i class="fa fa-user-plus fa-lg" aria-hidden="true"></i> Novo Usuário
        </router-link>
      </div>
    </div>  <hr>
    <div class="container">
      <div class="table-responsive">
         <table class="table table-sm">
           <thead>
              <tr>
              <!-- <th class="th-lg" scope="col">#</th> -->
              <th class="th-lg" scope="col">Nome</th>
              <th class="th-lg" scope="col">Email</th>
              <!-- <th class="th-lg" scope="col">Status de Verificação</th> -->
              <th class="th-lg" scope="col"> Editar </th>
              <th class="th-lg" scope="col"> Deletar </th>
            </tr>
           </thead>
          
          <tbody>
            <tr v-for="user in users" :key="user.id">
              <!-- <td></td> -->
              <td> {{ user.name }}</td>
              <td>{{ user.email }}</td>
              <!-- <td v-bind:class="{'ativo': user.emailStatus === 1, 'pendente': user.emailStatus === 0, 'expirado': user.emailStatus === 2}">{{ user.vefEmail}}</td> -->
              <td><router-link :to="{name:'EditUsuario', params: {user} }" class="btn btn-sm btn-warning"><i class="fa fa-pencil-square" aria-hidden="true"></i></router-link></td>
              <!-- <td v-if="user.emailStatus === 1"
                v-else-if="user.emailStatus === 0">
                <button class="btn btn-sm btn-warning" disabled><i class="fa fa-pencil-square" aria-hidden="true"></i></button>
              </td>  -->
              <!-- <td 
                v-else-if="user.emailStatus === 2">
                <a @click="reenviarEmail" 
                class="btn btn-secondary btn-sm" 
                data-toggle="popover" data-trigger="hover" title="OBS" data-placement="bottom" data-content="Tempo expirado do convite, clique para enviar novamente"
                ><i class="fa fa-refresh" aria-hidden="true"></i> </a>
              </td>  -->
              <td><a @click="selectUser = user.nome" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-trash" aria-hidden="true"></i></a></td>                
            </tr>
          </tbody>
         </table>
        </div>
    </div>    
  </div><!-- fim form-temp -->
  <br>

    <div class="form-temp">
          <h4><i class="fa fa-tasks" aria-hidden="true"></i> Perfis</h4>
          <hr>
          <div class="container">
            <div class="row">
              <div class="col-md-12" >
                <div>
                  <section v-for="perf in perfisNew" :key="perf.id">
                    <div class="row">
                     <div class="col-md-10">
                       <strong id="nperfil">{{perf.nome}}</strong>
                        <small id="nperfilHelp" class="form-text text-muted">Usuários: {{ perf.quantidade}}</small> 
                     </div>                      
                        <div class="col-md-2">
                          <router-link class="btn btn-sm btn-secondary" :to="{ name: 'editProfile', params: { perf } }">
                            <i class="fa fa-plus" aria-hidden="true"></i>                            
                          </router-link>                         
                     </div>                      
                    </div><hr>
                  </section>
                </div>           
              </div>    
            </div>
          </div>
        </div>  
    
       <!-- Modal para comfirmação de deletar -->
          <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Deletar Usuário</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <h5>Voce tem certeza de que deseja deletar o usuário {{ selectUser }} ?</h5>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-danger" @click="delUser">Continuar</button>
                </div>
              </div>
            </div>
          </div>
  </div>

  
</template>

<script>
export default {
  mounted(){ 
    let temp = 0;
     //Metodo para carregar os perfis salvos!
      axios.get("/api/user-perfil-json").then(({data}) => {
        //console.log(data);
        this.perfis = data;
        //console.log(this.perfis[0].name);
        for(let i=0; i <= this.perfis.length; i++) {
          if(typeof this.perfis[i] === "object") {
            this.perfisNew[temp] = {
              id: this.perfis[i].id,
              nome: this.perfis[i].name,
              quantidade: this.perfis[i + 1]  
            }
            temp++;
          }        
        }
        console.log(this.perfisNew);  //Modificar depois **      
      });   
        
    axios.get('/api/user-json').then(({data}) => {
      this.users = data;  
      console.log(data);    
    });

    ;  
  },
  data() {
    return {
      perfisNew: [],
      perfis: [],
      selectUser: '',
      vefCadastro: false,
      editCadastro: false,
      users: [],
    }
  },
  methods: {
    delUser() {
      let toast = this.$toasted
                  .error("O usuário foi deletado com sucesso!!", 
                {
                  iconPack: 'fontawesome',
                  icon: "fa-exclamation-circle",
                  theme: "bubble", 
                  position: "bottom-right", 
                  duration : 1500
                });
      $('#exampleModalCenter').modal('hide');
    },
    reenviarEmail() {
      console.log("Funciona!");
    },
    carregaPerfis() { 
      
    }
  }
}
</script>

<style scoped>
  .ativo {
    font-weight: bold;
    color: greenyellow;
  }

  .pendente {
    font-weight: bold;
    color: red;
  }

   .expirado {
    font-weight: bold;
    color: grey;
  }
  
</style>