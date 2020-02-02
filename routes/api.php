<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// rotas para USER
Route::resource('user-json', 'UserController');
Route::patch('desativar-user-json/{user_json}', 'UserController@desativarUser');

// rotas para USER PERFIL
Route::resource('user-perfil-json', 'UserPerfilController');
Route::patch('desativar-user-perfil-json/{user_perfil_json}', 'UserPerfilController@desativarUserPerfil');

// rotas para USER PERMISSÃO
Route::resource('user-permissao-json', 'UserPermissaoController');
Route::patch('desativar-user-permissao-json/{user_permissao_json}', 'UserPermissaoController@desativarPermissao');

// rotas para USER MODELO DOCS
Route::resource('user-modelo-docs-json', 'UserModeloDocsController');
Route::patch('desativar-user-modelo-docs-json/{user_modelo_docs_json}', 'UserModeloDocsController@desativarModeloDocs');

// rotas para RESPONSAVEL
Route::resource('responsavel-json', 'ResponsavelController');
Route::patch('desativar-responsavel-json/{responsavel_json}', 'ResponsavelController@desativarResponsavel');
Route::get('excluidos-responsavel-json/{responsavel_json}', 'ResponsavelController@excluidosResponsavel');

// rotas para EMPRESA
Route::resource('empresa-json', 'EmpresaController');
Route::patch('desativar-empresa-json/{empresa_json}', 'EmpresaController@desativarEmpresa');

/// rotas para FILIAL
Route::resource('empresa-filial-json', 'EmpresaFilialController');
Route::patch('desativar-empresa-filial-json/{empresa_filial_json}', 'EmpresaFilialController@desativarFilial');

// rotas para EMPRESA MODELO DOCS
Route::resource('empresa-modelo-docs-json', 'EmpresaModeloDocsController');
Route::patch('desativar-empresa-modelo-docs-json/{empresa_modelo_docs_json}', 'EmpresaModeloDocsController@desativarModeloDocs');

// rotas para EMPRESA CATEGORIAS
Route::resource('empresa-categoria-json', 'EmpresaCategoriaController');
Route::patch('desativar-empresa-categoria-json/{empresa_categoria_json}', 'EmpresaCategoriaController@desativarCategoria');

// rotas para PACIENTE
Route::resource('paciente-json', 'PacienteController');
Route::patch('desativar-paciente-json/{paciente_json}', 'PacienteController@desativarPaciente');


