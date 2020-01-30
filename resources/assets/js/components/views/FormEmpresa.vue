<template>
  <div class="form-temp">
    <h4>Empresa</h4>
    <hr>
      <form @submit.prevent="cadastrarEmpresa">
        <div class="form-group">
          <label for="nome"><strong>Nome: </strong></label>
          <input type="text" class="form-control" id="nome" v-model="cadEmpresa.nome" placeholder="Digite o nome do responsável pela empresa">
        </div>

        <div class="form-group">
          <label for="CNPJ"><strong>CNPJ: </strong></label>
          <input type="text" class="form-control" id="CNPJ" v-model="cadEmpresa.cnpj" placeholder="Digite o CNPJ da empresa">
        </div>

        <div class="form-group">
          <label for="empNome"><strong>Nome Empresarial: </strong></label>
          <input type="text" class="form-control" id="empNome" v-model="cadEmpresa.NomeEmp" placeholder="Digite o nome fantasia da empresa">
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
               <button type="button" class="btn btn-default mr-1">Cancelar</button>
               <button type="submit" class="btn btn-success" @click="createEmpresa"><i aria-hidden="true" class="fa fa-floppy-o"></i>  <b>Salvar</b> </button>
            </div>
          </div>
        
      </form>    
  </div>
</template>

<script>
export default {
  data(){
    return {
      cadEmpresa: {
        nome: '',
        cnpj: '',
        NomeEmp: '',
        naturezaJuridica: '',
        gestao: ''
      }
    }
  },
  methods: {
    cadastrarEmpresa() {
      this.$store.state.Empresa = this.cadEmpresa
      console.log( this.$store.state.Empresa)
    },
    createEmpresa() {
      let empresa = {
        cpf_cnpj: this.cadEmpresa.cnpj,
        logo_marca: this.cadEmpresa.NomeEmp,
        active: 1
      }
     axios.post('api/empresa-json', empresa).then(({ data })  => {
      console.log(empresa);
      
    });
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
</style>