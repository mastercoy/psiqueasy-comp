<?php

namespace App\Http\Controllers;

use App\Models\UserModeloDocs;
use App\Models\UserPerfil;
use App\Models\UserPermissao;
use App\User;
use Illuminate\Support\Facades\Gate;

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
    //fixme transferir pro próprio controller
    /*public function __construct() {
        //afazer middleware
        $this->middleware();
    }*/

    public function criarUserPerfil() {
        $perfil = UserPerfil::create($this->validateUserPerfilRequest());
    }

    public function showUserPerfil(UserPerfil $user_perfil_json) {
        return $perfil = UserPerfil::find($user_perfil_json->id);
    }

    public function updateUserPerfil(UserPerfil $user_perfil_json) {

        $perfil = UserPerfil::find($user_perfil_json->id);

        if (Gate::allows('pertence-usuario-logado', $perfil)) {
            $user_perfil_json->update($this->validateUserPerfilRequest());
        } else {
            abort(403, 'Não encontrado!');
        }


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

    public function updatePermissao(UserPermissao $user_permissao_json) {
        $user_permissao_json->update($this->validatePermissaoRequest());
    }

    public function destruirPermissao(UserPermissao $user_permissao_json) {
        $user_permissao_json->delete();
    }

    public function desativarPermissao(UserPermissao $user_permissao_json) {
        $perfil         = UserPermissao::find($user_permissao_json->id);
        $perfil->active = false;
        $perfil->save();
    }

    // ========================= MODELO DOCS

    public function showModeloDocs(UserModeloDocs $user_modelo_json) {
        return $modelo = UserModeloDocs::find($user_modelo_json->id);
    }

    public function criarModeloDocs() {
        $modelo = UserModeloDocs::create($this->validateModeloDocsRequest());
    }

    public function updateModeloDocs(UserModeloDocs $user_modelo_json) {
        $user_modelo_json->update($this->validateModeloDocsRequest());

    }

    public function destruirModeloDocs(UserModeloDocs $user_modelo_json) {
        $user_modelo_json->delete();
    }

    public function desativarModeloDocs(UserModeloDocs $user_modelo_json) {
        $modelo         = UserModeloDocs::find($user_modelo_json->id);
        $modelo->active = false;
        $modelo->save();
    }

    // ========================= protected

    protected function validateModeloDocsRequest() {
        return request()->validate([
                                       'name' => 'required',
                                       'conteudo' => 'nullable',
                                       'active' => 'nullable',
                                       'user_id' => 'nullable'
                                   ]);
    }

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
                                       'active' => 'nullable',
                                       'user_id' => 'nullable'
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
