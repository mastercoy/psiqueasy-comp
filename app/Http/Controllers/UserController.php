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

    public function setPerfilUser(User $user_json, UserPerfil $user_perfil_json) {
        //obs set_perfil
        Auth::loginUsingId(1);//fixme retirar - só para teste

        $nomeMetodo      = 'set_perfil';                                 //nome do método - permissão que usuário PRECISA ter
        $user            = Auth::user();                                 // usuário é o usuário logado atualmente no sistema
        $arrayPermissoes = $this->retornaPermissoes($user);              //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes];              // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);

        //vincula um perfil a um usuário
        $conditions      = ['user_id' => $user_json->id, 'perfil_id' => $user_perfil_json->id];
        $userPerfilPivot = UserPerfilPivot::where($conditions)->first();

        if (Gate::allows('tem-permissao', $jsonEncoder)) {
            if (!isset($userPerfilPivot)) {
                $usuario = User::find($user_json->id);
                $usuario->perfil()->attach($user_perfil_json);
            }
        } else {
            abort(403, 'Sem Permissão!');
        }


    }

    public function delPerfilUser(User $user_json) {
        //obs del_perfil
        Auth::loginUsingId(1);//fixme retirar - só para teste
        $usuario = User::find($user_json->id);

        $nomeMetodo      = 'del_perfil';                                 //nome do método - permissão que usuário PRECISA ter
        $user            = Auth::user();                                 // usuário é o usuário logado atualmente no sistema
        $arrayPermissoes = $this->retornaPermissoes($user);              //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes];              // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);

        if (Gate::allows('tem-permissao', $jsonEncoder)) {
            if (!$usuario->perfil()->get()->toArray()) {
                return 'Usuário ' . $usuario->name . ' já se encontra sem Perfil/Permissões';
            } else {
                $usuario->perfil()->detach();
                return 'Usuário ' . $usuario->name . ' agora está sem Perfil/Permissões';
            }
        } else {
            abort(403, 'Sem Permissão!');
        }


    }

    public function verificarEmail() {

        if (User::where('email', '=', Input::get('email'))->exists()) {
            return '1'; //existe
        } else {
            return '0'; //nao existe
        }
    }

    public function index() {
        Auth::loginUsingId(3);//fixme retirar - só para teste

        $nomeMetodo      = 'index_user';                       //nome do método - permissão que usuário PRECISA ter
        $usuario         = Auth::user();                       // usuário é o usuário logado atualmente no sistema
        $arrayPermissoes = $this->retornaPermissoes($usuario); //método retorna um array com as permissões do usuário

        // joga tudo em um array, converte pra json e envia no guard
        $arrayCompleto = [$nomeMetodo, $arrayPermissoes];

        $users      = User::all();
        $listaUsers = [];

        foreach ($users as $user) {
            $arrayCompleto[2] = $user;
            $jsonEncoder      = json_encode($arrayCompleto); //precisa transformar em json pois o guard nao aceita array
            if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
                $listaUsers[] = $user;
            }
        }
        return Response::json($listaUsers);
    }

    public function store() {
        //obs criar_user
        Auth::loginUsingId(1); //fixme retirar

        $nomeMetodo      = 'criar_user';                     // passa como string, o 'nome' do método, utilizado para verificar a permissão, cujo o nome é o mesmo
        $user            = Auth::user();                     // usuário é o usuário logado
        $arrayPermissoes = $this->retornaPermissoes($user);  //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes];
        $jsonEncoder     = json_encode($arrayCompleto); //precisa transformar em json pois o guard nao aceita array

        if (Gate::allows('tem-permissao', $jsonEncoder)) {
            $user_json = User::create($this->validateUserRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function show(User $user_json) {
        //obs show_user
        Auth::loginUsingId(1);//fixme retirar - só para teste
        $usuario = User::find($user_json->id);

        $nomeMetodo      = 'show_user';                                 //nome do método - permissão que usuário PRECISA ter
        $user            = Auth::user();                                // usuário é o usuário logado atualmente no sistema
        $arrayPermissoes = $this->retornaPermissoes($user);             //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $usuario];   // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) { //fixme guard
            return $usuario;
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function update(User $user_json) {
        //obs update_user
        Auth::loginUsingId(1);//fixme retirar - só para teste
        $usuario = User::find($user_json->id);

        $nomeMetodo      = 'update_user';                                //nome do método - permissão que usuário PRECISA ter
        $user            = Auth::user();                                 // usuário é o usuário logado atualmente no sistema
        $arrayPermissoes = $this->retornaPermissoes($user);              //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $usuario];    // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $user_json->update($this->validateUserRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function destroy(User $user_json) {
        //obs destroy_user
        Auth::loginUsingId(1);//fixme retirar - só para teste
        $usuario = User::find($user_json->id);

        $nomeMetodo      = 'destroy_user';                                //nome do método - permissão que usuário PRECISA ter
        $user            = Auth::user();                                  // usuário é o usuário logado atualmente no sistema
        $arrayPermissoes = $this->retornaPermissoes($user);               //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $usuario];     // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $user_json->delete();
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function desativarUser(User $user_json) {
        //obs desativar_user
        Auth::loginUsingId(1);//fixme retirar - só para teste
        $usuario = User::find($user_json->id);

        $nomeMetodo      = 'desativar_user';                                //nome do método - permissão que usuário PRECISA ter
        $user            = Auth::user();                                    // usuário é o usuário logado atualmente no sistema
        $arrayPermissoes = $this->retornaPermissoes($user);                 //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $usuario];       // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $usuario->active = false;
            $usuario->save();
        } else {
            abort(403, 'Sem Permissão!');
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
