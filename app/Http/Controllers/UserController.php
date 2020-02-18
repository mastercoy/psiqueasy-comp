<?php

namespace App\Http\Controllers;

use App\Models\UserPerfil;
use App\Models\UserPerfilPivot;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class UserController extends Controller {

    public function setPerfilUser(User $user_json, UserPerfil $user_perfil_json) {//fixme permissão
        Auth::loginUsingId(1);
        $nomeMetodo = 'set_perfil';

        $conditions      = ['user_id' => $user_json->id, 'perfil_id' => $user_perfil_json->id];
        $userPerfilPivot = UserPerfilPivot::where($conditions)->first();

        if (Gate::allows('tem-permissao', $nomeMetodo)) {
            if (!isset($userPerfilPivot)) {
                $usuario = User::find($user_json->id);
                $usuario->perfil()->attach($user_perfil_json);
            }
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function delPerfilUser(User $user_json) { //fixme permissão
        Auth::loginUsingId(1);
        $usuario    = User::find($user_json->id);
        $nomeMetodo = 'del_perfil';

        if (Gate::allows('tem-permissao', $nomeMetodo)) {
            if ($usuario->perfil()->get()->toArray()) {
                $usuario->perfil()->detach();
            }
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function verificarEmail() {

        if (User::where('email', '=', Input::get('email'))->exists()) {
            return '1'; // existe
        } else {
            return '0'; // nao existe
        }
    }

    public function index() {
        Auth::loginUsingId(1);

        $nomeMetodo    = 'index_user';
        $arrayCompleto = [$nomeMetodo];

        $users      = User::all();
        $listaUsers = [];

        foreach ($users as $user) {
            if ($user->active != 0) {
                $arrayCompleto[1] = $user;
                $jsonEncoder      = json_encode($arrayCompleto);
                if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
                    $listaUsers[] = $user;
                }
            }
        }
        return Response::json($listaUsers);
    }

    public function store() {
        Auth::loginUsingId(1);
        $nomeMetodo = 'criar_user';

        if (Gate::allows('tem-permissao', $nomeMetodo)) {
            User::create($this->validateUserRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function show(User $user_json) {
        Auth::loginUsingId(1);
        $usuario = User::find($user_json->id);

        if ($usuario->active == 0) {
            return null;
        }

        $nomeMetodo    = 'show_user';
        $arrayCompleto = [$nomeMetodo, $usuario];
        $jsonEncoder   = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            return $usuario;
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function update(User $user_json) {
        Auth::loginUsingId(1);
        $usuario = User::find($user_json->id);

        $nomeMetodo    = 'update_user';
        $arrayCompleto = [$nomeMetodo, $usuario];
        $jsonEncoder   = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $user_json->update($this->validateUserRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function destroy(User $user_json) {
        Auth::loginUsingId(1);
        $usuario = User::find($user_json->id);

        $nomeMetodo    = 'destroy_user';
        $arrayCompleto = [$nomeMetodo, $usuario];
        $jsonEncoder   = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $user_json->delete();
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function desativarUser(User $user_json) {
        Auth::loginUsingId(1);
        $usuario = User::find($user_json->id);

        $nomeMetodo    = 'desativar_user';
        $arrayCompleto = [$nomeMetodo, $usuario];
        $jsonEncoder   = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $usuario->active = false;
            $usuario->save();
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function retornaPermissoes() {
        $user_json           = Auth::user();
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
