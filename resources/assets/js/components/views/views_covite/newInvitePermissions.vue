<template>
  <div class="container">
    <div class="form-temp">
      <div class="row">
        <div class="docker">
          <i class="fa fa-user-circle-o fa-4x" aria-hidden="true"></i>
        
        
          <label>{{ user }}</label>
        
        
          <router-link to="/usuarios/invite">Alterar</router-link>
        </div>
      </div>
    </div>

    <div class="form-temp">
      <div class="container container-new">
        <h4>Quem terá acesso a esse usuário</h4>
        <hr />
        <div>
          <input class="magic-radio" type="radio" name="radio" id="11" />
          <label for="11">Todos os usuários</label>
        </div>
        <div>
          <input class="magic-radio" type="radio" name="radio" id="21" />
          <label for="21">Apenas o usuário atual</label>
        </div>
      </div>
    </div>

    <div class="form-temp">
      <h4>Selecione as permissões de acesso do usuário</h4>
      <hr />
      <!-- <label>Marcas todos</label><br> -->
      <button type="button" class="btn btn-link mb-1">Marcas todos</button>
      <br />
      <div class="container">
        <div class="parent">         
            <input class="magic-checkbox" type="checkbox" id="Financas" value="Financas" />
            <label for="Financas">Financeiro</label>       
            <a class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
               <i class="fa fa-chevron-down" aria-hidden="true"></i>
            </a>          
        </div>
        <br />
        <div class="collapse" id="collapseExample">
          <div class="container vl">
            <div class="container">
              <div class="row">
                <input class="magic-checkbox" type="checkbox" id="teste" value="teste" />
                <label for="teste">Teste11</label>
              </div>
              <div class="container">
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste1" value="teste1" />
                  <label for="teste1">Teste1</label>
                </div>
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste2" value="Teste2" />
                  <label for="Teste2">Teste2</label>
                </div>
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste3" value="Teste3" />
                  <label for="Teste3">Teste3</label>
                </div>
              </div>
              <br />
              <div class="row">
                <input class="magic-checkbox" type="checkbox" id="teste21" value="teste21" />
                <label for="teste21">Teste21</label>
              </div>
              <div class="container">
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste1" value="teste1" />
                  <label for="teste1">Teste1</label>
                </div>
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste2" value="Teste2" />
                  <label for="Teste2">Teste2</label>
                </div>
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste3" value="Teste3" />
                  <label for="Teste3">Teste3</label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> 

       <div class="container">
        <div class="parent">         
            <input class="magic-checkbox" type="checkbox" id="Agendamentos" value="Agendamentos" />
            <label for="Agendamentos">Agendamentos</label>       
            <a class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapseAgendamentos" aria-expanded="false" aria-controls="collapseAgendamentos">
               <i class="fa fa-chevron-down" aria-hidden="true"></i>
            </a>          
        </div>
        <br />
        <div class="collapse" id="collapseAgendamentos">
          <div class="container vl">
            <div class="container">
              <div class="row">
                <input class="magic-checkbox" type="checkbox" id="teste" value="teste" />
                <label for="teste">Teste11</label>
              </div>
              <div class="container">
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste1" value="teste1" />
                  <label for="teste1">Teste1</label>
                </div>
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste2" value="Teste2" />
                  <label for="Teste2">Teste2</label>
                </div>
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste3" value="Teste3" />
                  <label for="Teste3">Teste3</label>
                </div>
              </div>
              <br />
              <div class="row">
                <input class="magic-checkbox" type="checkbox" id="teste21" value="teste21" />
                <label for="teste21">Teste21</label>
              </div>
              <div class="container">
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste1" value="teste1" />
                  <label for="teste1">Teste1</label>
                </div>
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste2" value="Teste2" />
                  <label for="Teste2">Teste2</label>
                </div>
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste3" value="Teste3" />
                  <label for="Teste3">Teste3</label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>   

     

       <div class="collapse" id="collapseExample1">
          <div class="container vl">
            <div class="container">
              <div class="row">
                <input class="magic-checkbox" type="checkbox" id="teste" value="teste" />
                <label for="teste">Teste11</label>
              </div>
              <div class="container">
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste1" value="teste1" />
                  <label for="teste1">Teste1</label>
                </div>
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste2" value="Teste2" />
                  <label for="Teste2">Teste2</label>
                </div>
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste3" value="Teste3" />
                  <label for="Teste3">Teste3</label>
                </div>
              </div>
              <br />
              <div class="row">
                <input class="magic-checkbox" type="checkbox" id="teste21" value="teste21" />
                <label for="teste21">Teste21</label>
              </div>
              <div class="container">
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste1" value="teste1" />
                  <label for="teste1">Teste1</label>
                </div>
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste2" value="Teste2" />
                  <label for="Teste2">Teste2</label>
                </div>
                <div>
                  <input class="magic-checkbox" type="checkbox" id="Teste3" value="Teste3" />
                  <label for="Teste3">Teste3</label>
                </div>
              </div>
            </div>
          </div>
        </div>

       <div class="container">
        <div class="parent">         
            <input class="magic-checkbox" type="checkbox" id="Agendamentos" value="Agendamentos" />
            <label for="Agendamentos">Pacientes</label>       
            <!-- <a class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
               <i class="fa fa-chevron-down" aria-hidden="true"></i>
            </a>           -->
        </div>
      </div>
    </div>

    <div class="form-temp">
      <h4>Crie um perfil com essas permissões</h4><hr>

     <div class="container">
        <div class="form-group">
          <label for="Perfil" class="pf">Nome do Perfil: </label>
          <input type="text" class="form-control" id="Perfil" placeholder="Exemplo: Secretária, Administração Financeira">
           <small id="perfilHelp" class="form-text text-muted">Esse campo é opcional.</small>
        </div>
     </div>
      <hr>
      <div class="row">
        <div class="col-md-8"></div>
        <div class="col-md-4">
          <button class="btn btn-deafult mr-1">Voltar</button>
          <button class="btn btn-primary">Continuar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["user"],
  data() {
    return { teste: false };
  },
  methods: {}
};
</script>

<style>
.form-temp {
  margin-bottom: 30px;
}

.parent {
  padding: 10px;
  width: 100%;
  display: flex;
  justify-content: space-between;
  background-color: #eee;
  border-radius: 5px;
}

.vl {
  border-left: 3px solid #eee;
  height: 300px;
  margin-bottom: 30px;
}

.container-n1 {
  padding: 20px;
} 

.pf {
  color: rgb(112, 112, 112);
}

.docker {
  padding: 20px;
  width: 100%;
  display: flex;
  justify-content: space-between;
  vertical-align: middle;
}

</style>