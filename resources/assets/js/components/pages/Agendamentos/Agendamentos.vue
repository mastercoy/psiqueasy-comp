<template>
  <div class="form-temp">
    <div class="container">
      <div class="form-group">
        <div class="row">
          <div class="col-md-4">
            <button
              class="btn btn-primary btn-block mb-1"
              data-toggle="modal"
              data-target="#exampleModalCenter"
            >
              <i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i>
              Agendar Atendimento
            </button>
          </div>
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <button
              class="btn btn-secondary btn-block"
              data-toggle="modal"
              data-target="#modalEditarAtendimento"
            >
              <i class="fa fa-pencil fa-lg" aria-hidden="true"></i>
              Editar Atendimento
            </button>
          </div>
        </div>
        <hr />
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect1">Selecione o Profissional</label>
        <select class="form-control" id="exampleFormControlSelect1" v-model="selectUser">
          <option v-for="user in users" :key="user.id">{{ user.name}}</option>
        </select>
      </div>
    </div>
    <!-- -->

    <button class="btn btn-primary btn-block" @click="handleshowConsultas">Carregar atendimentos</button>
    <br />
    <div class="row">
      <div class="col-md-12">
        <full-calendar
          :header="header"
          :events="events"
          :config="config"
          :eventTimeFormat="eventTimeFormat"
        />
      </div>
    </div>

    <!-- Modal para adicionar atendimento -->
    <div
      class="modal fade"
      id="exampleModalCenter"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Agendar Consulta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container">
              <h5>Selecione as opções</h5>
              <div class="form-group">
                <label for="exampleInputEmail1">Adicione a descrição</label>
                <input
                  type="text"
                  class="form-control"
                  id="exampleInputEmail1"
                  v-bind:class="{ 'is-invalid': $v.newStatusAtend.$error}"
                  v-model="$v.newStatusAtend.$model"
                />
                <span v-if="$v.newStatusAtend.$error">Este campo não foi preenchido corretamente</span>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="dateAtendimento">Data do Atendimento</label>
                    <input
                      class="form-control"
                      type="date"
                      id="dateAtendimento"
                      v-bind:class="{ 'is-invalid': $v.newDateAtend.$error}"
                      v-model="$v.newDateAtend.$model"
                    />
                    <span v-if="$v.newDateAtend.$error">Este campo não foi preenchido corretamente</span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for>Horário do Atendimento</label>
                    <input
                      class="form-control"
                      type="time"
                      v-mask="'##:##'"
                      v-bind:class="{ 'is-invalid': $v.newTimeAtend.$error}"
                      v-model="$v.newTimeAtend.$model"
                    />
                    <span v-if="$v.newTimeAtend.$error">Este campo não foi preenchido corretamente</span>
                  </div>
                </div>
              </div>
              <label for="exampleFormControlSelect1">Selecione o Profissional</label>
              <select
                class="form-control"
                id="exampleFormControlSelect1"
                v-model="$v.selectUserNew.$model"
                v-bind:class="{ 'is-invalid': $v.selectUserNew.$error}"
              >
                <option v-for="user in users" :key="user.id">{{ user.name}}</option>
              </select>
              <span v-if="$v.selectUserNew.$error">Este campo não foi preenchido corretamente</span>
              <br />
              <div class="form-group" v-if="selectUserNew !== ''">
                <label for="exampleFormControlSelect2">Selecione o Paciente</label>
                <select
                  class="form-control"
                  id="exampleFormControlSelect2"
                  v-model="$v.selectPacienteNew.$model"
                  v-bind:class="{ 'is-invalid': $v.selectPacienteNew.$error}"
                >
                  <option v-for="paciente in pacientes" :key="paciente.id">{{ paciente.id}}</option>
                </select>
                <span v-if="$v.selectPacienteNew.$error">Este campo não foi preenchido corretamente</span>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success" @click="handleAgendarC">
              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
              Agendar
            </button>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="modalEditarAtendimento"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Editar Atendimento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col md-6">
                <label for="selectProf">Selecione o profissional</label>
                <select
                  class="form-control"
                  id="exampleFormControlSelect1"
                  v-model="selectUser"
                  @change="handleUpFiles"
                >
                  <option v-for="user in users" :key="user.id">{{ user.name}}</option>
                </select>
              </div>
              <div class="col md-6">
                <div v-if="atendSelect">
                  <label for="atends">Selecione o atendimento</label>
                  <select
                    class="form-control"
                    id="exampleFormControlSelect1"
                    v-model="selectConsulta"
                    @change="handleUpFiles2"
                  >
                    <option
                      v-for="atendimento in editAtend"
                      :key="atendimento.id"
                      :value="atendimento"
                    >{{ atendimento.status}}</option>
                  </select>
                </div>
              </div>
            </div>
            <hr />
            <div v-if="vefAtend">
              <div class="form-group">
                <label for="desc">Descrição</label>
                <input
                  type="text"
                  class="form-control"
                  id="desc"
                  v-bind:class="{ 'is-invalid': $v.newStatusAtend.$error}"
                  v-model="$v.newStatusAtend.$model"
                />
                <span v-if="$v.newStatusAtend.$error">Este campo é obrigatório</span>
              </div>
              <div class="form-group">
                <label for="dateAtend">Data</label>
                <input
                  type="date"
                  class="form-control"
                  v-bind:class="{ 'is-invalid': $v.newDateAtend.$error}"
                  v-model="$v.newDateAtend.$model"
                />
                <span v-if="$v.newDateAtend.$error">Este campo não foi preenchido corretamente</span>
              </div>
              <div class="form-group">
                <label for="dateAtend">Hora</label>
                <input
                  type="time"
                  class="form-control"
                  v-bind:class="{ 'is-invalid': $v.newTimeAtend.$error}"
                  v-model="$v.newTimeAtend.$model"
                />
                <span v-if="$v.newTimeAtend.$error">Este campo não foi preenchido corretamente</span>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button
              type="button"
              class="btn btn-success"
              @click="handleUpdateAtend"
              :disabled="enableButton"
            >Continuar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {
  FullCalendar,
  agendaDay,
  agendaWeek,
  month,
  themeSystem
} from "vue-full-calendar";
import { required } from "vuelidate/lib/validators";

