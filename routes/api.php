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
Route::get('show-user-perfil-json/{user_perfil_json}', 'UserController@showUserPerfil');
Route::post('criar-user-perfil-json', 'UserController@criarUserPerfil');
Route::patch('editar-user-perfil-json/{user_perfil_json}', 'UserController@updateUserPerfil');
Route::delete('destruir-user-perfil-json/{user_perfil_json}', 'UserController@destruirUserPerfil');
Route::patch('desativar-user-perfil-json/{user_perfil_json}', 'UserController@desativarUserPerfil');

// rotas para USER PERMISSÃO
Route::get('show-user-permissao-json/{user_permissao_json}', 'UserController@showPermissao');
Route::post('criar-user-permissao-json', 'UserController@criarPermissao');
Route::patch('editar-user-permissao-json/{user_permissao_json}', 'UserController@updatePermissao');
Route::delete('destruir-user-permissao-json/{user_permissao_json}', 'UserController@destruirPermissao');
Route::patch('desativar-user-permissao-json/{user_permissao_json}', 'UserController@desativarPermissao');

// rotas para USER MODELO DOCS
Route::get('show-user-modelos-json/{user_modelo_json}', 'UserController@showModeloDocs');
Route::post('criar-user-modelos-json', 'UserController@criarModeloDocs');
Route::patch('editar-user-modelos-json/{user_modelo_json}', 'UserController@updateModeloDocs');
Route::delete('destruir-user-modelos-json/{user_modelo_json}', 'UserController@destruirModeloDocs');
Route::patch('desativar-user-modelos-json/{user_modelo_json}', 'UserController@desativarModeloDocs');

// rotas para RESPONSAVEL
Route::resource('responsavel-json', 'ResponsavelController');
Route::patch('desativar-responsavel-json/{responsavel_json}', 'ResponsavelController@desativarResponsavel');
Route::get('excluidos-responsavel-json/{responsavel_json}', 'ResponsavelController@excluidosResponsavel');

// rotas para EMPRESA
Route::resource('empresa-json', 'EmpresaController');
Route::patch('desativar-empresa-json/{empresa_json}', 'EmpresaController@desativarEmpresa');

/// rotas para FILIAL
Route::get('show-filial-json/{empresa_filial_json}', 'EmpresaController@showFilial');
Route::post('criar-filial-json', 'EmpresaController@criarFilial');
Route::patch('editar-filial-json/{empresa_filial_json}', 'EmpresaController@updateFilial');
Route::delete('destruir-filial-json/{empresa_filial_json}', 'EmpresaController@destruirFilial');
Route::patch('desativar-filial-json/{empresa_filial_json}', 'EmpresaController@desativarFilial');

// rotas para EMPRESA MODELO DOCS
Route::get('show-empresa-modelos-json/{empresa_modelo_json}', 'EmpresaController@showModeloDocs');
Route::post('criar-empresa-modelos-json', 'EmpresaController@criarModeloDocs');
Route::patch('editar-empresa-modelos-json/{empresa_modelo_json}', 'EmpresaController@updateModeloDocs');
Route::delete('destruir-empresa-modelos-json/{empresa_modelo_json}', 'EmpresaController@destruirModeloDocs');
Route::patch('desativar-empresa-modelos-json/{empresa_modelo_json}', 'EmpresaController@desativarModeloDocs');

// rotas para EMPRESA CATEGORIAS
Route::get('show-empresa-categoria-json/{empresa_categoria_json}', 'EmpresaController@showCategoria');
Route::post('criar-empresa-categoria-json', 'EmpresaController@criarCategoria');
Route::patch('editar-empresa-categoria-json/{empresa_categoria_json}', 'EmpresaController@updateCategoria');
Route::delete('destruir-empresa-categoria-json/{empresa_categoria_json}', 'EmpresaController@destruirCategoria');
Route::patch('desativar-empresa-categoria-json/{empresa_categoria_json}', 'EmpresaController@desativarCategoria');

// rotas para PACIENTE
Route::resource('paciente-json', 'PacienteController');
Route::patch('desativar-paciente-json/{paciente_json}', 'PacienteController@desativarPaciente');


