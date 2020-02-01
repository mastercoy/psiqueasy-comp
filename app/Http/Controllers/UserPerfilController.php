<?php

namespace App\Http\Controllers;

use App\Models\UserPerfil;
use Illuminate\Support\Facades\Gate;

class UserPerfilController extends Controller {

    public function index() {
        //
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
        return $perfil = UserPerfil::find($user_perfil_json->id);
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
        $user_perfil_json->delete();
    }

    public function desativarUserPerfil(UserPerfil $user_perfil_json) {
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
                                       'user_id' => 'nullable'
                                   ]);


    }
}