export default {
  async beforeMount() {
    // const users = await axios.get('/api/user-json');
    axios.get("api/user-json").then(({ data }) => {
      this.users = data;

      console.log(this.users);
    });
  },
  data() {
    return {
      enableButton: true,
      selectConsulta: {},
      atendSelect: false,
      vefAtend: false,
      newDateAtend: "",
      newTimeAtend: "",
      newStatusAtend: "",
      users: [],
      selectUser: "",
      selectUserNew: "",
      selectAtend: "",
      editAtend: [],
      consultas: [],
      pacientes: [
        {
          id: 1,
          name: "Joana"
        },
        {
          id: 2,
          name: "Claudio"
        },
        {
          id: 3,
          name: "Anna"
        }
      ],
      header: {
        left: "prev,next, today",
        center: "title",
        right: "month,agendaWeek,agendaDay"
      },
      events: [],
      eventTimeFormat: {
        // like '14:30:00'
        hour: "2-digit",
        minute: "2-digit",
        meridiem: "short"
      },
      themeSystem: "bootstrap",
      config: {
        locale: "pt-br",
        editable: false,
        eventLimit: true,
        views: {
          timeGrid: {
            eventLimit: 4 // adjust to 6 only for timeGridWeek/timeGridDay
          }
        }
      },
      eventClick: function(info) {
        console.log("testando..." + info);
      }
    };
  },
  components: {
    FullCalendar
  },
  validations: {
    newStatusAtend: { required },
    newDateAtend: { required },
    newTimeAtend: { required },
    selectAtend: { required },
    selectUserNew: { required }
  },
  methods: {
    async handleshowConsultas() {
      let usuario_id = "";

      if (this.selectUser === "") {
        let toast = this.$toasted.error("Por favor selecione um profissional", {
          iconPack: "fontawesome",
          icon: "fa-exclamation-circle",
          theme: "bubble",
          position: "bottom-right",
          duration: 1500
        });
      } else {
        this.events = [];

        try {
          this.users.forEach(u => {
            if (u.name === this.selectUser) {
              usuario_id = u.id;
            }
          });
          const bdAtendimentos = await axios({
            method: "get",
            url: "/api/buscar-atendimento-json",
            params: {
              inicio: "2010-01-01",
              fim: "2050-12-30",
              status: "todos",
              user_id: usuario_id
            }
          });
          this.consultas = bdAtendimentos.data;
          console.log(this.consultas);
        } catch (err) {
          console.error(err);
        }
        this.consultas.forEach(consulta => {
          const newAtend = {
            id: "e",
            textColor: "white",
            color: "primary",
            title: consulta.status,
            start: consulta.data
          };
          this.events.push(newAtend);
        });
      }
    },
    async handleAgendarC() {
      this.$v.$touch();
      if (this.$v.$invalid) {
        console.log("Preencha os campos necessários!");
      } else {
        try {
          let usuario_id = "";
          this.users.forEach(u => {
            if (u.name === this.selectUserNew) {
              usuario_id = u.id;
            }
          });

          let dataA = `${this.newDateAtend} ${this.newTimeAtend}`;
          console.log(dataA);
          const bdAtendimentos = await axios({
            method: "post",
            url: "/api/atendimento-json",
            data: {
              data: dataA,
              status: this.newStatusAtend,
              user_id: usuario_id,
              paciente_id: this.selectPacienteNew
            }
          });

          $("#exampleModalCenter").modal("hide");
        } catch (err) {}
      }
    },
    async handleUpFiles() {
      this.vefAtend = false;
      this.atendSelect = true;
      this.enableButton = true;
      try {
        let usuario_id = "";
        console.log(this.selectUser);
        this.users.forEach(u => {
          if (u.name === this.selectUser) {
            usuario_id = u.id;
          }
        });
        let editAtendimentos = await axios({
          url: "/api/buscar-atendimento-json",
          params: {
            inicio: "2010-01-01",
            fim: "2050-12-30",
            status: "todos",
            user_id: usuario_id
          }
        });
        this.editAtend = editAtendimentos.data;
        console.log(this.editAtend);
        this.atendSelect = true;
      } catch (err) {
        console.error(err);
      }
    },
    handleUpFiles2() {
      let stringArray = this.selectConsulta.data.split(/(\s+)/);
      this.newStatusAtend = this.selectConsulta.status;
      this.newDateAtend = stringArray[0];
      this.newTimeAtend = stringArray[2];
      this.vefAtend = true;
      this.enableButton = false;
    },
    async handleUpdateAtend() {
      // this.$v.$touch();
      // if (this.$v.$invalid) {
      //   console.log("Preencha os campos necessários!");
      // } else {
      try {
        let usuario_id = "";
        //console.log(this.selectUser);
        this.users.forEach(u => {
          if (u.name === this.selectUser) usuario_id = u.id;
        });

        let dataA = `${this.newDateAtend} ${this.newTimeAtend}`;
        console.log(dataA);
        await axios({
          method: "patch",
          url: "/api/atendimento-json",
          body: {
            data: dataA,
            status: this.newStatusAtend,
            user_id: usuario_id,
            paciente_id: this.selectConsulta.paciente_id
          }
        });
      } catch (err) {}
    }
  }
};
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
  font-weight: bold;
}
</style>