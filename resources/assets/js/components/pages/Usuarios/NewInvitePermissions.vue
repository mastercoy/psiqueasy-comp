<template>
    <div class="container">
        <div class="form-temp">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <i class="fa fa-envelope fa-2x" aria-hidden="true"></i>
                    <hr>
                    <div><label><strong>Email: </strong> {{ emailUser }}</label></div>
                </div>
                <div class="col-md-2"></div>
                <!-- <div class="col-md-6">
                  <i class="fa fa-user-circle-o fa-2x" aria-hidden="true"></i><hr>
                  <div><label><strong>Nome: </strong> {{ nameUser }}</label></div>
                </div> -->
            </div>
            <div class="row">
                <div class="col-md-12">
                    <router-link to="/usuarios/invite" class="btn btn-link btn-block">Alterar</router-link>
                </div>
            </div>
        </div>

        <div class="form-temp">
            <div class="container ">
                <h4>Como deseja selecionar a posição do usuário?</h4>
                <hr/>
                <div class="row">
                    <div class="col md-6">
                        <div>
                            <input class="magic-radio" type="radio" name="radio" id="12" value="new" checked v-model="showPresetPerfil">
                            <label for="12">Criar novo perfil </label>
                        </div>
                    </div>
                    <div class="col md-6">
                        <div>
                            <input class="magic-radio" type="radio" name="radio" id="11" value="old" v-model="showPresetPerfil">
                            <label for="11">Utilizar um perfil existente</label>
                        </div>
                    </div>
                    <div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-temp" v-if="showPresetPerfil === 'old' ">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <select class="form-control" v-model="presetPerfil" :disabled="!showPresetPerfil">
                                <option v-for="perf in perfisNew" :key="perf.id">
                                <option :value="perf.id"> {{ perf.nome }}</option>
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-temp" v-if="showPresetPerfil === 'new' ">
            <h4>Nome do Perfil <span> * </span></h4>
            <hr>
            <div class="container">
                <div class="form-group">
                    <input
                        type="text"
                        class="form-control"
                        v-bind:class="{ 'is-invalid': $v.labelPerfil.$error}"
                        id="Perfil"
                        placeholder="Exemplo: Secretária, Administração Financeira"
                        v-model="$v.labelPerfil.$model">
                    <span v-if="$v.labelPerfil.$error"> O campo é obrigatório </span>
                    <small id="perfilHelp" class="form-text text-muted">Esse campo é o identificador do perfil de usuário a ser criado.</small>
                </div>
            </div>
            <PermissoesForm v-on:teste='teste'/>
            <hr>
        </div>

        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <router-link to="/usuarios" type="button" class="btn btn-default mr-1"> Cancelar</router-link>
                <button class="btn btn-primary" @click="getPermissoes">Continuar <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
            </div>
        </div>
        <br>
    </div>
</template>

