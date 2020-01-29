<template>
  <div class="form-temp">
    <h4>Usuários</h4>
    <hr>
    <div class="row">
      <div class="col-md-4">
        <button class="btn btn-primary btn-lg mb-3" @click="vefCadastro = true">
          <i class="fa fa-plus-square" aria-hidden="true"></i> Adicionar Usuário
        </button>
      </div>
    </div>
    <div v-if="vefCadastro" class="container container-new">
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

          <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong> You should check in on some of those fields below.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> -->
  
          <div class="container">
            <h5>Atribuições: </h5>
                <div class="row">
                  <div class="col-md-3">
                    <input class="magic-checkbox" type="checkbox" id="Agendamentos" value="Agendamentos" v-model="newUser.atribuicoes" /> 
                    <label for="Agendamentos">Agendamentos</label>
                  </div>
                  <div class="col-md-3">
                    <input class="magic-checkbox" type="checkbox" id="Financas"  value="Financas" v-model="newUser.atribuicoes"/> 
                    <label for="Financas">Financas</label>
                  </div>
                  <div class="col-md-3">
                    <input class="magic-checkbox" type="checkbox" id="cadastros" value="cadastros" v-model="newUser.atribuicoes"/> 
                    <label for="cadastros">Cadastros</label>
                  </div>
                  <div class="col-md-3">
                    <input class="magic-checkbox" type="checkbox" id="Admin" value="admin"  v-model="newUser.atribuicoes"/> 
                     <label for="Admin">Admin</label>
                  </div>
                </div>   
          </div>       
        </div>

         <hr />
          <div class="row">          
            <div class="col-md-8"></div>
            <div class="col-md-4">
               <button type="button" class="btn btn-default mr-1" @click="vefCadastro = false">Cancelar</button>
               <button type="button" class="btn btn-success" @click="addUser"><i aria-hidden="true" class="fa fa-floppy-o"></i>  <b>Salvar</b> </button>
            </div>
          </div>
          <br>
      </form>
    </div><br>
    <div class="container">
         <table class="table table-sm">
           <thead>
              <tr>
              <th scope="col">#</th>
              <th scope="col">Nome</th>
              <th scope="col">Descrição</th>
              <th scope="col">Nível de Acesso</th>
              <th scope="col">Alocação</th>
              <th scope="col"> Editar </th>
              <th scope="col"> Deletar </th>
            </tr>
           </thead>
          
          <tbody>
            <tr>
              <td></td>
              <td> Matheus Henrique</td>
              <td>Estagiário do setor de TI</td>
              <td>3</td>
              <td>Matriz</td>
              <td><a class="btn btn-warning btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>  
              <td><a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-trash" aria-hidden="true"></i></a></td>                
            </tr>
          </tbody>
         </table>
    </div>

    <!-- Modal para comfirmação de deletar -->
          <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <h5>Voce tem certeza de que deseja deletar a filial selecionada?</h5>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-danger">Continuar</button>
                </div>
              </div>
            </div>
          </div>

  </div>
</template>

<script>
export default {
  data() {
    return {
      vefCadastro: false,
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
      console.log(this.newUser)
      this.vefCadastro = false
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
  }
</style>