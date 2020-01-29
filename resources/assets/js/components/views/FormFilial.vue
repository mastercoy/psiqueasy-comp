<template>
  <div class="form-temp">
    <h4>Filiais</h4>
      <hr>
      <div class="row">
          <div class="col-md-4">
            <button class="btn btn-primary btn-lg mb-3" @click="vefNewFilial = true">
              <i class="fa fa-plus-square" aria-hidden="true"></i> Adicionar Filial
            </button>
          </div>
        </div>
    <div v-if="vefNewFilial" class="container container-new">
      <form >
        <div class="form-group">
          <label for="nome"><strong>Nome: </strong></label>
          <input type="text" class="form-control" id="nome" v-model="filial.nome" placeholder="Digite o nome da Filial">
        </div>

        <div class="form-group">
          <label for="CNPJ"><strong>localidade: </strong></label>
          <input type="text" class="form-control" id="CNPJ" v-model="filial.localidade" placeholder="Digite a localidade da Filia">
        </div>

          <hr />
          <div class="row">          
            <div class="col-md-8"></div>
            <div class="col-md-4">
               <button type="button" class="btn btn-default mr-1"  @click="vefNewFilial = false">Cancelar</button>
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
              <td><a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalCenter" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>              
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
      vefNewFilial: false,
      filial: {
      nome: '',
      localidade: '',
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
    padding: 10px;
  }
</style>