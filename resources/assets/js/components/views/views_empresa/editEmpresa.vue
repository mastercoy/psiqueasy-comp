<template>
   <div  class="form-temp">
    <h4>Dados da Empresa</h4> 
    <hr>
      <form>
        <div class="form-group">
          <label for="nomeEmpresa"><strong>Nome Empresarial: </strong></label>
          <input type="text" class="form-control" v-bind:class="{ 'is-invalid': $v.nomeEmpresa.$error}" id="nomeEmpresa" v-model="$v.nomeEmpresa.$model">
          <span v-if="$v.nomeEmpresa.$error">Este campo é obrigatório </span>
        </div>

        <div class="form-group">  
          <label for="CNPJ"><strong>CNPJ: </strong></label>
          <the-mask type="text" class="form-control" :mask="['##.###.###/####-##']" maxlength="18" v-bind:class="{ 'is-invalid': $v.cnpj.$error}" id="CNPJ" v-model="$v.cnpj.$model" />
           <span v-if="$v.cnpj.$error">Este campo não foi preenchido corretamente</span>  
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
               <button type="button" @click="atualizarEmpresa" class="btn btn-success"><i aria-hidden="true" class="fa fa-floppy-o"></i>  <b>Atualizar</b> </button>
            </div>
          </div>        
      </form>    
  </div>  
</template>

<script>
import { required, minLength, numeric } from 'vuelidate/lib/validators';

export default {
  data() {
    return {
      message: '',
      cnpj: '',
      nomeEmpresa: ''
    }
  },
  mounted(){
     this.cnpj = this.cadEmpresa.cnpj, 
     this.nomeEmpresa = this.cadEmpresa.NomeEmp
  },
  props: ['cadEmpresa'],
  methods: {
    atualizarEmpresa() {
       this.$v.$touch()
      if (this.$v.$invalid) {
        console.log("Preencha os campos necessários!")
      } else {
        let empresaUpd = {
          cpf_cnpj: this.cnpj,
          logo_marca: this.nomeEmpresa
        }

        axios.put(`/api/empresa-json/${this.$store.state.empresaID}`, empresaUpd)
         .then(({ data }) => {
         console.log(data);
         this.$router.push("/cadastro");
       });


        let toast = this.$toasted.success("Os dados foram atualizados com Sucesso!!", {
          iconPack: 'fontawesome',
          icon: "fa-check-circle",
          theme: "bubble", 
          position: "bottom-right", 
          duration : 2000
        });
     
      }      
    },
    validarCnpj() {     
      let cnpj = this.cnpj
            cnpj = cnpj.replace(/[^\d]+/g,'');
        
            if(cnpj == '') return false;
            
            if (cnpj.length != 14)
                return false;
        
            // Elimina CNPJs invalidos conhecidos
            if (cnpj == "00000000000000" || 
                cnpj == "11111111111111" || 
                cnpj == "22222222222222" || 
                cnpj == "33333333333333" || 
                cnpj == "44444444444444" || 
                cnpj == "55555555555555" || 
                cnpj == "66666666666666" || 
                cnpj == "77777777777777" || 
                cnpj == "88888888888888" || 
                cnpj == "99999999999999")
                return false;
                
            // Valida DVs
            tamanho = cnpj.length - 2
            numeros = cnpj.substring(0,tamanho);
            digitos = cnpj.substring(tamanho);
            soma = 0;
            pos = tamanho - 7;
            for (i = tamanho; i >= 1; i--) {
              soma += numeros.charAt(tamanho - i) * pos--;
              if (pos < 2)
                    pos = 9;
            }
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(0))
                return false;
                
            tamanho = tamanho + 1;
            numeros = cnpj.substring(0,tamanho);
            soma = 0;
            pos = tamanho - 7;
            for (i = tamanho; i >= 1; i--) {
              soma += numeros.charAt(tamanho - i) * pos--;
              if (pos < 2)
                    pos = 9;
            }
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(1))
                  return false;
                  
            return true;
            
        }
    
  },
  validations: {
    nomeEmpresa: {required},
    cnpj: {numeric, required}    
  }

}
</script>

<style scoped>
  /* .form-temp {
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
  } */
</style>