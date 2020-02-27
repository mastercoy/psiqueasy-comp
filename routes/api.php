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
Route::post('setar-perfil-user/{user_json}/{user_perfil_json}', 'UserController@setPerfilUser');
Route::get('remover-perfil-user/{user_json}', 'UserController@delPerfilUser');
Route::post('verificar-email', 'UserController@verificarEmail');
Route::get('inativos-user-json', 'UserController@inativosUser');

// rotas para USER PERFIL
Route::resource('user-perfil-json', 'UserPerfilController');
Route::patch('desativar-user-perfil-json/{user_perfil_json}', 'UserPerfilController@desativarUserPerfil');
Route::get('inativos-perfis-json', 'UserPerfilController@inativosPerfil');
Route::get('permissoes-perfil-json/{user_perfil_json}', 'UserPerfilController@quaisPermissoes');
Route::post('sync-permissoes-perfil/{user_perfil_json}', 'UserPerfilController@syncPermissoes');

// rotas para USER MODELO DOCS
Route::resource('user-modelo-docs-json', 'UserModeloDocsController');
Route::patch('desativar-user-modelo-docs-json/{user_modelo_docs_json}', 'UserModeloDocsController@desativarModeloDocs');
Route::get('inativos-user-model-docs-json', 'UserModeloDocsController@inativosModelUser');

// rotas para RESPONSAVEL
Route::resource('responsavel-json', 'ResponsavelController');
Route::patch('desativar-responsavel-json/{responsavel_json}', 'ResponsavelController@desativarResponsavel');
Route::get('inativos-responsavel-json', 'ResponsavelController@inativosResponsavel');

// rotas para EMPRESA
Route::resource('empresa-json', 'EmpresaController');
Route::patch('desativar-empresa-json/{empresa_json}', 'EmpresaController@desativarEmpresa');
Route::get('inativos-empresas-json', 'EmpresaController@inativosEmpresa');

/// rotas para FILIAL
Route::resource('empresa-filial-json', 'EmpresaFilialController');
Route::patch('desativar-empresa-filial-json/{empresa_filial_json}', 'EmpresaFilialController@desativarFilial');
Route::get('inativos-filial-json', 'EmpresaFilialController@inativosFilial');

// rotas para EMPRESA MODELO DOCS
Route::resource('empresa-modelo-docs-json', 'EmpresaModeloDocsController');
Route::patch('desativar-empresa-modelo-docs-json/{empresa_modelo_docs_json}', 'EmpresaModeloDocsController@desativarModeloDocs');
Route::get('inativos-emp-model-docs-json', 'EmpresaModeloDocsController@inativosModelEmp');

// rotas para EMPRESA CATEGORIAS
Route::resource('empresa-categoria-json', 'EmpresaCategoriaController');
Route::patch('desativar-empresa-categoria-json/{empresa_categoria_json}', 'EmpresaCategoriaController@desativarCategoria');
Route::get('inativos-categoria-json', 'EmpresaCategoriaController@inativosCategoria');

// rotas para USER PERFIL PIVOT
Route::resource('user-perfil-pivot-json', 'UserPerfilPivotController');

// rotas para PERFIL PERMISSAO PIVOT
Route::resource('perfil-permissao-pivot-json', 'PerfilPermissaoPivotController');

// rotas para ENVIO DE EMAIL - testando
Route::post('enviar-email', 'ConviteController@enviarEmail');
Route::post('reenviar-email', 'ConviteController@reenviarEmail');
Route::get('aceitar-convite/{token}', 'ConviteController@aceitar')->name('aceitar');


// ===============================================================================================================================

