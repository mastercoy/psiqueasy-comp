<template>
  <div class="form-temp">
    <h4>Cadastrar Filial</h4>
      <hr>
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
            <div class="col-md-9"></div>
            <div class="col-md-3">
               <button type="button" class="btn btn-default mr-1">Cancelar</button>
               <button type="submit" class="btn btn-success"><i aria-hidden="true" class="fa fa-floppy-o"></i>  <b>Salvar</b> </button>
            </div>
          </div>
      </form>    
  </div>
</template>

<script>
export default {
  data() {
    return {
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
</style>