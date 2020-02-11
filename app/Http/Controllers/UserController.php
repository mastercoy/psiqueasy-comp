<?php

namespace App\Http\Controllers;

use App\Models\PerfilPermissaoPivot;
use App\Models\UserPerfil;
use App\Models\UserPerfilPivot;
use App\Models\UserPermissao;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class UserController extends Controller {

    public function setPerfilUser(User $user_json, UserPerfil $user_perfil_json) {
        //vincula um perfil a um usuário
        $conditions      = ['user_id' => $user_json->id, 'userperfil_id' => $user_perfil_json->id];
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
        //desvincula perfil do usuário
        $user = User::find($user_json->id);
        if (!$user->perfil()->get()->toArray()) {
            return 'Usuário ' . $user->name . ' já se encontra sem Perfil/Permissões';
        } else {
            $user->perfil()->detach();
            return 'Usuário ' . $user->name . ' agora está sem Perfil/Permissões';
        }

    }

    public function index() { //afazer mostrar todos users da mesma empresa
        $user = User::first();
        $user->perfil()->attach(1);
        dd($user->perfil);

        //fixme
        //obs index_user
        //então checar user->empresa_id == objeto->empresa_id

        $users      = User::all();
        $listaUsers = [];

        foreach ($users as $user) {
            if (Gate::allows('pertence-mesma-empresa', $user)) {
                $listaUsers[] = $user;
            }
        }
        return Response::json($listaUsers);

        //afazer transformar no guard
        //obs Lista todas as permissões
        /*$permissoes = UserPermissao::all()->toArray();
        foreach ($permissoes as $permissao) {
            $listaTodasPermissoes[] = $permissao['name'];
        }*/


    }

    public function create() {
        //
    }

    public function store() {
        //obs criar_user
        $user_json = User::create($this->validateUserRequest());
    }

    public function show(User $user_json) { // retorna usuário e um array de permissões, pode ser vazio caso nao as tenha

        $listaPermissoesUser = [];

        if (isset(User::where('id', $user_json->id)->with('perfil.permissao')->first()->toArray()['perfil'][0]['permissao'])) {
            $user = User::where('id', $user_json->id)->with('perfil.permissao')->first()->toArray()['perfil'][0]['permissao'];
            foreach ($user as $permissoes) {
                $listaPermissoesUser[] = $permissoes['name'];
            }
        }

        $usuarioAndPermissoes[] = User::find($user_json->id)->toArray();
        $usuarioAndPermissoes[] = $listaPermissoesUser;

        return $usuarioAndPermissoes;
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

    public function verificarPermissao(User $user_json, $string) { //fixme apagar
        // cada método do crud terá um nome de permissão
        // criar_paciente, remover_paciente, editar_paciente, gerar_relat_financeiro, gerar_relat_atendimentos
        // usuario
        $usuario = User::find($user_json->id);
        // tabela pivot  user >< perfil
        $userPerfilPivot = UserPerfilPivot::whereUserId($usuario->id);
        // perfil bonitinho
        $perfil = UserPerfil::find($userPerfilPivot->get()->pluck('userperfil_id')->toArray()[0]);
        // tabela pivot  perfil >< permissoes
        $perfilPermissaoPivot = PerfilPermissaoPivot::whereUserperfilId($perfil->id)->get()->toArray();

        // confere permissões através da tabela pivot e salva os nomes em um array
        foreach ($perfilPermissaoPivot as $pivot) {
            $permissao       = UserPermissao::whereId($pivot['userpermissao_id'])->first()->toArray();
            $nomePermissao[] = $permissao['name'];
        }
        dd($nomePermissao); // mostra array com as permissões

        // verifica se existe a permissão questionada no array de permissões do usuário
        return in_array($string, $nomePermissao);

        /*foreach ($nomePermissao as $nome) {
            if ($nome == $string) {
                return true;
            }
        }
        return false;*/

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