/*
 +--------+-----------+--------------------------------------------------------------------+-------------------------------------+------------------------------------------------------------------------+--------------+
| Domain | Method    | URI                                                                | Name                                | Action                                                                 | Middleware   |
+--------+-----------+--------------------------------------------------------------------+-------------------------------------+------------------------------------------------------------------------+--------------+
|        | GET|HEAD  | /                                                                  |                                     | Closure                                                                | web          |
|        | PATCH     | api/desativar-empresa-categoria-json/{empresa_categoria_json}      |                                     | App\Http\Controllers\EmpresaCategoriaController@desativarCategoria     | api          |
|        | PATCH     | api/desativar-empresa-filial-json/{empresa_filial_json}            |                                     | App\Http\Controllers\EmpresaFilialController@desativarFilial           | api          |
|        | PATCH     | api/desativar-empresa-json/{empresa_json}                          |                                     | App\Http\Controllers\EmpresaController@desativarEmpresa                | api          |
|        | PATCH     | api/desativar-empresa-modelo-docs-json/{empresa_modelo_docs_json}  |                                     | App\Http\Controllers\EmpresaModeloDocsController@desativarModeloDocs   | api          |
|        | PATCH     | api/desativar-responsavel-json/{responsavel_json}                  |                                     | App\Http\Controllers\ResponsavelController@desativarResponsavel        | api          |
|        | PATCH     | api/desativar-user-json/{user_json}                                |                                     | App\Http\Controllers\UserController@desativarUser                      | api          |
|        | PATCH     | api/desativar-user-modelo-docs-json/{user_modelo_docs_json}        |                                     | App\Http\Controllers\UserModeloDocsController@desativarModeloDocs      | api          |
|        | PATCH     | api/desativar-user-perfil-json/{user_perfil_json}                  |                                     | App\Http\Controllers\UserPerfilController@desativarUserPerfil          | api          |
|        | GET|HEAD  | api/empresa-categoria-json                                         | empresa-categoria-json.index        | App\Http\Controllers\EmpresaCategoriaController@index                  | api          |
|        | POST      | api/empresa-categoria-json                                         | empresa-categoria-json.store        | App\Http\Controllers\EmpresaCategoriaController@store                  | api          |
|        | GET|HEAD  | api/empresa-categoria-json/create                                  | empresa-categoria-json.create       | App\Http\Controllers\EmpresaCategoriaController@create                 | api          |
|        | PUT|PATCH | api/empresa-categoria-json/{empresa_categoria_json}                | empresa-categoria-json.update       | App\Http\Controllers\EmpresaCategoriaController@update                 | api          |
|        | GET|HEAD  | api/empresa-categoria-json/{empresa_categoria_json}                | empresa-categoria-json.show         | App\Http\Controllers\EmpresaCategoriaController@show                   | api          |
|        | DELETE    | api/empresa-categoria-json/{empresa_categoria_json}                | empresa-categoria-json.destroy      | App\Http\Controllers\EmpresaCategoriaController@destroy                | api          |
|        | GET|HEAD  | api/empresa-categoria-json/{empresa_categoria_json}/edit           | empresa-categoria-json.edit         | App\Http\Controllers\EmpresaCategoriaController@edit                   | api          |
|        | POST      | api/empresa-filial-json                                            | empresa-filial-json.store           | App\Http\Controllers\EmpresaFilialController@store                     | api          |
|        | GET|HEAD  | api/empresa-filial-json                                            | empresa-filial-json.index           | App\Http\Controllers\EmpresaFilialController@index                     | api          |
|        | GET|HEAD  | api/empresa-filial-json/create                                     | empresa-filial-json.create          | App\Http\Controllers\EmpresaFilialController@create                    | api          |
|        | DELETE    | api/empresa-filial-json/{empresa_filial_json}                      | empresa-filial-json.destroy         | App\Http\Controllers\EmpresaFilialController@destroy                   | api          |
|        | PUT|PATCH | api/empresa-filial-json/{empresa_filial_json}                      | empresa-filial-json.update          | App\Http\Controllers\EmpresaFilialController@update                    | api          |
|        | GET|HEAD  | api/empresa-filial-json/{empresa_filial_json}                      | empresa-filial-json.show            | App\Http\Controllers\EmpresaFilialController@show                      | api          |
|        | GET|HEAD  | api/empresa-filial-json/{empresa_filial_json}/edit                 | empresa-filial-json.edit            | App\Http\Controllers\EmpresaFilialController@edit                      | api          |
|        | POST      | api/empresa-json                                                   | empresa-json.store                  | App\Http\Controllers\EmpresaController@store                           | api          |
|        | GET|HEAD  | api/empresa-json                                                   | empresa-json.index                  | App\Http\Controllers\EmpresaController@index                           | api          |
|        | GET|HEAD  | api/empresa-json/create                                            | empresa-json.create                 | App\Http\Controllers\EmpresaController@create                          | api          |
|        | PUT|PATCH | api/empresa-json/{empresa_json}                                    | empresa-json.update                 | App\Http\Controllers\EmpresaController@update                          | api          |
|        | GET|HEAD  | api/empresa-json/{empresa_json}                                    | empresa-json.show                   | App\Http\Controllers\EmpresaController@show                            | api          |
|        | DELETE    | api/empresa-json/{empresa_json}                                    | empresa-json.destroy                | App\Http\Controllers\EmpresaController@destroy                         | api          |
|        | GET|HEAD  | api/empresa-json/{empresa_json}/edit                               | empresa-json.edit                   | App\Http\Controllers\EmpresaController@edit                            | api          |
|        | POST      | api/empresa-modelo-docs-json                                       | empresa-modelo-docs-json.store      | App\Http\Controllers\EmpresaModeloDocsController@store                 | api          |
|        | GET|HEAD  | api/empresa-modelo-docs-json                                       | empresa-modelo-docs-json.index      | App\Http\Controllers\EmpresaModeloDocsController@index                 | api          |
|        | GET|HEAD  | api/empresa-modelo-docs-json/create                                | empresa-modelo-docs-json.create     | App\Http\Controllers\EmpresaModeloDocsController@create                | api          |
|        | GET|HEAD  | api/empresa-modelo-docs-json/{empresa_modelo_docs_json}            | empresa-modelo-docs-json.show       | App\Http\Controllers\EmpresaModeloDocsController@show                  | api          |
|        | PUT|PATCH | api/empresa-modelo-docs-json/{empresa_modelo_docs_json}            | empresa-modelo-docs-json.update     | App\Http\Controllers\EmpresaModeloDocsController@update                | api          |
|        | DELETE    | api/empresa-modelo-docs-json/{empresa_modelo_docs_json}            | empresa-modelo-docs-json.destroy    | App\Http\Controllers\EmpresaModeloDocsController@destroy               | api          |
|        | GET|HEAD  | api/empresa-modelo-docs-json/{empresa_modelo_docs_json}/edit       | empresa-modelo-docs-json.edit       | App\Http\Controllers\EmpresaModeloDocsController@edit                  | api          |
|        | GET|HEAD  | api/inativos-categoria-json                                        |                                     | App\Http\Controllers\EmpresaCategoriaController@inativosCategoria      | api          |
|        | GET|HEAD  | api/inativos-emp-model-docs-json                                   |                                     | App\Http\Controllers\EmpresaModeloDocsController@inativosModelEmp      | api          |
|        | GET|HEAD  | api/inativos-empresas-json                                         |                                     | App\Http\Controllers\EmpresaController@inativosEmpresa                 | api          |
|        | GET|HEAD  | api/inativos-filial-json                                           |                                     | App\Http\Controllers\EmpresaFilialController@inativosFilial            | api          |
|        | GET|HEAD  | api/inativos-perfis-json                                           |                                     | App\Http\Controllers\UserPerfilController@inativosPerfil               | api          |
|        | GET|HEAD  | api/inativos-responsavel-json                                      |                                     | App\Http\Controllers\ResponsavelController@inativosResponsavel         | api          |
|        | GET|HEAD  | api/inativos-user-json                                             |                                     | App\Http\Controllers\UserController@inativosUser                       | api          |
|        | GET|HEAD  | api/inativos-user-model-docs-json                                  |                                     | App\Http\Controllers\UserModeloDocsController@inativosModelUser        | api          |
|        | GET|HEAD  | api/perfil-permissao-pivot-json                                    | perfil-permissao-pivot-json.index   | App\Http\Controllers\PerfilPermissaoPivotController@index              | api          |
|        | POST      | api/perfil-permissao-pivot-json                                    | perfil-permissao-pivot-json.store   | App\Http\Controllers\PerfilPermissaoPivotController@store              | api          |
|        | GET|HEAD  | api/perfil-permissao-pivot-json/create                             | perfil-permissao-pivot-json.create  | App\Http\Controllers\PerfilPermissaoPivotController@create             | api          |
|        | DELETE    | api/perfil-permissao-pivot-json/{perfil_permissao_pivot_json}      | perfil-permissao-pivot-json.destroy | App\Http\Controllers\PerfilPermissaoPivotController@destroy            | api          |
|        | PUT|PATCH | api/perfil-permissao-pivot-json/{perfil_permissao_pivot_json}      | perfil-permissao-pivot-json.update  | App\Http\Controllers\PerfilPermissaoPivotController@update             | api          |
|        | GET|HEAD  | api/perfil-permissao-pivot-json/{perfil_permissao_pivot_json}      | perfil-permissao-pivot-json.show    | App\Http\Controllers\PerfilPermissaoPivotController@show               | api          |
|        | GET|HEAD  | api/perfil-permissao-pivot-json/{perfil_permissao_pivot_json}/edit | perfil-permissao-pivot-json.edit    | App\Http\Controllers\PerfilPermissaoPivotController@edit               | api          |
|        | GET|HEAD  | api/remover-perfil-user/{user_json}                                |                                     | App\Http\Controllers\UserController@delPerfilUser                      | api          |
|        | POST      | api/remover-permissoes/{user_perfil_json}                          |                                     | App\Http\Controllers\UserPerfilController@delPermissoes                | api          |
|        | GET|HEAD  | api/responsavel-json                                               | responsavel-json.index              | App\Http\Controllers\ResponsavelController@index                       | api          |
|        | POST      | api/responsavel-json                                               | responsavel-json.store              | App\Http\Controllers\ResponsavelController@store                       | api          |
|        | GET|HEAD  | api/responsavel-json/create                                        | responsavel-json.create             | App\Http\Controllers\ResponsavelController@create                      | api          |
|        | DELETE    | api/responsavel-json/{responsavel_json}                            | responsavel-json.destroy            | App\Http\Controllers\ResponsavelController@destroy                     | api          |
|        | GET|HEAD  | api/responsavel-json/{responsavel_json}                            | responsavel-json.show               | App\Http\Controllers\ResponsavelController@show                        | api          |
|        | PUT|PATCH | api/responsavel-json/{responsavel_json}                            | responsavel-json.update             | App\Http\Controllers\ResponsavelController@update                      | api          |
|        | GET|HEAD  | api/responsavel-json/{responsavel_json}/edit                       | responsavel-json.edit               | App\Http\Controllers\ResponsavelController@edit                        | api          |
|        | POST      | api/setar-perfil-user/{user_json}/{user_perfil_json}               |                                     | App\Http\Controllers\UserController@setPerfilUser                      | api          |
|        | POST      | api/setar-permissoes/{user_perfil_json}                            |                                     | App\Http\Controllers\UserPerfilController@setPermissoes                | api          |
|        | GET|HEAD  | api/user                                                           |                                     | Closure                                                                | api,auth:api |
|        | GET|HEAD  | api/user-json                                                      | user-json.index                     | App\Http\Controllers\UserController@index                              | api          |
|        | POST      | api/user-json                                                      | user-json.store                     | App\Http\Controllers\UserController@store                              | api          |
|        | GET|HEAD  | api/user-json/create                                               | user-json.create                    | App\Http\Controllers\UserController@create                             | api          |
|        | PUT|PATCH | api/user-json/{user_json}                                          | user-json.update                    | App\Http\Controllers\UserController@update                             | api          |
|        | GET|HEAD  | api/user-json/{user_json}                                          | user-json.show                      | App\Http\Controllers\UserController@show                               | api          |
|        | DELETE    | api/user-json/{user_json}                                          | user-json.destroy                   | App\Http\Controllers\UserController@destroy                            | api          |
|        | GET|HEAD  | api/user-json/{user_json}/edit                                     | user-json.edit                      | App\Http\Controllers\UserController@edit                               | api          |
|        | GET|HEAD  | api/user-modelo-docs-json                                          | user-modelo-docs-json.index         | App\Http\Controllers\UserModeloDocsController@index                    | api          |
|        | POST      | api/user-modelo-docs-json                                          | user-modelo-docs-json.store         | App\Http\Controllers\UserModeloDocsController@store                    | api          |
|        | GET|HEAD  | api/user-modelo-docs-json/create                                   | user-modelo-docs-json.create        | App\Http\Controllers\UserModeloDocsController@create                   | api          |
|        | PUT|PATCH | api/user-modelo-docs-json/{user_modelo_docs_json}                  | user-modelo-docs-json.update        | App\Http\Controllers\UserModeloDocsController@update                   | api          |
|        | DELETE    | api/user-modelo-docs-json/{user_modelo_docs_json}                  | user-modelo-docs-json.destroy       | App\Http\Controllers\UserModeloDocsController@destroy                  | api          |
|        | GET|HEAD  | api/user-modelo-docs-json/{user_modelo_docs_json}                  | user-modelo-docs-json.show          | App\Http\Controllers\UserModeloDocsController@show                     | api          |
|        | GET|HEAD  | api/user-modelo-docs-json/{user_modelo_docs_json}/edit             | user-modelo-docs-json.edit          | App\Http\Controllers\UserModeloDocsController@edit                     | api          |
|        | GET|HEAD  | api/user-perfil-json                                               | user-perfil-json.index              | App\Http\Controllers\UserPerfilController@index                        | api          |
|        | POST      | api/user-perfil-json                                               | user-perfil-json.store              | App\Http\Controllers\UserPerfilController@store                        | api          |
|        | GET|HEAD  | api/user-perfil-json/create                                        | user-perfil-json.create             | App\Http\Controllers\UserPerfilController@create                       | api          |
|        | GET|HEAD  | api/user-perfil-json/{user_perfil_json}                            | user-perfil-json.show               | App\Http\Controllers\UserPerfilController@show                         | api          |
|        | PUT|PATCH | api/user-perfil-json/{user_perfil_json}                            | user-perfil-json.update             | App\Http\Controllers\UserPerfilController@update                       | api          |
|        | DELETE    | api/user-perfil-json/{user_perfil_json}                            | user-perfil-json.destroy            | App\Http\Controllers\UserPerfilController@destroy                      | api          |
|        | GET|HEAD  | api/user-perfil-json/{user_perfil_json}/edit                       | user-perfil-json.edit               | App\Http\Controllers\UserPerfilController@edit                         | api          |
|        | POST      | api/user-perfil-pivot-json                                         | user-perfil-pivot-json.store        | App\Http\Controllers\UserPerfilPivotController@store                   | api          |
|        | GET|HEAD  | api/user-perfil-pivot-json                                         | user-perfil-pivot-json.index        | App\Http\Controllers\UserPerfilPivotController@index                   | api          |
|        | GET|HEAD  | api/user-perfil-pivot-json/create                                  | user-perfil-pivot-json.create       | App\Http\Controllers\UserPerfilPivotController@create                  | api          |
|        | PUT|PATCH | api/user-perfil-pivot-json/{user_perfil_pivot_json}                | user-perfil-pivot-json.update       | App\Http\Controllers\UserPerfilPivotController@update                  | api          |
|        | DELETE    | api/user-perfil-pivot-json/{user_perfil_pivot_json}                | user-perfil-pivot-json.destroy      | App\Http\Controllers\UserPerfilPivotController@destroy                 | api          |
|        | GET|HEAD  | api/user-perfil-pivot-json/{user_perfil_pivot_json}                | user-perfil-pivot-json.show         | App\Http\Controllers\UserPerfilPivotController@show                    | api          |
|        | GET|HEAD  | api/user-perfil-pivot-json/{user_perfil_pivot_json}/edit           | user-perfil-pivot-json.edit         | App\Http\Controllers\UserPerfilPivotController@edit                    | api          |
|        | POST      | api/verificar-email                                                |                                     | App\Http\Controllers\UserController@verificarEmail                     | api          |
|        | GET|HEAD  | home                                                               | home                                | App\Http\Controllers\HomeController@index                              | web,auth     |
|        | GET|HEAD  | login                                                              | login                               | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest    |
|        | POST      | login                                                              |                                     | App\Http\Controllers\Auth\LoginController@login                        | web,guest    |
|        | POST      | logout                                                             | logout                              | App\Http\Controllers\Auth\LoginController@logout                       | web          |
|        | POST      | password/email                                                     | password.email                      | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web,guest    |
|        | GET|HEAD  | password/reset                                                     | password.request                    | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web,guest    |
|        | POST      | password/reset                                                     |                                     | App\Http\Controllers\Auth\ResetPasswordController@reset                | web,guest    |
|        | GET|HEAD  | password/reset/{token}                                             | password.reset                      | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web,guest    |
|        | GET|HEAD  | register                                                           | register                            | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest    |
|        | POST      | register                                                           |                                     | App\Http\Controllers\Auth\RegisterController@register                  | web,guest    |
+--------+-----------+--------------------------------------------------------------------+-------------------------------------+------------------------------------------------------------------------+--------------+

 */
