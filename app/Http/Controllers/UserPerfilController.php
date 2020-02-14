<?php

namespace App\Http\Controllers;

use App\Models\PerfilPermissaoPivot;
use App\Models\UserPerfil;
use App\Models\UserPermissao;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class UserPerfilController extends Controller {

    public function setPermissaoPerfil(UserPerfil $user_perfil_json, UserPermissao $user_permissao_json) {
        //obs set_permissao
        Auth::loginUsingId(1);//fixme retirar - só para teste

        $nomeMetodo      = 'set_permissao';                                 //nome do método - permissão que usuário PRECISA ter
        $user            = Auth::user();                                    // usuário é o usuário logado atualmente no sistema
        $arrayPermissoes = $this->retornaPermissoes($user);                 //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes];                 // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);

        $conditions           = ['perfil_id' => $user_perfil_json->id, 'permissao_id' => $user_permissao_json->id];
        $perfilPermissaoPivot = PerfilPermissaoPivot::where($conditions)->first();

        if (Gate::allows('tem-permissao', $jsonEncoder)) {
            if (!isset($perfilPermissaoPivot)) {
                $perfil = UserPerfil::find($user_perfil_json->id);
                $perfil->permissao()->attach($user_permissao_json);
            }
        } else {
            abort(403, 'Sem Permissão!');
        }


    }

    public function delPermissaoPerfil(UserPerfil $user_perfil_json, UserPermissao $user_permissao_json) {
        //obs del_permissao
        Auth::loginUsingId(1);//fixme retirar - só para teste

        $nomeMetodo      = 'del_permissao';                                 //nome do método - permissão que usuário PRECISA ter
        $user            = Auth::user();                                    // usuário é o usuário logado atualmente no sistema
        $arrayPermissoes = $this->retornaPermissoes($user);                 //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes];                 // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);

        $conditions           = ['perfil_id' => $user_perfil_json->id, 'permissao_id' => $user_permissao_json->id];
        $perfilPermissaoPivot = PerfilPermissaoPivot::where($conditions)->first();

        if (Gate::allows('tem-permissao', $jsonEncoder)) {
            if (isset($perfilPermissaoPivot)) {
                $perfil = UserPerfil::find($user_perfil_json->id);
                $perfil->permissao()->detach($user_permissao_json);
            }
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function index() { //afazer to aqui
        //obs index_perfil
        Auth::loginUsingId(1);
        $perfis      = UserPerfil::all();
        $listaPerfis = [];

        foreach ($perfis as $perfil) {
            if (Gate::allows('pertence-mesma-empresa', $perfil)) {
                $listaPerfis[] = $perfil;
            }
        }
        return Response::json($listaPerfis);
    }

    public function store() {
        //obs criar_perfil
        $perfil = UserPerfil::create($this->validateUserPerfilRequest());
    }

    public function show(UserPerfil $user_perfil_json) {
        //obs show_perfil
        $perfil = UserPerfil::find($user_perfil_json->id);
        if (Gate::allows('pertence-mesma-empresa', $perfil)) {
            return $perfil;
        } else {
            abort(403, 'Não encontrado!');
        }


    }

    public function update(UserPerfil $user_perfil_json) {
        //obs update_perfil
        $perfil = UserPerfil::find($user_perfil_json->id);
        if (Gate::allows('pertence-mesma-empresa', $perfil)) {
            $user_perfil_json->update($this->validateUserPerfilRequest());
        } else {
            abort(403, 'Não encontrado!');
        }
    }

    public function destroy(UserPerfil $user_perfil_json) {
        //obs destroy_perfil
        $perfil = UserPerfil::find($user_perfil_json->id);
        if (Gate::allows('pertence-mesma-empresa', $perfil)) {
            $user_perfil_json->delete();
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    public function desativarUserPerfil(UserPerfil $user_perfil_json) {
        //obs desativar_perfil
        $perfil = UserPerfil::find($user_perfil_json->id);
        if (Gate::allows('pertence-mesma-empresa', $perfil)) {
            $perfil->active = false;
            $perfil->save();
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

    protected function validateUserPerfilRequest() {
        return request()->validate([
                                       'name' => 'required',
                                       'label' => 'nullable',
                                       'active' => 'nullable',
                                       'user_id' => 'nullable',
                                       'empresa_id' => 'nullable'
                                   ]);


    }
}
