<?php

namespace App\Http\Controllers;

use App\Models\PerfilPermissaoPivot;
use App\Models\UserPerfil;
use App\Models\UserPermissao;
use Illuminate\Support\Facades\Response;

class UserPerfilController extends Controller { //afazer como verificar os perfis? não tem chave para comparação

    public function index() {// exibir os perfis //afazer utilizar o guard
        //obs index_perfil
        $perfil = UserPerfil::all();
        return Response::json($perfil);
    }

    public function setPermissaoPerfil(UserPerfil $user_perfil_json, UserPermissao $user_permissao_json) {
        //obs set_permissao
        //vincula permissão ao perfil
        $conditions           = ['perfil_id' => $user_perfil_json->id, 'permissao_id' => $user_permissao_json->id];
        $perfilPermissaoPivot = PerfilPermissaoPivot::where($conditions)->first();

        if (isset($perfilPermissaoPivot)) {
            return 'Permissão "' . $user_permissao_json->name . '" já se encontra vinculada ao Perfil "' . $user_perfil_json->name . '"';
        } else {
            $perfil = UserPerfil::find($user_perfil_json->id);
            $perfil->permissao()->attach($user_permissao_json);
            return 'Permissão "' . $user_permissao_json->name . '" vinculada com sucesso ao Perfil "' . $user_perfil_json->name . '"';
        }
    }

    public function delPermissaoPerfil(UserPerfil $user_perfil_json, UserPermissao $user_permissao_json) {
        //obs del_permissao
        //remove a permissão do perfil
        $conditions           = ['perfil_id' => $user_perfil_json->id, 'permissao_id' => $user_permissao_json->id];
        $perfilPermissaoPivot = PerfilPermissaoPivot::where($conditions)->first();

        if (isset($perfilPermissaoPivot)) {
            $perfil = UserPerfil::find($user_perfil_json->id);
            $perfil->permissao()->detach($user_permissao_json);
            return 'Permissão "' . $user_permissao_json->name . '" desvinculada com sucesso do Perfil "' . $user_perfil_json->name . '"';
        } else {
            return 'Permissão "' . $user_permissao_json->name . '" não tem vínculo com o Perfil "' . $user_perfil_json->name . '"';
        }
    }

    public function create() {
        //
    }

    public function store() {
        //obs criar_perfil
        $perfil = UserPerfil::create($this->validateUserPerfilRequest());
    }

    public function show(UserPerfil $user_perfil_json) {
        //obs show_perfil
        $perfil = UserPerfil::find($user_perfil_json->id);
        return Response::json($perfil);

    }

    public function edit(UserPerfil $user_perfil_json) {
        //
    }

    public function update(UserPerfil $user_perfil_json) {
        //obs update_perfil
        $user_perfil_json->update($this->validateUserPerfilRequest());

    }

    public function destroy(UserPerfil $user_perfil_json) {
        //obs destroy_perfil
        $user_perfil_json->delete();

    }

    public function desativarUserPerfil(UserPerfil $user_perfil_json) {
        //obs desativar_perfil
        $perfil         = UserPerfil::find($user_perfil_json->id);
        $perfil->active = false;
        $perfil->save();


    }

    // ========================= protected

    protected function validateUserPerfilRequest() {
        return request()->validate([
                                       'name' => 'required',
                                       'label' => 'nullable',
                                       'active' => 'nullable',
                                       'user_id' => 'nullable',
                                       'empresa_id' => 'nullable'
                                   ]);


    }
}
