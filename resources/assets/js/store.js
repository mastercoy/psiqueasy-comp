import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        // Salvar os dados da empresa associada ao usuário logado( SuperAdmin )
        Empresa: {
            nome: "",
            cnpj: "",
            NomeEmp: "",
            naturezaJuridica: "",
            gestao: ""
        },
        Filiais: [],
        usuários: [],
        Status: 2, //OK // Variável que é modificada  se o usuário tiver ou não permissão de visualizar as opções 
        statusEmpresa: false, //OK  Booleano que muda de acordo com o status do empresa, se a mesma foi criada exibe uma opção e caso contrário exibe uma tela de cadastro
        userID: 1,  //Vai receber o ID do usuário que estiver logado (SuperAdmin)
        empresaID: 1,   //Vai receber o ID da empresa associado ao usuário logado (SuperAdmin)
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
        // Métodos que salva os tokens após o Login
        login({commit}, user) {
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
        },

    },

    getters: {
        isLoggedIn: state => !!state.token,
        authStatus: state => state.status
    }
});
