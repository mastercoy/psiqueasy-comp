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
Route::post('associar-user-empresa', 'UserController@associarUserAntigoEmpresa')->name('associar_user');

// rotas para USER PERFIL
Route::resource('user-perfil-json', 'UserPerfilController');
Route::patch('desativar-user-perfil-json/{user_perfil_json}', 'UserPerfilController@desativarUserPerfil');
Route::get('inativos-perfis-json', 'UserPerfilController@inativosPerfil');
Route::get('permissoes-perfil-json/{user_perfil_json}', 'UserPerfilController@quaisPermissoes');
Route::patch('sync-permissoes-perfil/{user_perfil_json}', 'UserPerfilController@syncPermissoes');

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
Route::post('enviar-convite', 'ConviteController@enviarConvite');
Route::get('completar-cadastro', 'ConviteController@completarCadastro')->name('completar');
Route::get('associar-cadastro', 'ConviteController@associarCadastro')->name('associar');
Route::post('aceitar-convite', 'ConviteController@aceitar')->name('aceitar');
