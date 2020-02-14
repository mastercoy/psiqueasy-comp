<?php

namespace App\Http\Controllers;

use App\Models\PerfilPermissaoPivot;
use App\Models\UserPerfil;
use App\Models\UserPermissao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class UserPerfilController extends Controller {

    public function index() {
        //obs index_perfil
        Auth::loginUsingId(1);
        $perfis      = UserPerfil::all();
        $listaPerfis = [];

        foreach ($perfis as $perfil) {
            if (Gate::allows('pertence-mesma-empresa', $perfil)) {
                $listaPerfis[] = $perfil; //fixme devolver pro gate
            }
        }
        return Response::json($listaPerfis);
    }

    public function setPermissaoPerfil(UserPerfil $user_perfil_json, UserPermissao $user_permissao_json) {
        //obs set_permissao
        //vincula permissão ao perfil
        //afazer foreach aqui
        $conditions           = ['perfil_id' => $user_perfil_json->id, 'permissao_id' => $user_permissao_json->id];
        $perfilPermissaoPivot = PerfilPermissaoPivot::where($conditions)->first();

        if (!isset($perfilPermissaoPivot)) {
            $perfil = UserPerfil::find($user_perfil_json->id);
            $perfil->permissao()->attach($user_permissao_json);
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
        if (Gate::allows('pertence-mesma-empresa', $perfil)) {
            return $perfil;
        } else {
            abort(403, 'Não encontrado!');
        }


    }

    public function edit(UserPerfil $user_perfil_json) {
        //
    }

    public function update(UserPerfil $user_perfil_json) {
        //obs update_perfil
        $perfil = UserPerfil::find($user_perfil_json->id);
        if (Gate::allows('pertence-mesma-empresa', $perfil)) {
            $user_perfil_json->update($this->validateUserPerfilRequest());
        } else {
            abort(403, 'Não encontrado!');
        }
    }

    public function destroy(UserPerfil $user_perfil_json) {
        //obs destroy_perfil
        $perfil = UserPerfil::find($user_perfil_json->id);
        if (Gate::allows('pertence-mesma-empresa', $perfil)) {
            $user_perfil_json->delete();
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    public function desativarUserPerfil(UserPerfil $user_perfil_json) {
        //obs desativar_perfil
        $perfil = UserPerfil::find($user_perfil_json->id);
        if (Gate::allows('pertence-mesma-empresa', $perfil)) {
            $perfil->active = false;
            $perfil->save();
        } else {
            abort(403, 'Não encontrado!');
        }
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
