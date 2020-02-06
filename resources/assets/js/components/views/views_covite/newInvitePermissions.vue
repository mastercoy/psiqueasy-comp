<template>
<div class="container">
  <div class="form-temp">
    <div class="row">
      <div class="col-md-2">
        <i class="fa fa-user-circle-o fa-4x" aria-hidden="true"></i> 
      </div>    
      <div class="col-md-8">
        <label>{{userEmail}}</label>
      </div>
       <div class="col-md-2">
        <router-link to="/usuarios/invite"> Alterar </router-link>
      </div>       
    </div>
  </div>
  <br>
   <h3>Quem terá acesso a esse usuário</h3>
   <div class="form-temp">
      <h4>Teste </h4>
      <hr>

  </div>
      
</div>
  
</template>

<script>
export default {
  props: ['userEmail'],
  data() {
    return {
      
    }
  }
}
</script>

<style scoped>
  label {
    /*padding: 40px 0;*/
  }
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
   span {
    color: red;
    font-weight: bold
  } */
</style>