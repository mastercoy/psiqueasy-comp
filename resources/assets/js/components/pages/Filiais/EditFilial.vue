<template>
<div class="form-temp">
    <h4> Editar Filial</h4>
      <hr>
   <div class="container container-new">
       <form >
        <div class="form-group">
          <label for="nome"><strong>Nome: </strong></label>
          <input type="text" class="form-control" id="nome" v-model="filial.name" >
        </div>

        <!-- <div class="form-group">
          <label for="CNPJ"><strong>localidade: </strong></label>
          <input type="text" class="form-control" id="CNPJ" v-model="filial.localidade" >
        </div> -->

          <hr />
          <div class="row">          
            <div class="col-md-8"></div>
            <div class="col-md-4">
               <router-link to="/filial" type="button" class="btn btn-default mr-1">Cancelar</router-link>
               <button type="button" class="btn btn-success" @click="editFilial"><i aria-hidden="true" class="fa fa-floppy-o"></i> <b>Atualizar</b> </button>
            </div>
          </div>        
      </form>
    </div>
</div>
</template>

<script>
export default {
  props: ['filial'],
  methods: {
    editFilial() {
       let cFilial = this.filial
     
        axios.patch(`/api/empresa-filial-json/${cFilial.id}`, cFilial).then(({ data })  => {
        console.log("Filial editada com Sucesso");    
         });

        let toast = this.$toasted.success("Os dados foram atualizados com Sucesso!!", {
          iconPack: 'fontawesome',
          icon: "fa-check-circle",
          theme: "bubble", 
          position: "bottom-right", 
          duration : 2000
        });
    
       this.$router.push("/filial");
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
  span {
    color: red;
    font-weight: bold
  }
</style>
