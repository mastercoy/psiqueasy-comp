<?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller {

//fixme transferir pro próprio controller
    /*public function __construct() {
        //afazer middleware
        $this->middleware();
    }*/

    public function index() {
        //afazer retornar todos os usuarios
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

    // ========================= protected

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
