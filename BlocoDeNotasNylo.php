<?php
/**
 * Criado por  PhpStorm
 * User:       Nylo Pinto
 * Filename:   BlocoDeNotasNylo.php
 * Data:       27/01/2020
 * Hora:       20:28
 */

/*
 *
 *
<?php

obs lista de permissões do sistema
=== USER CONTROLLER
set_perfil - vincula perfil ao usuario
del_perfil - desvincula perfil e usuario
index_user - retorna todos usuários (pertencentes a mesma empresa)
criar_user - cria novo usuário
show_user - exibe usuário juntamente com array de permissões
update_user - atualiza informações do usuário
destroy_user - apaga por completo o usuário
desativar_user - configura usuário como INATIVO
=== EMPRESA MODELO DOCS CONTROLLER
index_emp_model - retorna todos modelos de documentos da empresa
criar_emp_model - cria modelo de documentos para a empresa
show_emp_model - exibe modelo de documento da empresa
update_emp_model - atualiza modelo de documento da empresa
destroy_emp_model - apaga por completo o modelo de documento da empresa
desativar_emp_model - configura modelo de documento como INATIVO
=== USER PERMISSAO CONTROLLER
index_permissao - lista todas permissões
criar_permissao - cria uma nova permissão
show_permissao - exibe permissão
update_permissao - atualiza informações da permissao
destroy_permissao - apaga por completo a permissao
desativar_permissao - configura permissao como INATIVA
=== USER PERFIL CONTROLLER
index_perfil - exibe todos os perfis
set_permissao - vincula permissao ao perfil
del_permissao - desvincula permissao ao perfil
criar_perfil - Cria um novo perfil
show_perfil - exibe perfil
update_perfil - atualiza o perfil
destroy_perfil - apaga por completo o perfil
desativar_perfil - configura o perfil como INATIVO
=== USER MODELO DOCS CONTROLLER
index_user_model - exibe todos os modelos de documentos do usuario
criar_user_model - cria um novo modelo de documento do usuário
show_user_model - exibe o modelo de documento do usuário
update_user_model - atualiza o modelo de documento do usuário
destroy_user_model - apaga por completo o modelo de documento do usuário
desativar_user_model - configura como INATIVO o modelo de documento do usuário
=== RESPONSAVEL CONTROLLER
index_responsavel - exibe todos os responsaveis
criar_responsavel - cria um novo responsavel
show_responsavel - exibe o responsavel
update_responsavel - atualiza informações do responsavel
destroy_responsavel - apaga por completo o responsavel
desativar_responsavel - configura o responsavel como INATIVO
listar_desat_resp - lista responsaveis desativados

        // Exemplo de Restrições de Acesso para perfil de usuário
        if( Gate::denies('ver_ficha_completa') ){
            abort(403, 'Não Autorizado!');
        }

o nome ver_ficha_completa deve constar nas permissões do usuário


*/

