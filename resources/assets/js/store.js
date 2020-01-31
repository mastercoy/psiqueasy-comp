import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({ 
    state: {
        Empresa: {
            nome: "",
            cnpj: "",
            NomeEmp: "",
            naturezaJuridica: "",
            gestao: ""
        },
        Filiais: [],
        usuários: [],
        Status: 2, //OK
        statusEmpresa: false //OK
    },
    mutations: {
        mudarStatus(state, payload) {
            state.Status = payload
        }
    },
    actions: {},
    getters: {}
});