<template>
   <div  class="form-temp">
    <h4>Dados da Empresa</h4>
    <hr>
      <form @submit.prevent="atualizarEmpresa">
        <div class="form-group">
          <label for="nome"><strong>Nome: </strong></label>
          <input type="text" class="form-control" id="nome" v-model="cadEmpresa.nome">
        </div>

        <div class="form-group">
          <label for="CNPJ"><strong>CNPJ: </strong></label>
          <input type="text" class="form-control" id="CNPJ" v-model="cadEmpresa.cnpj" >
        </div>

        <div class="form-group">
          <label for="empNome"><strong>Nome Empresarial: </strong></label>
          <input type="text" class="form-control" id="empNome" v-model="cadEmpresa.NomeEmp">
        </div>

        <div class="form-group">
          <label for="natJuridica"><strong>Natureza Jurídica(Grupo): </strong></label>
          <select class="form-control" id="natJuridica" v-model="cadEmpresa.naturezaJuridica">
            <option disabled value="">Selecione uma opção </option>
            <option>PESSOAS FÍSICAS</option>
            <option>ADMINISTRAÇÃO PÚBLICA</option>
            <option>ENTIDADES EMPRESARIAIS</option>
            <option>ENTIDADE SEM FINS LUCRATIVOS</option>
            <option>ORGANIZAÇÕES INTERNACIONAIS</option>            
          </select>
        </div>

         <div class="form-group">
          <label for="gestao"><strong>Gestão: </strong></label>
          <select class="form-control" id="gestao" v-model="cadEmpresa.gestao">
            <option disabled value="">Selecione uma opção </option>
            <option>PRIVADA</option>
            <option>MUNICIPAL</option>
            <option>ESTADUAL</option>
            <option>DUPLA</option>           
          </select>
        </div>
        <hr />
          <div class="row">          
            <div class="col-md-8"></div>
            <div class="col-md-4">
               <router-link to="/cadastro" type="button" class="btn btn-default mr-1">Voltar</router-link>
               <button type="submit" class="btn btn-success"><i aria-hidden="true" class="fa fa-floppy-o"></i>  <b>Atualizar</b> </button>
            </div>
          </div>        
      </form>    
  </div>  
</template>

<script>
export default {
  props: ['cadEmpresa'],
  methods: {
    atualizarEmpresa() {
      let empresa = {
        cpf_cnpj: this.cadEmpresa.cnpj,
        logo_marca: this.cadEmpresa.NomeEmp,
        active: 1,
        user_id: 1
      }
      axios.patch(`/api/empresa-json/${1}`, empresa).then(({data}) => {
         console.log("Dados da empresa editados com sucesso!!");
       });
       this.$router.push("/cadastro");

       let toast = this.$toasted.show("Dados atualizados com Sucesso!!", { 
          theme: "toasted-primary", 
          position: "bottom-right", 
          duration : 1500
        });
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