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
        statusEmpresa: false, //OK
        userID: 17,
        empresaID: 10,
        token: localStorage.getItem("user-token") || "",
        user: "" //Precisa ser revisado
    },
    mutations: {
        mudarStatus(state, payload) {
            state.Status = payload;
        },
        salvarIdEmp(state, payload) {
            state.empresaId = payload;
        },
        auth_request(state) {
            state.status = "loading";
        },
        auth_success(state, token, user) {
            state.status = "success";
            state.token = token;
            state.user = user;
        },
        auth_error(state) {
            state.status = "error";
        }
    },
    actions: {
        login({ commit }, user) {
            return new Promise((resolve, reject) => {
                commit("auth_request");
                axios({
                    url: "", //Falta colocar a rota para teste
                    data: user,
                    method: "POST"
                })
                    .then(resp => {
                        const token = resp.data.token;
                        const user = resp.data.user;
                        localStorage.setItem("token", token);
                        // Add the following line:
                        axios.defaults.headers.common["Authorization"] = token;
                        commit("auth_success", token, user);
                        resolve(resp);
                    })
                    .catch(err => {
                        commit("auth_error");
                        localStorage.removeItem("token");
                        reject(err);
                    });
            });
        }
    },

    getters: {
        isLoggedIn: state => !!state.token,
        authStatus: state => state.status
    }
});
