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

Route::resource('responsavel-json', 'ResponsavelController');
Route::resource('user-json', 'UserController');
Route::resource('paciente-json', 'PacienteController');
Route::resource('empresa-json', 'EmpresaController');

/// rotas para FILIAL
Route::post('criar-filial-json', 'EmpresaController@criarFilial');
Route::patch('editar-filial-json/{empresa_filial_json}', 'EmpresaController@updateFilial');
Route::delete('destruir-filial-json/{empresa_filial_json}', 'EmpresaController@destruirFilial');
Route::patch('desativar-filial-json/{empresa_filial_json}', 'EmpresaController@desativarFilial');
Route::get('show-filial-json/{empresa_filial_json}', 'EmpresaController@showFilial');


/*
 +--------+-----------+-------------------------------------------------+--------------------------+--------------------------------------------------------+--------------+
| Domain | Method    | URI                                             | Name                     | Action                                                 | Middleware   |
+--------+-----------+-------------------------------------------------+--------------------------+--------------------------------------------------------+--------------+
|        | GET|HEAD  | /                                               |                          | Closure                                                | web          |
|        | POST      | api/criar-filial-json                           |                          | App\Http\Controllers\EmpresaController@criarFilial     | api          |
|        | PATCH     | api/desativar-filial-json/{empresa_filial_json} |                          | App\Http\Controllers\EmpresaController@desativarFilial | api          |
|        | DELETE    | api/destruir-filial-json/{empresa_filial_json}  |                          | App\Http\Controllers\EmpresaController@destruirFilial  | api          |
|        | PATCH     | api/editar-filial-json/{empresa_filial_json}    |                          | App\Http\Controllers\EmpresaController@updateFilial    | api          |
|        | POST      | api/empresa-json                                | empresa-json.store       | App\Http\Controllers\EmpresaController@store           | api          |
|        | GET|HEAD  | api/empresa-json                                | empresa-json.index       | App\Http\Controllers\EmpresaController@index           | api          |
|        | GET|HEAD  | api/empresa-json/create                         | empresa-json.create      | App\Http\Controllers\EmpresaController@create          | api          |
|        | DELETE    | api/empresa-json/{empresa_json}                 | empresa-json.destroy     | App\Http\Controllers\EmpresaController@destroy         | api          |
|        | PUT|PATCH | api/empresa-json/{empresa_json}                 | empresa-json.update      | App\Http\Controllers\EmpresaController@update          | api          |
|        | GET|HEAD  | api/empresa-json/{empresa_json}                 | empresa-json.show        | App\Http\Controllers\EmpresaController@show            | api          |
|        | GET|HEAD  | api/empresa-json/{empresa_json}/edit            | empresa-json.edit        | App\Http\Controllers\EmpresaController@edit            | api          |
|        | GET|HEAD  | api/paciente-json                               | paciente-json.index      | App\Http\Controllers\PacienteController@index          | api          |
|        | POST      | api/paciente-json                               | paciente-json.store      | App\Http\Controllers\PacienteController@store          | api          |
|        | GET|HEAD  | api/paciente-json/create                        | paciente-json.create     | App\Http\Controllers\PacienteController@create         | api          |
|        | GET|HEAD  | api/paciente-json/{paciente_json}               | paciente-json.show       | App\Http\Controllers\PacienteController@show           | api          |
|        | PUT|PATCH | api/paciente-json/{paciente_json}               | paciente-json.update     | App\Http\Controllers\PacienteController@update         | api          |
|        | DELETE    | api/paciente-json/{paciente_json}               | paciente-json.destroy    | App\Http\Controllers\PacienteController@destroy        | api          |
|        | GET|HEAD  | api/paciente-json/{paciente_json}/edit          | paciente-json.edit       | App\Http\Controllers\PacienteController@edit           | api          |
|        | GET|HEAD  | api/responsavel-json                            | responsavel-json.index   | App\Http\Controllers\ResponsavelController@index       | api          |
|        | POST      | api/responsavel-json                            | responsavel-json.store   | App\Http\Controllers\ResponsavelController@store       | api          |
|        | GET|HEAD  | api/responsavel-json/create                     | responsavel-json.create  | App\Http\Controllers\ResponsavelController@create      | api          |
|        | PUT|PATCH | api/responsavel-json/{responsavel_json}         | responsavel-json.update  | App\Http\Controllers\ResponsavelController@update      | api          |
|        | GET|HEAD  | api/responsavel-json/{responsavel_json}         | responsavel-json.show    | App\Http\Controllers\ResponsavelController@show        | api          |
|        | DELETE    | api/responsavel-json/{responsavel_json}         | responsavel-json.destroy | App\Http\Controllers\ResponsavelController@destroy     | api          |
|        | GET|HEAD  | api/responsavel-json/{responsavel_json}/edit    | responsavel-json.edit    | App\Http\Controllers\ResponsavelController@edit        | api          |
|        | GET|HEAD  | api/show-filial-json/{empresa_filial_json}      |                          | App\Http\Controllers\EmpresaController@showFilial      | api          |
|        | GET|HEAD  | api/user                                        |                          | Closure                                                | api,auth:api |
|        | POST      | api/user-json                                   | user-json.store          | App\Http\Controllers\UserController@store              | api          |
|        | GET|HEAD  | api/user-json                                   | user-json.index          | App\Http\Controllers\UserController@index              | api          |
|        | GET|HEAD  | api/user-json/create                            | user-json.create         | App\Http\Controllers\UserController@create             | api          |
|        | PUT|PATCH | api/user-json/{user_json}                       | user-json.update         | App\Http\Controllers\UserController@update             | api          |
|        | GET|HEAD  | api/user-json/{user_json}                       | user-json.show           | App\Http\Controllers\UserController@show               | api          |
|        | DELETE    | api/user-json/{user_json}                       | user-json.destroy        | App\Http\Controllers\UserController@destroy            | api          |
|        | GET|HEAD  | api/user-json/{user_json}/edit                  | user-json.edit           | App\Http\Controllers\UserController@edit               | api          |
+--------+-----------+-------------------------------------------------+--------------------------+--------------------------------------------------------+--------------+
*/
