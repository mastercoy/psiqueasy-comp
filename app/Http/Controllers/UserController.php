<?php

namespace App\Http\Controllers;

use App\Models\UserPerfil;
use App\Models\UserPerfilPivot;
use App\User;
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

    public function create() {
        //
    }

    public function store() {
        //obs criar_user
        $user_json = User::create($this->validateUserRequest());
    }

    public function show(User $user_json) { // retorna usuário e um array de permissões, pode ser vazio caso nao as tenha
        //obs show_user
        $nomePermissao = 'show_user';
        $user          = User::find($user_json->id);
//        dd($user); //Ok
        $arrayPermissoes = $this->retornaPermissoes($user);
        $this->be($user);
        if (Gate::allows('pertence-usuario-e-tem-permissao', $arrayPermissoes, $nomePermissao)) {
            dd('sucesso');
        } else {
            dd('falhou');
        }
//        dd($permissões);

//        dd($permissões);
        /*$listaPermissoesUser = [];

        if (isset(User::where('id', $user_json->id)->with('perfil.permissao')->first()->toArray()['perfil'][0]['permissao'])) {
            $user = User::where('id', $user_json->id)->with('perfil.permissao')->first()->toArray()['perfil'][0]['permissao'];
            foreach ($user as $permissoes) {
                $listaPermissoesUser[] = $permissoes['name'];
            }
        }
        $usuarioAndPermissoes[] = User::find($user_json->id)->toArray();
        $usuarioAndPermissoes[] = $listaPermissoesUser;
        return $usuarioAndPermissoes;*/
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
//        dd($user_json); Ok
        $listaPermissoesUser = [];
        if (isset(User::where('id', $user_json->id)->with('perfil.permissao')->first()->toArray()['perfil'][0]['permissao'])) {
            $permissoes = User::where('id', $user_json->id)->with('perfil.permissao')->first()->toArray()['perfil'][0]['permissao'];
//            dd($permissoes); //Ok
            foreach ($permissoes as $permissao) {
                $listaPermissoesUser[] = $permissao['name'];
            }
//            dd($listaPermissoesUser); //Ok
        } else {
            return $listaPermissoesUser;

        }
        return $listaPermissoesUser;
//        dd('hit'); //Ok
        /*$usuarioAndPermissoes[] = User::find($user_json->id)->toArray();
        $usuarioAndPermissoes[] = $listaPermissoesUser;
        return $usuarioAndPermissoes;*/
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
