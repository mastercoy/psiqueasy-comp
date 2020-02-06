<template>
  <div class="container">
    <div class="form-temp">
      <div class="row">
        <div class="col-md-2">
          <i class="fa fa-user-circle-o fa-4x" aria-hidden="true"></i>
        </div>
        <div class="col-md-8">
          <label>{{ user }}</label>
        </div>
        <div class="col-md-2">
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
      <label>Marcas todos</label>
      <br />
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <input class="magic-checkbox" type="checkbox" id="Financas" value="Financas" />
            <label for="Financas">Finanças</label>
          </div>
          <div class="col-md-4">
            <button
              class="btn btn-default"
              type="button"
              data-toggle="collapse"
              data-target="#collapseExample"
              aria-expanded="false"
              aria-controls="collapseExample"
            >+</button>
          </div>
        </div>
        <br />
        <div class="collapse" id="collapseExample">
          <div class="container container-new">
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
      <hr />

      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <input class="magic-checkbox" type="checkbox" id="Pacientes" value="Pacientes" />
            <label for="Pacientes">Pacientes</label>
          </div>
          <div class="col-md-4">
            <button class="btn btn-default">Teste</button>
          </div>
        </div>
      </div>
    </div>

    <div class="form-temp">
      <h4>Testando...</h4>

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

#wrapper {
  background: #ccc;
  overflow: hidden;
  transition: height 200ms;
}
</style>