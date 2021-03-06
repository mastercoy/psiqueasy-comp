<?php

namespace App\Http\Controllers;

use App\Models\UserPerfil;
use App\Models\UserPerfilPivot;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class UserController extends Controller {

    public function setPerfilUser(User $user_json, UserPerfil $user_perfil_json) {
        Auth::loginUsingId(1);
        $nomeMetodo    = 'set_perfil';
        $arrayCompleto = [$nomeMetodo, $user_json];
        $jsonEncoder   = json_encode($arrayCompleto);

        $conditions      = ['user_id' => $user_json->id, 'perfil_id' => $user_perfil_json->id];
        $userPerfilPivot = UserPerfilPivot::where($conditions)->first();

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            if (!isset($userPerfilPivot)) {
                $usuario = User::find($user_json->id);
                $usuario->perfil()->attach($user_perfil_json);
            }
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function delPerfilUser(User $user_json) {
        Auth::loginUsingId(1);
        $usuario       = User::find($user_json->id);
        $nomeMetodo    = 'del_perfil';
        $arrayCompleto = [$nomeMetodo, $usuario];
        $jsonEncoder   = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            if ($usuario->perfil()->get()->toArray()) {
                $usuario->perfil()->detach();
            }
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function associarUserAntigoEmpresa(Request $request) {
        $desencriptado = decrypt($request->hash);

        $user             = User::where('email', $desencriptado['email'])->first();
        $perfil           = UserPerfil::where('id', $desencriptado['perfil_id'])->first();
        $user->empresa_id = $desencriptado['empresa_id'];
        $user->perfil()->attach($perfil);
        $user->save();

        return 'Associação feita com sucesso!';

    }

    public function verificarEmail() {
        if (User::where('email', Input::get('email'))
                ->where('empresa_id', !null)->exists()) {
            return '1'; // existe
        } else {
            return '0'; // nao existe
        }
    }

    public function index() {
        Auth::loginUsingId(1);
        $nomeMetodo    = 'index_user';
        $arrayCompleto = [$nomeMetodo];
        $users         = User::where('empresa_id', auth()->user()->empresa_id)->whereActive('1');
        $listaUsers    = [];

        foreach ($users->get()->toArray() as $user) {
            $arrayCompleto[1] = $user;
            $jsonEncoder      = json_encode($arrayCompleto);
            if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
                $listaUsers[] = $user;
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

    public function inativosUser() {
        Auth::loginUsingId(1);
        $user       = Auth::user();
        $nomeMetodo = 'listar_users_desat';

        if (Gate::allows('tem-permissao', $nomeMetodo)) {
            return User::where([['empresa_id', '=', $user->empresa_id], // do usuário
                                ['active', '=', 0], // desativados
                               ])->orderBy('updated_at', 'desc')->get();
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
