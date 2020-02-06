<template>
<div class="form-temp">
    <h4>Nova Filial</h4>
      <hr>
  <div class="container container-new">
      <form @submit.prevent="criarFilial">
        <div class="form-group">
          <label for="nome"><strong>Nome: </strong></label>
          <input type="text" class="form-control" v-bind:class="{ 'is-invalid': $v.name.$error}" id="nome" v-model="$v.name.$model" placeholder="Digite o nome da Filial">
          <span v-if="$v.name.$error">Este campo é obrigatório</span>
        </div>

        <div class="form-group">
          <label for="CNPJ"><strong>localidade: </strong></label>
          <input type="text" class="form-control" id="CNPJ" v-model="newFilial.localidade" placeholder="Digite a localidade da Filial">
        </div>

          <hr />
          <div class="row">          
            <div class="col-md-8"></div>
            <div class="col-md-4">
               <router-link to="/filial" type="button" class="btn btn-default mr-1">Cancelar</router-link>
               <button type="submit" class="btn btn-primary"><i aria-hidden="true" class="fa fa-floppy-o"></i> <b>Salvar</b> </button>
            </div>
          </div>
      </form>
    </div>
</div>
</template>

<script>
import { required, minLength } from 'vuelidate/lib/validators'

export default {
 data() {
   return {
     name: '',
     newFilial: {
      name: '',
      localidade: '',
      complemento: '',
      active:1    
     }
   }  
 },
 methods: {
   criarFilial() {

      this.$v.$touch()
      if (this.$v.$invalid) {
        console.log("Preencha os campos necessários!")
      } else {
        let nfilial = {
          name: '',
          active: 1,  
          empresa_id:  this.$store.state.empresaId
        }
        
        nfilial.name = this.name

        axios.post('/api/empresa-filial-json', nfilial).then(({ data })  => {      
          console.log(data);      
        });

        this.$router.push("/filial");

        let toast = this.$toasted.show("Filial Adicionada com Sucesso!!", { 
          theme: "toasted-primary", 
          position: "bottom-right", 
          duration : 1500
        });
    
      }


    /*

     if(this.name === ''){
       console.log("Por Favor digite os campos corretamente!")
     }else {
     let nfilial = {
       name: '',
       active: 1,  
       empresa_id:  this.$store.state.empresaId
     }
    
     nfilial.name = this.name

     axios.post('/api/empresa-filial-json', nfilial).then(({ data })  => {      
      console.log(data);      
    });

    this.$router.push("/filial");
    
   }*/
   },
   verificaNomeF() {
     console.log('teste');
   }
 },
  validations: {
     name: {required}
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
