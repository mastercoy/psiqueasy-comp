<template>
<div class="form-temp">
    <h4> Editar Usuário</h4>
      <hr>
    <div class="container container-new">
      <form>
         <div class="form-group">
          <label for="nome"><strong>Nome: </strong></label>
          <input type="text" class="form-control" id="nome" v-model="user.nome" >
        </div>

        <div class="form-group">
          <label for="descricao"><strong>Descrição: </strong></label>
          <input type="text" class="form-control" id="descricao" v-model="user.descricao">
        </div>

         <div class="form-group">
          <label for="alocacao"><strong>Alocação: </strong></label>
          <select class="form-control" v-model="user.aloc">
            <option disable value=""> </option>
            <option> Matriz </option>
          </select>
        </div>
        
         <hr />
          <div class="row">          
            <div class="col-md-8"></div>
            <div class="col-md-4">
              <router-link to="/usuarios" type="button" class="btn btn-default mr-1">Cancelar</router-link>
               <button type="button" class="btn btn-success" @click="editUser"><i aria-hidden="true" class="fa fa-floppy-o"></i> <b>Atualizar</b></button>
            </div>
          </div>
      </form>
    </div>
</div>
</template>

<script>
export default {
  props: ['user'],
  methods: {
    editUser() {
      let toast = this.$toasted.success("Usuário editado com Sucesso!", {
              iconPack: 'fontawesome',
              icon: "fa-exclamation-circle",
              theme: "bubble", 
              position: "bottom-right", 
              duration : 1500
              });
      //console.log("Usuário editado com Sucesso");
      this.$router.push("/usuarios");
    }
  }
}
</script>

<style scoped>
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
</style>
