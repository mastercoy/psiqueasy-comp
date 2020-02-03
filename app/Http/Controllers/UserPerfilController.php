<?php

namespace App\Http\Controllers;

use App\Models\UserPerfil;
use Illuminate\Support\Facades\Gate;

class UserPerfilController extends Controller {

    public function index() {
        //afazer retornar todos?
    }

    public function create() {
        //
    }

    public function store() {
        //
        $perfil = UserPerfil::create($this->validateUserPerfilRequest());
    }

    public function show(UserPerfil $user_perfil_json) {
        //
        $perfil = UserPerfil::find($user_perfil_json->id);

        if (Gate::allows('pertence-usuario-logado', $perfil)) {
            return $perfil;
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    public function edit(UserPerfil $user_perfil_json) {
        //
    }

    public function update(UserPerfil $user_perfil_json) {
        //
        $perfil = UserPerfil::find($user_perfil_json->id);

        if (Gate::allows('pertence-usuario-logado', $perfil)) {
            $user_perfil_json->update($this->validateUserPerfilRequest());
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    public function destroy(UserPerfil $user_perfil_json) {
        //
        $perfil = UserPerfil::find($user_perfil_json->id);

        if (Gate::allows('pertence-usuario-logado', $perfil)) {
            $perfil->delete();
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    public function desativarUserPerfil(UserPerfil $user_perfil_json) {
        //
        $perfil = UserPerfil::find($user_perfil_json->id);

        if (Gate::allows('pertence-usuario-logado', $perfil)) {
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
                                       'user_id' => 'nullable'
                                   ]);


    }
}
