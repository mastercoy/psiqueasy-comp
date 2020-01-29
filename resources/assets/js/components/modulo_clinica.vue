<template>
  <div class="container">
    <h2>Componente - Clinica</h2> 

    <p>Ipsum do dolore aute qui mollit consectetur aliquip consectetur irure Lorem.
       Irure occaecat culpa quis esse proident labore exercitation irure.
        Consectetur deserunt cupidatat aliquip sint labore commodo sint labore ea qui qui Lorem magna velit.
    </p>  

    <div class="row">

      <div class="col-md-3">
        
          <ul>
            <li><router-link to="/cadastro">Empresa</router-link></li>
            <li @click="imprimir"> <router-link to="/filial">Filiais</router-link></li>
            <li><router-link to="/usuarios">Usuários</router-link></li>
            <li> Perfil </li>
            <li> Configurações </li>
            <li> E-Mail </li>
             <li> Senha </li>
             <li> Idioma </li>
          </ul>
       
        
      </div> <!-- FIM DA DIV DA COL MD-3 -->

      <div class="col-md-9">
        <router-view />
      </div><!-- FIM DA DIV DA COL MD-9 -->
    </div>


  </div>
</template>

<script>

export default {
  name: "modulo_clinica",
  methods: {
    imprimir(){
      console.log("OK!")
    }
  }
}
</script>

<style >
  body {
    background-color: #e5edfa;
  }

</style>

