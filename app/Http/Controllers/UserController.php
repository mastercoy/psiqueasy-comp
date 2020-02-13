<?php

namespace App\Http\Controllers;

use App\Models\UserPerfil;
use App\Models\UserPerfilPivot;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class UserController extends Controller {

    public function setPerfilUser(User $user_json, UserPerfil $user_perfil_json) {
        //obs set_perfil
        //vincula um perfil a um usuário
        $conditions      = ['user_id' => $user_json->id, 'perfil_id' => $user_perfil_json->id];
        $userPerfilPivot = UserPerfilPivot::where($conditions)->first();

        if (isset($userPerfilPivot)) {
            return 'Perfil "' . $user_perfil_json->name . '" já se encontra vinculado ao usuário "' . $user_json->name . '"';
        } else {
            $user = User::find($user_json->id);
            $user->perfil()->attach($user_perfil_json);
            return 'Perfil "' . $user_perfil_json->name . '" vinculado com sucesso ao usuário "' . $user_json->name . '"';
        }

    }

    public function delPerfilUser(User $user_json) {
        //obs del_perfil
        //desvincula perfil do usuário
        $user = User::find($user_json->id);
        if (!$user->perfil()->get()->toArray()) {
            return 'Usuário ' . $user->name . ' já se encontra sem Perfil/Permissões';
        } else {
            $user->perfil()->detach();
            return 'Usuário ' . $user->name . ' agora está sem Perfil/Permissões';
        }

    }

    public function index() {
        //obs index_user

        $users      = User::all();
        $listaUsers = [];

        foreach ($users as $user) {
            $listaUsers[] = $user; //fixme devolver pro gate
            if (Gate::allows('pertence-mesma-empresa', $user)) {
            }
        }
        return Response::json($listaUsers);
    }

    public function store() {
        //obs criar_user
        $user_json = User::create($this->validateUserRequest());
    }

    public function show(User $user_json) {
        //obs show_user
        Auth::loginUsingId(1); //fixme retirar // para passar do guard, user logado

        $nomePermissao   = 'show_user';
        $user            = User::find($user_json->id);
        $arrayPermissoes = $this->retornaPermissoes($user); //método retorna um array com as permissões do usuário

        // joga tudo em um array, converte pra json e envia no guard
        $arrayCompleto = [$nomePermissao, $user, $arrayPermissoes];
        $jsonEncoder   = json_encode($arrayCompleto); //precisa transformar em json pois o guard nao aceita array

        //o guard transforma json pra array, pega as informações em cada posição [0],[1] etc, e faz as comparações
        //retorna true ou false
        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            dd('sucesso');
        } else {
            dd('falhou');
        }

    }

    public function edit(User $user) {
        //
    }

    public function update(User $user_json) {
        //obs update_user
        if (Gate::allows('pertence-mesma-empresa', $user_json)) {
            $user_json->update($this->validateUserRequest());
        } else {
            abort(403, 'Não encontrado!');
        }
    }

    public function destroy(User $user_json) {
        //obs destroy_user
        if (Gate::allows('pertence-mesma-empresa', $user_json)) {
            $user_json->delete();
        } else {
            abort(403, 'Não encontrado!');
        }
    }

    public function desativarUser(User $user_json) {
        //obs desativar_user
        $user = User::find($user_json->id);

        if (Gate::allows('pertence-mesma-empresa', $user_json)) {
            $user->active = false;
            $user->save();
        } else {
            abort(403, 'Não encontrado!');
        }

    }


    // ========================= protected

    protected function retornaPermissoes(User $user_json) {

        $listaPermissoesUser = [];

        if (isset(User::where('id', $user_json->id)->with('perfil.permissao')->first()->toArray()['perfil'][0]['permissao'])) {
            $permissoes = User::where('id', $user_json->id)->with('perfil.permissao')->first()->toArray()['perfil'][0]['permissao'];

            foreach ($permissoes as $permissao) {
                $listaPermissoesUser[] = $permissao['name'];
            }

        } else {
            return $listaPermissoesUser;
        }

        return $listaPermissoesUser;
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
