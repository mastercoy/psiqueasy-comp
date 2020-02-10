<template>
       <div>
         <form class="login" @submit.prevent="login">
           <h1>Parece que voce não esta logado...</h1>
           <h2> ou não possui permissão para acessar essa página!</h2>
           <!-- <label>Email</label>
           <input required v-model="email" type="email" placeholder="Digite o seu e-mail aqui"/>
           <label>Password</label>
           <input required v-model="password" type="password" placeholder="Password"/>
           <hr/>
           <button type="submit">Login</button> -->
         </form>
       </div>
      </template>
      <script>
      export default {
        data() {
          return {
            email: "",
            password: ""
          };
        },
        methods: {
          // login: function() {
          //   let email = this.email;
          //   let password = this.password;
          //   this.$store
          //     .dispatch("login", { email, password })
          //     .then(() => this.$router.push("/cadastro"))
          //     .catch(err => console.log(err));
          // }
        }
      };
      </script>