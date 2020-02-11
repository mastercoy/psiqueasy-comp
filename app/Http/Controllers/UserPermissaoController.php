<?php

namespace App\Http\Controllers;

use App\Models\UserPermissao;
use Illuminate\Support\Facades\Response;

class UserPermissaoController extends Controller { //afazer como verificar? não tem chave estrangeira

    public function index() {
        //obs index_permissao
        $permissao = UserPermissao::all();
        return Response::json($permissao);
    }

    public function create() {
        //
    }

    public function store() {
        //obs criar__permissao
        $permissao = UserPermissao::create($this->validatePermissaoRequest());
    }

    public function show(UserPermissao $user_permissao_json) {
        //obs show_permissao
        return $perfil = UserPermissao::find($user_permissao_json->id);
    }

    public function edit(UserPermissao $user_permissao_json) {
        //
    }

    public function update(UserPermissao $user_permissao_json) {
        //obs update_permissao
        $user_permissao_json->update($this->validatePermissaoRequest());

    }

    public function destroy(UserPermissao $user_permissao_json) {
        //obs destroy_permissao
        $user_permissao_json->delete();
    }

    public function desativarPermissao(UserPermissao $user_permissao_json) {
        //obs desativar_permissao
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
