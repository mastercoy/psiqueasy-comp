<template>
  <div class="form-temp">
    <h4>Filiais</h4>
      <hr>
      <div class="row">
          <div class="col-md-4">
            <button class="btn btn-primary btn-lg mb-3">
              <i class="fa fa-plus-square" aria-hidden="true"></i> Adicionar Filial
            </button>
          </div>
        </div>
    <div v-if="vefNewFilial" class="container container-new">
      <form>
        <div class="form-group">
          <label for="nome"><strong>Nome: </strong></label>
          <input type="text" class="form-control" id="nome" v-model="filial.nome" placeholder="Digite o nome do responsável pela empresa">
        </div>

        <div class="form-group">
          <label for="CNPJ"><strong>Matriz: </strong></label>
          <input type="text" class="form-control" id="CNPJ" v-model="filial.matriz" placeholder="Digite o CNPJ da empresa">
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
    </div> <br>

     <div class="container">
         <table class="table table-sm">
           <thead>
              <tr>
              <th scope="col">Código</th>
              <th scope="col">Nome</th>              
              <th scope="col">Localidade/UF</th>
              <th scope="col"> Editar </th>
              <th scope="col"> Deletar </th>
            </tr>
           </thead>          
          <tbody>
            <tr>              
              <td> 001 </td>
              <td> Loja 2</td>
              <td> Salvador/BA</td>
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
      vefNewFilial: false,
      filial: {
      nome: '',
      matriz: '',
      complemento: ''
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