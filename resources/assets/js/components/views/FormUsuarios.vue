<template>
  <div class="form-temp">
    <h4>Usuários</h4>
    <hr>
    <div class="row">
      <div class="col-md-4">
        <button class="btn btn-primary btn-lg mb-3">
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
          <label for="CNPJ"><strong>Nível de Acesso: </strong></label>
          <input type="text" class="form-control" id="CNPJ" v-model="newUser.nivel" >
          <small id="emailHelp" class="form-text text-muted">Descreva de forma resumida a função definida para o usuário</small>
        </div>

         <hr />
          <div class="row">          
            <div class="col-md-8"></div>
            <div class="col-md-4">
               <button type="button" class="btn btn-default mr-1">Cancelar</button>
               <button type="submit" class="btn btn-success"><i aria-hidden="true" class="fa fa-floppy-o"></i>  <b>Salvar</b> </button>
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
              <td><a class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a></td>                
            </tr>
          </tbody>
         </table>
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
        nivelAcesso: 0,
        aloc: ''
      }
    }
  }

}
</script>

<style scoped>
  .form-temp {
   padding: 20px;
   background-color: rgb(250, 250, 250);
   border-radius: 5px;
  }

  h4 {
    color: rgb(112, 112, 112);
  }
  .container-new {
    border: 1px solid rgb(202, 202, 202);
    border-radius: 5px;
  }
</style>