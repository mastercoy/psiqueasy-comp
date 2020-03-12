<template>
  <div>
    <div class="form-temp">
      <div class="container">
      <div class="row">
        <h5>Insira o e-mail do colaborador</h5>
        <hr>
           <div class="col-md-9">
             <!-- <div class="form-group">
              <label for="name"><strong>Nome: </strong></label>
              <input type="text" class="form-control" v-bind:class="{ 'is-invalid': $v.userName.$error}" id="name" v-model="$v.userName.$model" >
               <span v-if="$v.userName.$error"> O campo é obrigatório!! </span>
             </div> -->
             <div class="form-group">
              <label for="email"><strong>E-mail: </strong></label>
              <input type="text" class="form-control" v-bind:class="{ 'is-invalid': $v.userEmail.$error}" id="email" v-model="$v.userEmail.$model" >
               <span v-if="$v.userEmail.$error"> Digite um e-mail válido!! </span>
               <span v-if="testeVal"> Esse email já está cadastrado! </span>
             </div>
             <div class="col-md-3"></div>
           </div>         
      </div>
      <hr>
          <div class="row">     
          <div class="col-md-8"></div>
          <div class="col-md-4">
            <router-link to="/usuarios" type="button" class="btn btn-default mr-1"> Voltar </router-link>           
            <button class="btn btn-primary" @click="verificaEmail"> Continuar <i class="fa fa-arrow-right" aria-hidden="true"></i> </button>            
          </div>
        </div>
    </div>
    </div>
    <br>
   </div>
</template>

<script>
import { required, email  } from 'vuelidate/lib/validators'
export default {
  name: 'NewColaborador',
  data() {
    return {
      userEmail: '',
      userName: '',
      testeVal: false
    }
  },
  validations: {
    userEmail: {required, email},
    // userName: {required}
  },
  methods: {
    verificaEmail() {
      let emailUser = this.userEmail
      let nameUser = this.userName
      //console.log(user);
      this.$v.$touch()
      if (this.$v.$invalid) {
        console.log("Preencha os campos necessários!")
      } else {
        console.log(emailUser)
        axios.post('/api/verificar-email', {"email": emailUser}).then(({ data }) => {
         if(data === 1){       
           this.testeVal = true;
         }else {
           this.testeVal = false;
           this.$router.push({ name: 'convitePermissoes', params: { emailUser } });
         }         
       });  
      }
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