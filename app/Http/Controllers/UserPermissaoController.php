<?php

namespace App\Http\Controllers;

use App\Models\UserPermissao;
use Illuminate\Support\Facades\Response;

class UserPermissaoController extends Controller {

    public function index() {
        //
        $permissao = UserPermissao::all();
        return Response::json($permissao);
    }


    public function create() {
        //
    }

    public function store() {
        $permissao = UserPermissao::create($this->validatePermissaoRequest());
    }


    public function show(UserPermissao $user_permissao_json) {
        return $perfil = UserPermissao::find($user_permissao_json->id);
    }

    public function edit(UserPermissao $user_permissao_json) {
        //
    }

    public function update(UserPermissao $user_permissao_json) {
        $user_permissao_json->update($this->validatePermissaoRequest());
    }

    public function destroy(UserPermissao $user_permissao_json) {
        $user_permissao_json->delete();
    }

    public function desativarPermissao(UserPermissao $user_permissao_json) {
        $perfil         = UserPermissao::find($user_permissao_json->id);
        $perfil->active = false;
        $perfil->save();
    }

    // ========================= protected

    protected function validatePermissaoRequest() {
        return request()->validate([
                                       'name' => 'required',
                                       'label' => 'nullable',
                                       'active' => 'nullable'
                                   ]);
    }

}
