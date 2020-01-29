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
        usuários: []
    },
    mutations: {},
    actions: {},
    getters: {}
});