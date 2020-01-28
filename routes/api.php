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

/*
+--------+-----------+----------------------------------------------+--------------------------+----------------------------------------------------+--------------+
| Domain | Method    | URI                                          | Name                     | Action                                             | Middleware   |
  +--------+-----------+----------------------------------------------+--------------------------+----------------------------------------------------+--------------+
|        | GET|HEAD  | /                                            |                          | Closure                                            | web          |
|        | GET|HEAD  | api/responsavel-json                         | responsavel-json.index   | App\Http\Controllers\ResponsavelController@index   | api          |
|        | POST      | api/responsavel-json                         | responsavel-json.store   | App\Http\Controllers\ResponsavelController@store   | api          |
|        | GET|HEAD  | api/responsavel-json/create                  | responsavel-json.create  | App\Http\Controllers\ResponsavelController@create  | api          |
|        | GET|HEAD  | api/responsavel-json/{responsavel_json}      | responsavel-json.show    | App\Http\Controllers\ResponsavelController@show    | api          |
|        | PUT|PATCH | api/responsavel-json/{responsavel_json}      | responsavel-json.update  | App\Http\Controllers\ResponsavelController@update  | api          |
|        | DELETE    | api/responsavel-json/{responsavel_json}      | responsavel-json.destroy | App\Http\Controllers\ResponsavelController@destroy | api          |
|        | GET|HEAD  | api/responsavel-json/{responsavel_json}/edit | responsavel-json.edit    | App\Http\Controllers\ResponsavelController@edit    | api          |
|        | GET|HEAD  | api/user                                     |                          | Closure                                            | api,auth:api |
                                                                                                                                                               +--------+-----------+----------------------------------------------+--------------------------+----------------------------------------------------+--------------+*/