/*
+--------+-----------+---------------------------------------------------------------+--------------------------+-----------------------------------------------------------------+--------------+
| Domain | Method    | URI                                                           | Name                     | Action                                                          | Middleware   |
+--------+-----------+---------------------------------------------------------------+--------------------------+-----------------------------------------------------------------+--------------+
|        | GET|HEAD  | /                                                             |                          | Closure                                                         | web          |
|        | POST      | api/criar-empresa-categoria-json                              |                          | App\Http\Controllers\EmpresaController@criarCategoria           | api          |
|        | POST      | api/criar-empresa-modelos-json                                |                          | App\Http\Controllers\EmpresaController@criarModeloDocs          | api          |
|        | POST      | api/criar-filial-json                                         |                          | App\Http\Controllers\EmpresaController@criarFilial              | api          |
|        | POST      | api/criar-user-modelos-json                                   |                          | App\Http\Controllers\UserController@criarModeloDocs             | api          |
|        | POST      | api/criar-user-perfil-json                                    |                          | App\Http\Controllers\UserController@criarUserPerfil             | api          |
|        | POST      | api/criar-user-permissao-json                                 |                          | App\Http\Controllers\UserController@criarPermissao              | api          |
|        | PATCH     | api/desativar-empresa-categoria-json/{empresa_categoria_json} |                          | App\Http\Controllers\EmpresaController@desativarCategoria       | api          |
|        | PATCH     | api/desativar-empresa-json/{empresa_json}                     |                          | App\Http\Controllers\EmpresaController@desativarEmpresa         | api          |
|        | PATCH     | api/desativar-empresa-modelos-json/{empresa_modelo_json}      |                          | App\Http\Controllers\EmpresaController@desativarModeloDocs      | api          |
|        | PATCH     | api/desativar-filial-json/{empresa_filial_json}               |                          | App\Http\Controllers\EmpresaController@desativarFilial          | api          |
|        | PATCH     | api/desativar-paciente-json/{paciente_json}                   |                          | App\Http\Controllers\PacienteController@desativarPaciente       | api          |
|        | PATCH     | api/desativar-responsavel-json/{responsavel_json}             |                          | App\Http\Controllers\ResponsavelController@desativarResponsavel | api          |
|        | PATCH     | api/desativar-user-json/{user_json}                           |                          | App\Http\Controllers\UserController@desativarUser               | api          |
|        | PATCH     | api/desativar-user-modelos-json/{user_modelo_json}            |                          | App\Http\Controllers\UserController@desativarModeloDocs         | api          |
|        | PATCH     | api/desativar-user-perfil-json/{user_perfil_json}             |                          | App\Http\Controllers\UserController@desativarUserPerfil         | api          |
|        | PATCH     | api/desativar-user-permissao-json/{user_permissao_json}       |                          | App\Http\Controllers\UserController@desativarPermissao          | api          |
|        | DELETE    | api/destruir-empresa-categoria-json/{empresa_categoria_json}  |                          | App\Http\Controllers\EmpresaController@destruirCategoria        | api          |
|        | DELETE    | api/destruir-empresa-modelos-json/{empresa_modelo_json}       |                          | App\Http\Controllers\EmpresaController@destruirModeloDocs       | api          |
|        | DELETE    | api/destruir-filial-json/{empresa_filial_json}                |                          | App\Http\Controllers\EmpresaController@destruirFilial           | api          |
|        | DELETE    | api/destruir-user-modelos-json/{user_modelo_json}             |                          | App\Http\Controllers\UserController@destruirModeloDocs          | api          |
|        | DELETE    | api/destruir-user-perfil-json/{user_perfil_json}              |                          | App\Http\Controllers\UserController@destruirUserPerfil          | api          |
|        | DELETE    | api/destruir-user-permissao-json/{user_permissao_json}        |                          | App\Http\Controllers\UserController@destruirPermissao           | api          |
|        | PATCH     | api/editar-empresa-categoria-json/{empresa_categoria_json}    |                          | App\Http\Controllers\EmpresaController@updateCategoria          | api          |
|        | PATCH     | api/editar-empresa-modelos-json/{empresa_modelo_json}         |                          | App\Http\Controllers\EmpresaController@updateModeloDocs         | api          |
|        | PATCH     | api/editar-filial-json/{empresa_filial_json}                  |                          | App\Http\Controllers\EmpresaController@updateFilial             | api          |
|        | PATCH     | api/editar-user-modelos-json/{user_modelo_json}               |                          | App\Http\Controllers\UserController@updateModeloDocs            | api          |
|        | PATCH     | api/editar-user-perfil-json/{user_perfil_json}                |                          | App\Http\Controllers\UserController@updateUserPerfil            | api          |
|        | PATCH     | api/editar-user-permissao-json/{user_permissao_json}          |                          | App\Http\Controllers\UserController@updatePermissao             | api          |
|        | GET|HEAD  | api/empresa-json                                              | empresa-json.index       | App\Http\Controllers\EmpresaController@index                    | api          |
|        | POST      | api/empresa-json                                              | empresa-json.store       | App\Http\Controllers\EmpresaController@store                    | api          |
|        | GET|HEAD  | api/empresa-json/create                                       | empresa-json.create      | App\Http\Controllers\EmpresaController@create                   | api          |
|        | GET|HEAD  | api/empresa-json/{empresa_json}                               | empresa-json.show        | App\Http\Controllers\EmpresaController@show                     | api          |
|        | DELETE    | api/empresa-json/{empresa_json}                               | empresa-json.destroy     | App\Http\Controllers\EmpresaController@destroy                  | api          |
|        | PUT|PATCH | api/empresa-json/{empresa_json}                               | empresa-json.update      | App\Http\Controllers\EmpresaController@update                   | api          |
|        | GET|HEAD  | api/empresa-json/{empresa_json}/edit                          | empresa-json.edit        | App\Http\Controllers\EmpresaController@edit                     | api          |
|        | GET|HEAD  | api/excluidos-responsavel-json/{responsavel_json}             |                          | App\Http\Controllers\ResponsavelController@excluidosResponsavel | api          |
|        | GET|HEAD  | api/paciente-json                                             | paciente-json.index      | App\Http\Controllers\PacienteController@index                   | api          |
|        | POST      | api/paciente-json                                             | paciente-json.store      | App\Http\Controllers\PacienteController@store                   | api          |
|        | GET|HEAD  | api/paciente-json/create                                      | paciente-json.create     | App\Http\Controllers\PacienteController@create                  | api          |
|        | GET|HEAD  | api/paciente-json/{paciente_json}                             | paciente-json.show       | App\Http\Controllers\PacienteController@show                    | api          |
|        | PUT|PATCH | api/paciente-json/{paciente_json}                             | paciente-json.update     | App\Http\Controllers\PacienteController@update                  | api          |
|        | DELETE    | api/paciente-json/{paciente_json}                             | paciente-json.destroy    | App\Http\Controllers\PacienteController@destroy                 | api          |
|        | GET|HEAD  | api/paciente-json/{paciente_json}/edit                        | paciente-json.edit       | App\Http\Controllers\PacienteController@edit                    | api          |
|        | POST      | api/responsavel-json                                          | responsavel-json.store   | App\Http\Controllers\ResponsavelController@store                | api          |
|        | GET|HEAD  | api/responsavel-json                                          | responsavel-json.index   | App\Http\Controllers\ResponsavelController@index                | api          |
|        | GET|HEAD  | api/responsavel-json/create                                   | responsavel-json.create  | App\Http\Controllers\ResponsavelController@create               | api          |
|        | DELETE    | api/responsavel-json/{responsavel_json}                       | responsavel-json.destroy | App\Http\Controllers\ResponsavelController@destroy              | api          |
|        | PUT|PATCH | api/responsavel-json/{responsavel_json}                       | responsavel-json.update  | App\Http\Controllers\ResponsavelController@update               | api          |
|        | GET|HEAD  | api/responsavel-json/{responsavel_json}                       | responsavel-json.show    | App\Http\Controllers\ResponsavelController@show                 | api          |
|        | GET|HEAD  | api/responsavel-json/{responsavel_json}/edit                  | responsavel-json.edit    | App\Http\Controllers\ResponsavelController@edit                 | api          |
|        | GET|HEAD  | api/show-empresa-categoria-json/{empresa_categoria_json}      |                          | App\Http\Controllers\EmpresaController@showCategoria            | api          |
|        | GET|HEAD  | api/show-empresa-modelos-json/{empresa_modelo_json}           |                          | App\Http\Controllers\EmpresaController@showModeloDocs           | api          |
|        | GET|HEAD  | api/show-filial-json/{empresa_filial_json}                    |                          | App\Http\Controllers\EmpresaController@showFilial               | api          |
|        | GET|HEAD  | api/show-user-modelos-json/{user_modelo_json}                 |                          | App\Http\Controllers\UserController@showModeloDocs              | api          |
|        | GET|HEAD  | api/show-user-perfil-json/{user_perfil_json}                  |                          | App\Http\Controllers\UserController@showUserPerfil              | api          |
|        | GET|HEAD  | api/show-user-permissao-json/{user_permissao_json}            |                          | App\Http\Controllers\UserController@showPermissao               | api          |
|        | GET|HEAD  | api/user                                                      |                          | Closure                                                         | api,auth:api |
|        | GET|HEAD  | api/user-json                                                 | user-json.index          | App\Http\Controllers\UserController@index                       | api          |
|        | POST      | api/user-json                                                 | user-json.store          | App\Http\Controllers\UserController@store                       | api          |
|        | GET|HEAD  | api/user-json/create                                          | user-json.create         | App\Http\Controllers\UserController@create                      | api          |
|        | GET|HEAD  | api/user-json/{user_json}                                     | user-json.show           | App\Http\Controllers\UserController@show                        | api          |
|        | PUT|PATCH | api/user-json/{user_json}                                     | user-json.update         | App\Http\Controllers\UserController@update                      | api          |
|        | DELETE    | api/user-json/{user_json}                                     | user-json.destroy        | App\Http\Controllers\UserController@destroy                     | api          |
|        | GET|HEAD  | api/user-json/{user_json}/edit                                | user-json.edit           | App\Http\Controllers\UserController@edit                        | api          |
+--------+-----------+---------------------------------------------------------------+--------------------------+-----------------------------------------------------------------+--------------+
*/
