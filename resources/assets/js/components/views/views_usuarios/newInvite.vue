<template>
  <div>
    <div class="form-temp">
      <div class="container">
      <div class="row">
        <h5>Insira o e-mail do colaborador</h5>
        <p>Ex laboris nostrud nisi ullamco laborum sint eu cillum quis occaecat et. 
          Cupidatat laborum amet elit aliqua reprehenderit velit nisi proident.
          Ut dolor fugiat velit Lorem pariatur velit nulla pariatur.
           Duis id velit sit commodo eiusmod officia minim id adipisicing exercitation enim voluptate eiusmod.
           Aliquip fugiat est ullamco ad ullamco qui incididunt consequat nulla laboris quis aliqua.</p>

           <div class="col-md-9">
             <div class="form-group">
              <label for="email"><strong>E-mail: </strong></label>
              <input type="text" class="form-control" v-bind:class="{ 'is-invalid': $v.userEmail.$error}" id="email" v-model="$v.userEmail.$model" >
               <span v-if="$v.userEmail.$error"> Digite um e-mail válido!! </span>
            </div>
             <div class="col-md-3"></div>
           </div>         
      </div>
      <hr>
          <div class="row">     
          <div class="col-md-8"></div>
          <div class="col-md-4">
            <router-link to="/usuarios" type="button" class="btn btn-default mr-1"> Voltar </router-link>           
            <button class="btn btn-primary" @click="atualizaRota"> Continuar <i class="fa fa-arrow-right" aria-hidden="true"></i> </button>            
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
      userEmail: ''
    }
  },
  validations: {
    userEmail: {required, email}
    //:to="{name:'convitePermissoes', params: {userEmail} }"
  },
  methods: {
    atualizaRota() {
      let user = {
        email: this.userEmail
      }
      console.log(user);
      this.$v.$touch()
      if (this.$v.$invalid) {
        console.log("Preencha os campos necessários!")
      } else {

        axios.get('/api/verificar-email/', user).then(({ data }) => {
         console.log(data);
         //this.$router.push("/cadastro");
       });

        //this.$router.push({ name: 'convitePermissoes', params: { user } })
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