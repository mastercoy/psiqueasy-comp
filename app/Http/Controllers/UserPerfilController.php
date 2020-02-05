<?php

namespace App\Http\Controllers;

use App\Models\UserPerfil;
use Illuminate\Support\Facades\Response;

class UserPerfilController extends Controller {

    public function index() {
        //
        $perfil = UserPerfil::all();
        return Response::json($perfil);
    }

    public function create() {
        //
    }

    public function store() {
        //
        $perfil = UserPerfil::create($this->validateUserPerfilRequest());
    }

    public function show(UserPerfil $user_perfil_json) {
        //fixme usar novo GATE
        $perfil = UserPerfil::find($user_perfil_json->id);
        return Response::json($perfil);

    }

    public function edit(UserPerfil $user_perfil_json) {
        //
    }

    public function update(UserPerfil $user_perfil_json) {
        //
        $user_perfil_json->update($this->validateUserPerfilRequest());

    }

    public function destroy(UserPerfil $user_perfil_json) {
        //
        $user_perfil_json->delete();

    }

    public function desativarUserPerfil(UserPerfil $user_perfil_json) {
        //
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
                                   ]);


    }
}
