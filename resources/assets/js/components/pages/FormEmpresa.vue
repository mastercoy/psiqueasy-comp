<template>
    <div>
        <div v-if="this.$store.state.statusEmpresa" class="form-temp">
            <h4>Empresa</h4>
            <hr>
            <form @submit.prevent="createEmpresa">
                <div class="form-group">
                    <label for="nomeEmpresa"><strong>Nome Empresarial: </strong></label>
                    <input type="text" class="form-control" v-bind:class="{ 'is-invalid': $v.nomeEmpresa.$error}" id="nomeEmpresa" v-model="$v.nomeEmpresa.$model">
                    <span v-if="$v.nomeEmpresa.$error">Este campo é obrigatório</span>
                </div>

                <div class="form-group">
                    <label for="CNPJ"><strong>CNPJ: </strong></label>
                    <the-mask type="text" class="form-control" :mask="['##.###.###/####-##']" maxlength="18" placeholder="Digite o CNPJ da empresa" v-bind:class="{ 'is-invalid': $v.cnpj.$error}"
                              id="CNPJ" v-model="$v.cnpj.$model"/>
                    <p v-if="$v.cnpj.$error">Este campo não foi preenchido corretamente</p>
                </div>

                <div class="form-group">
                    <label for="empNome"><strong>Nome Empresarial: </strong></label>
                    <input type="text" class="form-control" id="empNome" v-model="cadEmpresa.NomeEmp" placeholder="Digite o nome fantasia da empresa">
                </div>

                <div class="form-group">
                    <label for="natJuridica"><strong>Natureza Jurídica(Grupo): </strong></label>
                    <select class="form-control" id="natJuridica" v-model="cadEmpresa.naturezaJuridica">
                        <option disabled value="">Selecione uma opção</option>
                        <option>PESSOAS FÍSICAS</option>
                        <option>ADMINISTRAÇÃO PÚBLICA</option>
                        <option>ENTIDADES EMPRESARIAIS</option>
                        <option>ENTIDADE SEM FINS LUCRATIVOS</option>
                        <option>ORGANIZAÇÕES INTERNACIONAIS</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="gestao"><strong>Gestão: </strong></label>
                    <select class="form-control" id="gestao" v-model="cadEmpresa.gestao">
                        <option disabled value="">Selecione uma opção</option>
                        <option>PRIVADA</option>
                        <option>MUNICIPAL</option>
                        <option>ESTADUAL</option>
                        <option>DUPLA</option>
                    </select>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-default mr-1">Cancelar</button>
                        <button type="submit" class="btn btn-success" @click="createEmpresa"><i aria-hidden="true" class="fa fa-floppy-o"></i> <b>Salvar</b></button>
                    </div>
                </div>
            </form>
        </div>

        <div v-else class="form-temp">
            <div class="row">
                <div class="col-md-9">
                    <h4>Dados da Empresa</h4>
                </div>
                <div class="col-md-3">
                    <router-link :to="{name:'EditarCadastro', params: {cadEmpresa} }" class="btn btn-success"><i class="fa fa-pencil-square" aria-hidden="true"></i> Editar</router-link>
                </div>
            </div>

            <hr>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <label><strong>Nome da Empresa: </strong></label> {{cadEmpresa.NomeEmp }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label><strong>CNPJ: </strong> {{ mascaraCnpj(cadEmpresa.cnpj) }} </label>
                    </div>
                    <div class="col-md-6"></div>
                </div>

            </div>
            <hr>
            <!-- <div class="row">
              <div class="col-md-4"></div>
              <div class="col-md-4">
                <button class="btn btn-default btn-sm"> Endereços </button>
              </div>
              <div class="col-md-4"></div>
            </div> -->
        </div>

    </div>
</template>

<script>
    import {numeric, required} from 'vuelidate/lib/validators';

    export default {
        mounted() {
            if (this.$store.state.Status === 2) {
                this.getEmpresa();
            }
        },
        data() {
            return {
                cnpj: '',
                nomeEmpresa: '',
                cadEmpresa: {
                    nome: '',
                    cnpj: '',
                    NomeEmp: '',
                    naturezaJuridica: '',
                    gestao: ''
                }
            }
        },
        methods: {
            getEmpresa() {
                let id = this.$store.state.userID
                axios.get(`api/empresa-json/${id}`).then(({data}) => {
                    //console.log(data);
                    this.cadEmpresa.NomeEmp = data.logo_marca
                    this.cadEmpresa.cnpj = data.cpf_cnpj
                });
            },
            createEmpresa() {
                let empresa = {
                    cpf_cnpj: this.cnpj,
                    logo_marca: this.nomeEmpresa,
                    active: 1,
                    user_id: null
                    // user_id: this.$store.state.userID
                }
                axios.post('api/empresa-json', empresa).then(({data}) => {
                    this.$store.commit('salvarIdEmp', data.last_id)
                    this.$store.state.Status = 2
                    this.$store.state.statusEmpresa = false
                });

                let toast = this.$toasted.success("Empresa criada com Sucesso!!", {
                    iconPack: 'fontawesome',
                    icon: "fa-check-circle",
                    theme: "bubble",
                    position: "bottom-right",
                    duration: 2000
                });

                this.$store.commit('mudarStatus', 2);
                this.$router.push("/");


                //this.getEmpresa();
            },
            atualizarEmpresa() {
                //console.log("empresa Atualizada");
            },
            mascaraCnpj(valor) {
                return valor.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/g, "\$1.\$2.\$3\/\$4\-\$5");
            }
        },
        validations: {
            nomeEmpresa: {required},
            cnpj: {numeric, required}
        }
    }
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
</style>
