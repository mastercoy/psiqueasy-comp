<template>
   <div  class="form-temp">
    <h4>Dados da Empresa</h4> {{ message }}
    <hr>
      <form @submit.prevent="atualizarEmpresa">
        <div class="form-group">
          <label for="nomeEmpresa"><strong>Nome Empresarial: </strong></label>
          <input type="text" class="form-control" v-bind:class="{ 'is-invalid': $v.nomeEmpresa.$error}" id="nomeEmpresa" v-model="$v.nomeEmpresa.$model">
          <p v-if="$v.nomeEmpresa.$error">Este campo é obrigatório</p>
        </div>

        <div class="form-group">  
          <label for="CNPJ"><strong>CNPJ: </strong></label>
          <input type="text" class="form-control"  v-on:keydown="FormataCnpj"  maxlength="18" v-bind:class="{ 'is-invalid': $v.cnpj.$error}" id="CNPJ" v-model="$v.cnpj.$model" >
          <p v-if="$v.cnpj.$error">Este campo é obrigatório</p>
        </div>

        <div class="form-group">
          <label for="empNome"><strong>Nome: </strong></label>
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
import { required, maxLength } from 'vuelidate/lib/validators'
export default {
  data() {
    return {
      message: '',
      cnpj: '',
      nomeEmpresa: ''
    }
  },
  mounted(){
    // this.cnpj = this.cadEmpresa.cnpj,  :onblur="validarCNPJ"
    // this.n_empresa = this.cadEmpresa.NomeEmp
  },
  props: ['cadEmpresa'],
  methods: {
    atualizarEmpresa() {
       this.$v.$touch()
      if (this.$v.$invalid) {
        console.log("Preencha os campos necessários!")
      } else {
        console.log("funciona")
      /*let empresa = {
        cpf_cnpj: this.cnpj,
        logo_marca: this.n_empresa,
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
        });*/
      }      
    },
    FormataCnpj(event)
			{
				var tecla = event.keyCode;
				var vr = new String(this.cnpj);
				vr = vr.replace(".", "");
				vr = vr.replace("/", "");
				vr = vr.replace("-", "");
				let tam = vr.length + 1;
				if (tecla != 14)
				{
					if (tam == 3)
						this.cnpj = vr.substr(0, 2) + '.';
					if (tam == 6)
						this.cnpj = vr.substr(0, 2) + '.' + vr.substr(2, 5) + '.';
					if (tam == 10)
						this.cnpj = vr.substr(0, 2) + '.' + vr.substr(2, 3) + '.' + vr.substr(6, 3) + '/';
					if (tam == 15)
					  this.cnpj = vr.substr(0, 2) + '.' + vr.substr(2, 3) + '.' + vr.substr(6, 3) + '/' + vr.substr(9, 4) + '-' + vr.substr(13, 2);
				}
			}
  },
  validations: {
    nomeEmpresa: {required},
    cnpj: {required}    
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

  p {
    color: red;
  }
</style>