<script>
    import PermissoesForm from '../../form_components/PermissoesForm'

    import {required} from 'vuelidate/lib/validators'

    export default {
        props: ["emailUser"],
        mounted() {
            this.carregaPerfis();
        },
        components: {
            PermissoesForm
        },
        validations: {
            labelPerfil: {required}
        },
        data() {
            return {
                userInvite: {
                    email: '',
                    permissoes: '',
                    label: '',
                    selectedPerfil: ''
                },
                permissoesArray: [],
                presetPerfil: '',
                perfilName: '',
                showPresetPerfil: false,
                labelPerfil: '',
                perfisNew: [],
                formConvite: {
                    email: this.emailUser,
                    perfil_id: ''
                }

            };
        },
        methods: {
            teste(e) {
                console.log('Funciona!!', e);
                this.arrayProp = e;
            },
            getPermissoes() {
                let toast;
                let checkPerfil = '';
                let arrayPermissoes = [];
                let newp = {
                    name: this.labelPerfil,
                    empresa_id: this.$store.state.empresaID
                }

                arrayPermissoes = this.arrayProp
                this.userInvite.email = this.user;
                this.userInvite.permissoes = arrayPermissoes;
                this.userInvite.label = this.labelPerfil;

                //console.log(this.permissoes);

                switch (this.showPresetPerfil) {
                    case 'old' :
                        if (this.presetPerfil === '') {
                            //console.log('Por favor selecione um perfil para o usuário!');

                            let toast = this.$toasted
                                .error("Por favor selecione um perfil para o usuário!",
                                    {
                                        iconPack: 'fontawesome',
                                        icon: "fa-exclamation-circle",
                                        theme: "bubble",
                                        position: "bottom-right",
                                        duration: 1500
                                    });
                        } else {

                            //console.log(this.presetPerfil);
                            //console.log(this.perfisNew[0].nome)
                            let perfId = 0;
                            for (let i = 0; i < this.perfisNew.length; i++) {
                                if (this.presetPerfil === this.perfisNew[i].nome)
                                    perfId = this.perfisNew[i].id;
                            }

                            console.log(perfId);
                            this.formConvite.perfil_id = perfId
                            this.formConvite.empresa_id = this.$store.state.empresaID
                            axios.post('/api/enviar-convite', this.formConvite)
                                .then(({data}) => {
                                    //console.log(data);
                                });

                            toast = this.$toasted.success("O convite para o usuário foi criado com Sucesso!!", {
                                iconPack: 'fontawesome',
                                icon: "fa-exclamation-circle",
                                theme: "bubble",
                                position: "bottom-right",
                                duration: 1500
                            });
                            //this.$router.push("/usuarios");
                        }
                        break;
                    case 'new' :
                        this.$v.$touch()
                        if (this.$v.$invalid) {
                            console.log("Preencha os campos necessários!")
                        } else {
                            if (this.userInvite.permissoes === undefined) {
                                let toast = this.$toasted
                                    .error("As opções de permissões não foram preenchidas corretamente, por favor verifique os campos e tente novamente!!",
                                        {
                                            iconPack: 'fontawesome',
                                            icon: "fa-exclamation-circle",
                                            theme: "bubble",
                                            position: "bottom-right",
                                            duration: 1500
                                        });
                            } else {

                                console.log(newp)
                                console.log(arrayPermissoes);
                                axios.post('/api/user-perfil-json', newp)
                                    .then(({data}) => {
                                        checkPerfil = data;
                                        //console.log(checkPerfil)

                                        if (checkPerfil === 'já existe') {
                                            toast = this.$toasted.error("O nome escolhido para o perfil já existe! Por favor digite outro nome", {
                                                iconPack: 'fontawesome',
                                                icon: "fa-exclamation-circle",
                                                theme: "bubble",
                                                position: "bottom-right",
                                                duration: 2000
                                            });
                                        } else {
                                            toast = this.$toasted.success("O convite para o usuário foi criado com Sucesso!!", {
                                                iconPack: 'fontawesome',
                                                icon: "fa-exclamation-circle",
                                                theme: "bubble",
                                                position: "bottom-right",
                                                duration: 1500
                                            });
                                        }
                                        //console.log(arrayPermissoes);
                                        axios.patch(`/api/sync-permissoes-perfil/${checkPerfil}`, arrayPermissoes)
                                            .then(({data}) => {
                                                //console.log(data);

                                                this.formConvite.empresa_id = data;
                                                axios.post('/api/enviar-convite', this.formConvite)
                                                    .then(({data}) => {
                                                        //console.log(data);
                                                    });

                                            });
                                        this.$router.push("/usuarios");
                                    });

                            }
                        }
                        break;
                    default:
                        toast = this.$toasted.error("Por favor, Selecione uma opção válida!", {
                            iconPack: 'fontawesome',
                            icon: "fa-exclamation-circle",
                            theme: "bubble",
                            position: "bottom-right",
                            duration: 2000
                        });
                }
            },
            carregaPerfis() {
                let temp = 0;
                let perfis = [];
                //Metodo para carregar os perfis salvos!
                axios.get("/api/user-perfil-json").then(({data}) => {
                    //console.log(data);
                    perfis = data;
                    //console.log(this.perfis[0].name);
                    for (let i = 0; i <= perfis.length; i++) {
                        if (typeof perfis[i] === "object") {
                            this.perfisNew[temp] = {
                                id: perfis[i].id,
                                nome: perfis[i].name,
                                quantidade: perfis[i + 1]
                            }
                            temp++;
                        }
                    }
                    //console.log(this.perfisNew);  //Modificar depois **
                });
            }
        }
    }
</script>

<style scoped>
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
