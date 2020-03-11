<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CasoDeUsoSeeder extends Seeder {

    public function run() {
        //
        DB::table('permissao')->insert([
                                           'name' => 'set_perfil',
                                           'label' => 'vincula perfil ao usuario',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'del_perfil',
                                           'label' => 'desvincula perfil e usuario',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'index_user',
                                           'label' => 'retorna todos usuários',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'criar_user',
                                           'label' => 'cria novo usuário',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'show_user',
                                           'label' => 'exibe usuário juntamente com array de permissões',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'update_user',
                                           'label' => 'atualiza informações do usuário',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'destroy_user',
                                           'label' => 'apaga por completo o usuário',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'listar_users_desat',
                                           'label' => 'listar_users_desat',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'desativar_user',
                                           'label' => 'configura usuário como INATIVO',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'index_emp_model',
                                           'label' => 'retorna todos modelos de documentos da empresa',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'criar_emp_model',
                                           'label' => 'cria modelo de documentos para a empresa',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'show_emp_model',
                                           'label' => 'exibe modelo de documento da empresa',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'update_emp_model',
                                           'label' => 'atualiza modelo de documento da empresa',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'destroy_emp_model',
                                           'label' => 'apaga por completo o modelo de documento da empresa',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'listar_emp_model_desat',
                                           'label' => 'listar_emp_model_desat',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'desativar_emp_model',
                                           'label' => 'configura modelo de documento como INATIVO',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'index_permissao',
                                           'label' => 'lista todas permissões',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'criar_permissao',
                                           'label' => 'cria uma nova permissão',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'show_permissao',
                                           'label' => 'exibe permissão',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'update_permissao',
                                           'label' => 'atualiza informações da permissao',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'destroy_permissao',
                                           'label' => 'apaga por completo a permissao',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'desativar_permissao',
                                           'label' => 'configura permissao como INATIVA',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'index_perfil',
                                           'label' => 'exibe todos os perfis',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'sync_permissao',
                                           'label' => 'sync_permissao',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'criar_perfil',
                                           'label' => 'Cria um novo perfil',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'show_perfil',
                                           'label' => 'exibe perfil',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'update_perfil',
                                           'label' => 'atualiza o perfil',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'destroy_perfil',
                                           'label' => 'apaga por completo o perfil',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'listar_perfis_desat',
                                           'label' => 'listar_perfis_desat',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'desativar_perfil',
                                           'label' => 'configura o perfil como INATIVO',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'index_user_model',
                                           'label' => 'exibe todos os modelos de documentos do usuario',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'criar_user_model',
                                           'label' => 'cria um novo modelo de documento do usuário',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'show_user_model',
                                           'label' => 'exibe o modelo de documento do usuário',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'update_user_model',
                                           'label' => 'atualiza o modelo de documento do usuário',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'destroy_user_model',
                                           'label' => 'apaga por completo o modelo de documento do usuário',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'desativar_user_model',
                                           'label' => 'configura como INATIVO o modelo de documento do usuário',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'index_responsavel',
                                           'label' => 'exibe todos os responsaveis',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'criar_responsavel',
                                           'label' => 'cria um novo responsavel',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'show_responsavel',
                                           'label' => 'exibe o responsavel',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'update_responsavel',
                                           'label' => 'atualiza informações do responsavel',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'destroy_responsavel',
                                           'label' => 'apaga por completo o responsavel',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'list_user_model_desat',
                                           'label' => 'list_user_model_desat',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'listar_resp_desat',
                                           'label' => 'listar_resp_desat',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'desativar_responsavel',
                                           'label' => 'configura o responsavel como INATIVO',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'listar_desat_resp',
                                           'label' => 'lista responsaveis desativados',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'index_empresa',
                                           'label' => 'lista empresas',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'criar_empresa',
                                           'label' => 'Cria nova empresa',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'show_empresa',
                                           'label' => 'Exibe empresa',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'update_empresa',
                                           'label' => 'Atualiza informações da empresa',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'destroy_empresa',
                                           'label' => 'Deleta empresa por completo',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'desativar_empresa',
                                           'label' => 'Desativa Empresa',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'index_cat',
                                           'label' => 'index categoria',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'listar_emp_desat',
                                           'label' => 'listar_emp_desat',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'criar_cat',
                                           'label' => 'criar categoria',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'show_filial',
                                           'label' => 'show_filial',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'listar_filial_desat',
                                           'label' => 'listar_filial_desat',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'desativar_filial',
                                           'label' => 'desativar_filial',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'destroy_filial',
                                           'label' => 'destroy_filial',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'update_filial',
                                           'label' => 'update_filial',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'criar_filial',
                                           'label' => 'criar_filial',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'index_filial',
                                           'label' => 'index_filial',
                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'listar_cat_desat',
                                           'label' => 'listar_cat_desat',
                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'desativar_cat',
                                           'label' => 'desativar_cat',
                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'destroy_cat',
                                           'label' => 'destroy_cat',
                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'update_cat',
                                           'label' => 'update_cat',
                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'show_cat',
                                           'label' => 'show_cat',
                                       ]);

        DB::table('permissao')->insert([
                                           'name' => 'index_atendimento',
                                           'label' => 'index_atendimento',
                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'criar_atendimento',
                                           'label' => 'criar_atendimento',
                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'show_atendimento',
                                           'label' => 'show_atendimento',

                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'update_atendimento',
                                           'label' => 'update_atendimento',
                                       ]);

        DB::table('permissao')->insert([
                                           'name' => 'destroy_atendimento',
                                           'label' => 'destroy_atendimento',
                                       ]);
        DB::table('permissao')->insert([
                                           'name' => 'buscar_atendimento',
                                           'label' => 'buscar_atendimento',
                                       ]);


        DB::table('empresas')->insert([
                                          'cpf_cnpj' => '11111111',
                                          'logo_marca' => 'Empresa 1',

                                      ]);
        DB::table('empresas')->insert([
                                          'cpf_cnpj' => '222222',
                                          'logo_marca' => 'Empresa 2',

                                      ]);
        DB::table('empresas')->insert([
                                          'cpf_cnpj' => '3333333',
                                          'logo_marca' => 'Empresa 3 tem filial',

                                      ]);

        DB::table('users')->insert([
                                       'name' => 'Nylo FP',
                                       'email' => 'nylo@nylo',
                                       'password' => '1234',
                                       'empresa_id' => '1'


                                   ]);
        DB::table('users')->insert([
                                       'name' => 'Matheus',
                                       'email' => 'teu@teu',
                                       'password' => '1234',
                                       'empresa_id' => '2'
                                   ]);
        DB::table('users')->insert([
                                       'name' => 'User tres',
                                       'email' => 'tres@tres',
                                       'password' => '1234',
                                       'empresa_id' => '3'
                                   ]);

        DB::table('perfil')->insert([
                                        'name' => 'Master',
                                        'empresa_id' => '1',

                                    ]);
        DB::table('perfil')->insert([
                                        'name' => 'Profissional',
                                        'empresa_id' => '1',
                                    ]);
        DB::table('perfil')->insert([
                                        'name' => 'secretarix',
                                        'empresa_id' => '1',
                                    ]);

        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '1',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '2',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '3',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '4',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '5',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '6',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '7',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '8',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '9',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '10',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '11',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '12',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '13',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '14',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '14',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '15',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '16',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '17',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '18',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '19',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '20',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '21',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '22',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '23',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '24',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '25',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '26',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '27',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '28',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '29',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '30',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '31',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '32',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '33',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '34',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '35',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '36',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '37',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '38',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '39',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '40',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '41',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '42',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '43',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '44',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '45',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '46',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '47',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '48',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '49',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '50',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '51',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '52',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '53',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '54',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '55',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '56',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '57',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '58',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '59',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '60',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '61',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '62',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '63',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '64',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '65',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '66',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '67',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '68',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '69',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '70',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '71',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '1',
                                                  'permissao_id' => '72',

                                              ]);

        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '2',
                                                  'permissao_id' => '1',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '2',
                                                  'permissao_id' => '2',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '2',
                                                  'permissao_id' => '3',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '2',
                                                  'permissao_id' => '4',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '2',
                                                  'permissao_id' => '5',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '2',
                                                  'permissao_id' => '6',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '2',
                                                  'permissao_id' => '7',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '2',
                                                  'permissao_id' => '8',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '2',
                                                  'permissao_id' => '9',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '2',
                                                  'permissao_id' => '10',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '2',
                                                  'permissao_id' => '11',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '2',
                                                  'permissao_id' => '12',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '2',
                                                  'permissao_id' => '13',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '3',
                                                  'permissao_id' => '1',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '3',
                                                  'permissao_id' => '2',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '3',
                                                  'permissao_id' => '3',

                                              ]);
        DB::table('perfil_permissao')->insert([
                                                  'perfil_id' => '3',
                                                  'permissao_id' => '4',

                                              ]);

        DB::table('perfil_user')->insert([
                                             'user_id' => '1',
                                             'perfil_id' => '1',
                                         ]);
        DB::table('perfil_user')->insert([
                                             'user_id' => '2',
                                             'perfil_id' => '2',
                                         ]);
        DB::table('perfil_user')->insert([
                                             'user_id' => '3',
                                             'perfil_id' => '3',
                                         ]);

        DB::table('empresa_filiais')->insert([
                                                 'name' => 'Filial Um Emp1',
                                                 'empresa_id' => '1',
                                             ]);
        DB::table('empresa_filiais')->insert([
                                                 'name' => 'Filial Dois Emp1',
                                                 'empresa_id' => '1',
                                             ]);
        DB::table('empresa_filiais')->insert([
                                                 'name' => 'Filial Um Emp2',
                                                 'empresa_id' => '2',
                                             ]);
        DB::table('empresa_filiais')->insert([
                                                 'name' => 'Filial Dois Emp2',
                                                 'empresa_id' => '2',
                                             ]);
        DB::table('empresa_filiais')->insert([
                                                 'name' => 'Filial Um Emp3',
                                                 'empresa_id' => '3',
                                             ]);
        DB::table('empresa_filiais')->insert([
                                                 'name' => 'Filial Dois Emp3',
                                                 'empresa_id' => '3',
                                             ]);

        DB::table('empresa_categorias')->insert([
                                                    'name' => 'Escola',
                                                    'descricao' => 'Categoria Um',
                                                    'empresa_id' => '1',
                                                ]);
        DB::table('empresa_categorias')->insert([
                                                    'name' => 'Consultorio',
                                                    'descricao' => 'Categoria Dois',
                                                    'empresa_id' => '2',
                                                ]);
        DB::table('empresa_categorias')->insert([
                                                    'name' => 'Manicomio',
                                                    'descricao' => 'Categoria Tres',
                                                    'empresa_id' => '3',
                                                ]);

        DB::table('pacientes')->insert([
                                           'nome' => 'Paciente 1 Prof 1',
                                           'user_id' => '1',
                                       ]);
        DB::table('pacientes')->insert([
                                           'nome' => 'Paciente 2 Prof 1',
                                           'user_id' => '1',
                                       ]);
        DB::table('pacientes')->insert([
                                           'nome' => 'Paciente 1 Prof 2',
                                           'user_id' => '2',
                                       ]);
        DB::table('pacientes')->insert([
                                           'nome' => 'Paciente 2 Prof 2',
                                           'user_id' => '2',
                                       ]);
        DB::table('pacientes')->insert([
                                           'nome' => 'Paciente 1 Prof 3',
                                           'user_id' => '3',
                                       ]);
        DB::table('pacientes')->insert([
                                           'nome' => 'Paciente 2 Prof 3',
                                           'user_id' => '3',
                                       ]);

        DB::table('atendimentos')->insert([
                                              'status' => 'paciente 1 profissional 1',
                                              'user_id' => '1',
                                              'paciente_id' => '1',
                                              'procedimento' => 'consulta',
                                              'data' => '2020-03-20 12:30:00.000000'
                                          ]);
        DB::table('atendimentos')->insert([
                                              'status' => 'paciente 2 profissional 1',
                                              'user_id' => '1',
                                              'paciente_id' => '2',
                                              'procedimento' => 'consulta',
                                              'data' => '2020-03-20 14:30:00.000000'
                                          ]);
        DB::table('atendimentos')->insert([
                                              'status' => 'paciente 1 profissional 2',
                                              'user_id' => '2',
                                              'paciente_id' => '3',
                                              'procedimento' => 'consulta',
                                              'data' => '2020-03-22 12:30:00.000000'
                                          ]);
        DB::table('atendimentos')->insert([
                                              'status' => 'paciente 2 profissional 2',
                                              'user_id' => '2',
                                              'paciente_id' => '4',
                                              'procedimento' => 'consulta',
                                              'data' => '2020-03-20 12:30:00.000000'
                                          ]);
        DB::table('atendimentos')->insert([
                                              'status' => 'paciente 1 profissional 3',
                                              'user_id' => '3',
                                              'paciente_id' => '5',
                                              'procedimento' => 'consulta',
                                              'data' => '2020-03-20 15:30:00.000000'
                                          ]);
        DB::table('atendimentos')->insert([
                                              'status' => 'paciente 2 profissional 3',
                                              'user_id' => '3',
                                              'paciente_id' => '6',
                                              'procedimento' => 'consulta',
                                              'data' => '2020-03-22 12:30:00.000000'
                                          ]);

    }
}