/*
 +--------+-----------+-------------------------------------------------------------------+----------------------------------+----------------------------------------------------------------------+--------------+
| Domain | Method    | URI                                                               | Name                             | Action                                                               | Middleware   |
+--------+-----------+-------------------------------------------------------------------+----------------------------------+----------------------------------------------------------------------+--------------+
|        | GET|HEAD  | /                                                                 |                                  | Closure                                                              | web          |
|        | PATCH     | api/desativar-empresa-categoria-json/{empresa_categoria_json}     |                                  | App\Http\Controllers\EmpresaCategoriaController@desativarCategoria   | api          |
|        | PATCH     | api/desativar-empresa-filial-json/{empresa_filial_json}           |                                  | App\Http\Controllers\EmpresaFilialController@desativarFilial         | api          |
|        | PATCH     | api/desativar-empresa-json/{empresa_json}                         |                                  | App\Http\Controllers\EmpresaController@desativarEmpresa              | api          |
|        | PATCH     | api/desativar-empresa-modelo-docs-json/{empresa_modelo_docs_json} |                                  | App\Http\Controllers\EmpresaModeloDocsController@desativarModeloDocs | api          |
|        | PATCH     | api/desativar-paciente-json/{paciente_json}                       |                                  | App\Http\Controllers\PacienteController@desativarPaciente            | api          |
|        | PATCH     | api/desativar-responsavel-json/{responsavel_json}                 |                                  | App\Http\Controllers\ResponsavelController@desativarResponsavel      | api          |
|        | PATCH     | api/desativar-user-json/{user_json}                               |                                  | App\Http\Controllers\UserController@desativarUser                    | api          |
|        | PATCH     | api/desativar-user-modelo-docs-json/{user_modelo_docs_json}       |                                  | App\Http\Controllers\UserModeloDocsController@desativarModeloDocs    | api          |
|        | PATCH     | api/desativar-user-perfil-json/{user_perfil_json}                 |                                  | App\Http\Controllers\UserPerfilController@desativarUserPerfil        | api          |
|        | PATCH     | api/desativar-user-permissao-json/{user_permissao_json}           |                                  | App\Http\Controllers\UserPermissaoController@desativarPermissao      | api          |
|        | POST      | api/empresa-categoria-json                                        | empresa-categoria-json.store     | App\Http\Controllers\EmpresaCategoriaController@store                | api          |
|        | GET|HEAD  | api/empresa-categoria-json                                        | empresa-categoria-json.index     | App\Http\Controllers\EmpresaCategoriaController@index                | api          |
|        | GET|HEAD  | api/empresa-categoria-json/create                                 | empresa-categoria-json.create    | App\Http\Controllers\EmpresaCategoriaController@create               | api          |
|        | PUT|PATCH | api/empresa-categoria-json/{empresa_categoria_json}               | empresa-categoria-json.update    | App\Http\Controllers\EmpresaCategoriaController@update               | api          |
|        | GET|HEAD  | api/empresa-categoria-json/{empresa_categoria_json}               | empresa-categoria-json.show      | App\Http\Controllers\EmpresaCategoriaController@show                 | api          |
|        | DELETE    | api/empresa-categoria-json/{empresa_categoria_json}               | empresa-categoria-json.destroy   | App\Http\Controllers\EmpresaCategoriaController@destroy              | api          |
|        | GET|HEAD  | api/empresa-categoria-json/{empresa_categoria_json}/edit          | empresa-categoria-json.edit      | App\Http\Controllers\EmpresaCategoriaController@edit                 | api          |
|        | GET|HEAD  | api/empresa-filial-json                                           | empresa-filial-json.index        | App\Http\Controllers\EmpresaFilialController@index                   | api          |
|        | POST      | api/empresa-filial-json                                           | empresa-filial-json.store        | App\Http\Controllers\EmpresaFilialController@store                   | api          |
|        | GET|HEAD  | api/empresa-filial-json/create                                    | empresa-filial-json.create       | App\Http\Controllers\EmpresaFilialController@create                  | api          |
|        | GET|HEAD  | api/empresa-filial-json/{empresa_filial_json}                     | empresa-filial-json.show         | App\Http\Controllers\EmpresaFilialController@show                    | api          |
|        | DELETE    | api/empresa-filial-json/{empresa_filial_json}                     | empresa-filial-json.destroy      | App\Http\Controllers\EmpresaFilialController@destroy                 | api          |
|        | PUT|PATCH | api/empresa-filial-json/{empresa_filial_json}                     | empresa-filial-json.update       | App\Http\Controllers\EmpresaFilialController@update                  | api          |
|        | GET|HEAD  | api/empresa-filial-json/{empresa_filial_json}/edit                | empresa-filial-json.edit         | App\Http\Controllers\EmpresaFilialController@edit                    | api          |
|        | POST      | api/empresa-json                                                  | empresa-json.store               | App\Http\Controllers\EmpresaController@store                         | api          |
|        | GET|HEAD  | api/empresa-json                                                  | empresa-json.index               | App\Http\Controllers\EmpresaController@index                         | api          |
|        | GET|HEAD  | api/empresa-json/create                                           | empresa-json.create              | App\Http\Controllers\EmpresaController@create                        | api          |
|        | PUT|PATCH | api/empresa-json/{empresa_json}                                   | empresa-json.update              | App\Http\Controllers\EmpresaController@update                        | api          |
|        | DELETE    | api/empresa-json/{empresa_json}                                   | empresa-json.destroy             | App\Http\Controllers\EmpresaController@destroy                       | api          |
|        | GET|HEAD  | api/empresa-json/{empresa_json}                                   | empresa-json.show                | App\Http\Controllers\EmpresaController@show                          | api          |
|        | GET|HEAD  | api/empresa-json/{empresa_json}/edit                              | empresa-json.edit                | App\Http\Controllers\EmpresaController@edit                          | api          |
|        | GET|HEAD  | api/empresa-modelo-docs-json                                      | empresa-modelo-docs-json.index   | App\Http\Controllers\EmpresaModeloDocsController@index               | api          |
|        | POST      | api/empresa-modelo-docs-json                                      | empresa-modelo-docs-json.store   | App\Http\Controllers\EmpresaModeloDocsController@store               | api          |
|        | GET|HEAD  | api/empresa-modelo-docs-json/create                               | empresa-modelo-docs-json.create  | App\Http\Controllers\EmpresaModeloDocsController@create              | api          |
|        | GET|HEAD  | api/empresa-modelo-docs-json/{empresa_modelo_docs_json}           | empresa-modelo-docs-json.show    | App\Http\Controllers\EmpresaModeloDocsController@show                | api          |
|        | PUT|PATCH | api/empresa-modelo-docs-json/{empresa_modelo_docs_json}           | empresa-modelo-docs-json.update  | App\Http\Controllers\EmpresaModeloDocsController@update              | api          |
|        | DELETE    | api/empresa-modelo-docs-json/{empresa_modelo_docs_json}           | empresa-modelo-docs-json.destroy | App\Http\Controllers\EmpresaModeloDocsController@destroy             | api          |
|        | GET|HEAD  | api/empresa-modelo-docs-json/{empresa_modelo_docs_json}/edit      | empresa-modelo-docs-json.edit    | App\Http\Controllers\EmpresaModeloDocsController@edit                | api          |
|        | GET|HEAD  | api/excluidos-responsavel-json/{responsavel_json}                 |                                  | App\Http\Controllers\ResponsavelController@excluidosResponsavel      | api          |
|        | POST      | api/paciente-json                                                 | paciente-json.store              | App\Http\Controllers\PacienteController@store                        | api          |
|        | GET|HEAD  | api/paciente-json                                                 | paciente-json.index              | App\Http\Controllers\PacienteController@index                        | api          |
|        | GET|HEAD  | api/paciente-json/create                                          | paciente-json.create             | App\Http\Controllers\PacienteController@create                       | api          |
|        | DELETE    | api/paciente-json/{paciente_json}                                 | paciente-json.destroy            | App\Http\Controllers\PacienteController@destroy                      | api          |
|        | PUT|PATCH | api/paciente-json/{paciente_json}                                 | paciente-json.update             | App\Http\Controllers\PacienteController@update                       | api          |
|        | GET|HEAD  | api/paciente-json/{paciente_json}                                 | paciente-json.show               | App\Http\Controllers\PacienteController@show                         | api          |
|        | GET|HEAD  | api/paciente-json/{paciente_json}/edit                            | paciente-json.edit               | App\Http\Controllers\PacienteController@edit                         | api          |
|        | POST      | api/responsavel-json                                              | responsavel-json.store           | App\Http\Controllers\ResponsavelController@store                     | api          |
|        | GET|HEAD  | api/responsavel-json                                              | responsavel-json.index           | App\Http\Controllers\ResponsavelController@index                     | api          |
|        | GET|HEAD  | api/responsavel-json/create                                       | responsavel-json.create          | App\Http\Controllers\ResponsavelController@create                    | api          |
|        | DELETE    | api/responsavel-json/{responsavel_json}                           | responsavel-json.destroy         | App\Http\Controllers\ResponsavelController@destroy                   | api          |
|        | PUT|PATCH | api/responsavel-json/{responsavel_json}                           | responsavel-json.update          | App\Http\Controllers\ResponsavelController@update                    | api          |
|        | GET|HEAD  | api/responsavel-json/{responsavel_json}                           | responsavel-json.show            | App\Http\Controllers\ResponsavelController@show                      | api          |
|        | GET|HEAD  | api/responsavel-json/{responsavel_json}/edit                      | responsavel-json.edit            | App\Http\Controllers\ResponsavelController@edit                      | api          |
|        | GET|HEAD  | api/user                                                          |                                  | Closure                                                              | api,auth:api |
|        | GET|HEAD  | api/user-json                                                     | user-json.index                  | App\Http\Controllers\UserController@index                            | api          |
|        | POST      | api/user-json                                                     | user-json.store                  | App\Http\Controllers\UserController@store                            | api          |
|        | GET|HEAD  | api/user-json/create                                              | user-json.create                 | App\Http\Controllers\UserController@create                           | api          |
|        | DELETE    | api/user-json/{user_json}                                         | user-json.destroy                | App\Http\Controllers\UserController@destroy                          | api          |
|        | GET|HEAD  | api/user-json/{user_json}                                         | user-json.show                   | App\Http\Controllers\UserController@show                             | api          |
|        | PUT|PATCH | api/user-json/{user_json}                                         | user-json.update                 | App\Http\Controllers\UserController@update                           | api          |
|        | GET|HEAD  | api/user-json/{user_json}/edit                                    | user-json.edit                   | App\Http\Controllers\UserController@edit                             | api          |
|        | POST      | api/user-modelo-docs-json                                         | user-modelo-docs-json.store      | App\Http\Controllers\UserModeloDocsController@store                  | api          |
|        | GET|HEAD  | api/user-modelo-docs-json                                         | user-modelo-docs-json.index      | App\Http\Controllers\UserModeloDocsController@index                  | api          |
|        | GET|HEAD  | api/user-modelo-docs-json/create                                  | user-modelo-docs-json.create     | App\Http\Controllers\UserModeloDocsController@create                 | api          |
|        | PUT|PATCH | api/user-modelo-docs-json/{user_modelo_docs_json}                 | user-modelo-docs-json.update     | App\Http\Controllers\UserModeloDocsController@update                 | api          |
|        | GET|HEAD  | api/user-modelo-docs-json/{user_modelo_docs_json}                 | user-modelo-docs-json.show       | App\Http\Controllers\UserModeloDocsController@show                   | api          |
|        | DELETE    | api/user-modelo-docs-json/{user_modelo_docs_json}                 | user-modelo-docs-json.destroy    | App\Http\Controllers\UserModeloDocsController@destroy                | api          |
|        | GET|HEAD  | api/user-modelo-docs-json/{user_modelo_docs_json}/edit            | user-modelo-docs-json.edit       | App\Http\Controllers\UserModeloDocsController@edit                   | api          |
|        | POST      | api/user-perfil-json                                              | user-perfil-json.store           | App\Http\Controllers\UserPerfilController@store                      | api          |
|        | GET|HEAD  | api/user-perfil-json                                              | user-perfil-json.index           | App\Http\Controllers\UserPerfilController@index                      | api          |
|        | GET|HEAD  | api/user-perfil-json/create                                       | user-perfil-json.create          | App\Http\Controllers\UserPerfilController@create                     | api          |
|        | PUT|PATCH | api/user-perfil-json/{user_perfil_json}                           | user-perfil-json.update          | App\Http\Controllers\UserPerfilController@update                     | api          |
|        | DELETE    | api/user-perfil-json/{user_perfil_json}                           | user-perfil-json.destroy         | App\Http\Controllers\UserPerfilController@destroy                    | api          |
|        | GET|HEAD  | api/user-perfil-json/{user_perfil_json}                           | user-perfil-json.show            | App\Http\Controllers\UserPerfilController@show                       | api          |
|        | GET|HEAD  | api/user-perfil-json/{user_perfil_json}/edit                      | user-perfil-json.edit            | App\Http\Controllers\UserPerfilController@edit                       | api          |
|        | GET|HEAD  | api/user-permissao-json                                           | user-permissao-json.index        | App\Http\Controllers\UserPermissaoController@index                   | api          |
|        | POST      | api/user-permissao-json                                           | user-permissao-json.store        | App\Http\Controllers\UserPermissaoController@store                   | api          |
|        | GET|HEAD  | api/user-permissao-json/create                                    | user-permissao-json.create       | App\Http\Controllers\UserPermissaoController@create                  | api          |
|        | PUT|PATCH | api/user-permissao-json/{user_permissao_json}                     | user-permissao-json.update       | App\Http\Controllers\UserPermissaoController@update                  | api          |
|        | GET|HEAD  | api/user-permissao-json/{user_permissao_json}                     | user-permissao-json.show         | App\Http\Controllers\UserPermissaoController@show                    | api          |
|        | DELETE    | api/user-permissao-json/{user_permissao_json}                     | user-permissao-json.destroy      | App\Http\Controllers\UserPermissaoController@destroy                 | api          |
|        | GET|HEAD  | api/user-permissao-json/{user_permissao_json}/edit                | user-permissao-json.edit         | App\Http\Controllers\UserPermissaoController@edit                    | api          |
+--------+-----------+-------------------------------------------------------------------+----------------------------------+----------------------------------------------------------------------+--------------+
 */
