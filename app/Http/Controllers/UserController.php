<?php

namespace App\Http\Controllers;

use App\Models\UserPerfil;
use App\Models\UserPermissao;
use App\User;

class UserController extends Controller {

    // ========================= USER

    public function index() {
        //
    }

    public function create() {
        //
    }

    public function store() {
        $user_json = User::create($this->validateUserRequest());
    }

    public function show(User $user_json) {
        return $user = User::find($user_json->id);
    }

    public function edit(User $user) {
        //
    }

    public function update(User $user_json) {
        $user_json->update($this->validateUserRequest());
    }

    public function destroy(User $user_json) {
        $user_json->delete();
    }

    public function desativarUser(User $user_json) {
        $user         = User::find($user_json->id);
        $user->active = false;
        $user->save();
    }

    // ========================= PERFIL

    public function criarUserPerfil() {
        $perfil = UserPerfil::create($this->validateUserPerfilRequest());
    }

    public function showUserPerfil(UserPerfil $user_perfil_json) {
        return $perfil = UserPerfil::find($user_perfil_json->id);
    }

    public function updateUserPerfil(UserPerfil $user_perfil_json) {
        $user_perfil_json->update($this->validateUserPerfilRequest());
    }

    public function destruirUserPerfil(UserPerfil $user_perfil_json) {
        $user_perfil_json->delete();
    }

    public function desativarUserPerfil(UserPerfil $user_perfil_json) {
        $perfil         = UserPerfil::find($user_perfil_json->id);
        $perfil->active = false;
        $perfil->save();
    }

    // ========================= PERMISSÕES

    public function criarPermissao() {
        $permissao = UserPermissao::create($this->validatePermissaoRequest());
    }

    public function showPermissao(UserPermissao $user_permissao_json) {
        return $perfil = UserPermissao::find($user_permissao_json->id);
    }

    public function updatePermissao(UserPerfil $user_perfil_json) {
        $user_perfil_json->update($this->validatePermissaoRequest());
    }

    public function destruirPermissao(UserPerfil $user_perfil_json) {

    }


    public function desativarPermissao(UserPerfil $user_perfil_json) {

    }


    // ========================= protected

    protected function validatePermissaoRequest() {
        return request()->validate([
                                       'name' => 'required',
                                       'label' => 'nullable',
                                       'active' => 'nullable'
                                   ]);
    }

    protected function validateUserPerfilRequest() {
        return request()->validate([
                                       'name' => 'required',
                                       'label' => 'nullable',
                                       'active' => 'nullable'
                                   ]);


    }

    protected function validateUserRequest() {
        return request()->validate([
                                       'name' => 'required',
                                       'foto' => 'nullable',
                                       'email' => 'required',
                                       'password' => 'required',
                                       'data_nasc' => 'nullable',
                                       'formacao' => 'nullable',
                                       'profissao' => 'nullable',
                                       'telefones' => 'nullable',
                                       'model_doc_top' => 'nullable',
                                       'model_doc_rodape' => 'nullable',
                                       'contrato' => 'nullable',
                                       'comprovante' => 'nullable',
                                       'venc_plano' => 'nullable',
                                       'plano_id' => 'nullable',
                                       'plano_solicitado_id' => 'nullable',
                                       'data_solicitacao_plano' => 'nullable',
                                       'debito_automatico' => 'nullable',
                                       'tipo_user' => 'nullable',
                                       'quant_acesso' => 'nullable',
                                       'ultimo_acesso' => 'nullable',
                                       'config' => 'nullable',
                                       'cpf' => 'nullable',
                                       'endereco' => 'nullable',
                                       'cartao' => 'nullable',
                                       'empresa_id' => 'nullable',

                                   ]);
    }
}
