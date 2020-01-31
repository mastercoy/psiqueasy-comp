<template>
  <div class="form-temp">  
    <div class="row">
      <div class="col-md-9">
          <h4> <i class="fa fa-users" aria-hidden="true"></i> Usuários</h4> 
      </div>
      <div class="col-md-3">
       <router-link to="/usuarios/new" class="btn btn-primary">
          <i class="fa fa-user-plus fa-lg" aria-hidden="true"></i> Novo Usuário
        </router-link>
      </div>
    </div>  <hr>
    <div class="container">
         <table class="table table-sm">
           <thead>
              <tr>
              <th class="th-lg" scope="col">#</th>
              <th class="th-lg" scope="col">Nome</th>
              <th class="th-lg" scope="col">Descrição</th>
              <th class="th-lg" scope="col">Nível de Acesso</th>
              <th class="th-lg" scope="col">Alocação</th>
              <th class="th-lg" scope="col"> Editar </th>
              <th class="th-lg" scope="col"> Deletar </th>
            </tr>
           </thead>
          
          <tbody>
            <tr>
              <td></td>
              <td> Matheus Henrique</td>
              <td>Estagiário do setor de TI</td>
              <td>3</td>
              <td>Matriz</td>
              <td><router-link :to="{name:'EditUsuario', params: {User} }" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i></router-link></td>  
              <td><a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-trash" aria-hidden="true"></i></a></td>                
            </tr>
          </tbody>
         </table>
    </div>

    <!-- <div class="container">
   
    <div class="row">
      <div class="card mb-2 mr-2" style="width: 20rem" >
        <div class="card-body">
          <h5 class="card-title"><strong> Nylo Pinto </strong></h5>
          <h6 class="card-subtitle mb-2 text text-muted">Estagiário do setor de TI</h6>
          <p class="card-text">Nisi ea cillum veniam dolor pariatur sunt ad reprehenderit. 
            Anim cupidatat exercitation quis aliquip aliquip eiusmod nulla ea amet commodo irure ullamco aliqua dolore.
          </p><hr>
            <router-link :to="{name:'EditUsuario', params: {User} }" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i></router-link></td>  
            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-trash" aria-hidden="true"></i></a>    
        </div>        
      </div>

       <div class="card mb-2 mr-2" style="width: 20rem">
        <div class="card-body">         
          <h5 class="card-title"> <strong>Matheus Henrique Oliveira Santos </strong></h5>
          <h6 class="card-subtitle mb-2 text text-muted">Estagiário do setor de TI</h6>
          <p class="card-text">Nisi ea cillum veniam dolor pariatur sunt ad reprehenderit. 
            Anim cupidatat exercitation quis aliquip aliquip eiusmod nulla ea amet commodo irure ullamco aliqua dolore.
          </p><hr>
            <router-link :to="{name:'EditUsuario', params: {User} }" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i></router-link></td>  
            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-trash" aria-hidden="true"></i></a>    
        </div>        
      </div>
      </div>
    </div> -->

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
                  <h5>Voce tem certeza de que deseja deletar o usuário selecionado?</h5>
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
    /* METODO INATIVO
    *   Metodo que retorna todos os usuários cadastrado pela empresa
    *
    *   axios.get(`api/user-json`).then(({ data })  => {
    *    Users = data;
    *    
    *  
    *    });
    * 
    */
  },
  data() {
    return {
      vefCadastro: false,
      editCadastro: false,
      Users: [],
      User: {
        nome: 'Matheus Henrique',
        descricao: 'Estagiário de Ti',
        atribuicoes: ['Financas'],
        aloc: 'Matriz'
      }
    }
  },
  methods: {
    delUser() {
      
    }
  }
}
</script>

<style scoped>
  .form-temp {
   padding: 20px;
   background-color:#fff;
   border-radius: 5px;
  }

  h4 {
    color: rgb(112, 112, 112);
  }
  .container-new {
    border: 1px solid rgb(202, 202, 202);
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 20px;
  }
</style>