<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CasoDeUsoSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void    id    name    label    active    created_at    updated_at
     */
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
                                           'name' => 'set_permissao',
                                           'label' => 'vincula permissao ao perfil',

                                       ]);

        DB::table('permissao')->insert([
                                           'name' => 'del_permissao',
                                           'label' => 'desvincula permissao ao perfil',

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
                                           'name' => '',
                                           'label' => '',

                                       ]);

        DB::table('permissao')->insert([
                                           'name' => '',
                                           'label' => '',

                                       ]);

        DB::table('permissao')->insert([
                                           'name' => '',
                                           'label' => '',

                                       ]);

        DB::table('permissao')->insert([
                                           'name' => '',
                                           'label' => '',

                                       ]);

        DB::table('permissao')->insert([
                                           'name' => '',
                                           'label' => '',

                                       ]);

        DB::table('permissao')->insert([
                                           'name' => '',
                                           'label' => '',

                                       ]);


    }
}
