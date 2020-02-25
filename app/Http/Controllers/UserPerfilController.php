<?php

namespace App\Http\Controllers;

use App\Models\PerfilPermissaoPivot;
use App\Models\UserPerfil;
use App\Models\UserPerfilPivot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class UserPerfilController extends Controller {

    public function setPermissoes(UserPerfil $user_perfil_json) {
        Auth::loginUsingId(1);
        $perfil        = UserPerfil::find($user_perfil_json->id);
        $permissoes    = Input::all();
        $nomeMetodo    = 'set_permissao';
        $arrayCompleto = [$nomeMetodo, $perfil];
        $jsonEncoder   = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            foreach ($permissoes as $permissao) {
                $conditions           = ['perfil_id' => $user_perfil_json->id, 'permissao_id' => $permissao];
                $perfilPermissaoPivot = PerfilPermissaoPivot::where($conditions)->first();

                if (!isset($perfilPermissaoPivot)) {
                    $perfil = UserPerfil::find($user_perfil_json->id);
                    $perfil->permissao()->attach($permissao);
                }
            }
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function delPermissoes(UserPerfil $user_perfil_json) {
        Auth::loginUsingId(1);
        $permissoes = Input::all();
        $nomeMetodo = 'del_permissao';

        if (Gate::allows('tem-permissao', $nomeMetodo)) {
            foreach ($permissoes as $permissao) {
                $conditions           = ['perfil_id' => $user_perfil_json->id, 'permissao_id' => $permissao];
                $perfilPermissaoPivot = PerfilPermissaoPivot::where($conditions)->first();

                if (isset($perfilPermissaoPivot)) {
                    $perfil = UserPerfil::find($user_perfil_json->id);
                    $perfil->permissao()->detach($permissao);
                }
            }
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function quaisPermissoes(UserPerfil $user_perfil_json) { //afazer guard etc e tal
        $perfil = UserPerfil::find($user_perfil_json->id);
        return $perfil->permissao()->get()->toArray();

    }

    public function index() {
        Auth::loginUsingId(1);
        $nomeMetodo    = 'index_perfil';
        $arrayCompleto = [$nomeMetodo];
        $perfis        = UserPerfil::where('empresa_id', auth()->user()->empresa_id)->whereActive('1');
        $listaPerfis   = [];

        foreach ($perfis->get()->toArray() as $perfil) {
            $arrayCompleto[1] = $perfil;
            $jsonEncoder      = json_encode($arrayCompleto);

            if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
                $quant         = count(UserPerfilPivot::where('perfil_id', $perfil['id'])->get()->toArray());
                $listaPerfis[] = $perfil;
                $listaPerfis[] = $quant;
            }

        }
        return Response::json($listaPerfis);
    }

    public function store() {
        Auth::loginUsingId(1);
        $nomeMetodo = 'criar_perfil';

        if (Gate::allows('tem-permissao', $nomeMetodo)) {
            $conditions = ['name' => Input::get('name'), 'empresa_id' => Input::get('empresa_id')];
            $perfil     = UserPerfil::where($conditions)->first();

            if (!isset($perfil)) { //caso o perfil ainda não exista
                $perfil = UserPerfil::create($this->validateUserPerfilRequest());
                return $perfil->id;
            } else {
                return 'já existe';
            }
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function show(UserPerfil $user_perfil_json) {
        Auth::loginUsingId(1);
        $perfil = UserPerfil::find($user_perfil_json->id);

        if ($perfil->active == 0) {
            return null;
        }

        $nomeMetodo    = 'show_perfil';                                  // nome do método - permissão que usuário PRECISA ter
        $arrayCompleto = [$nomeMetodo, $perfil];                         // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder   = json_encode($arrayCompleto);                    // guard nao aceita array, envio entao um json

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            return $perfil;
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function update(UserPerfil $user_perfil_json) {
        Auth::loginUsingId(1);
        $perfil = UserPerfil::find($user_perfil_json->id);

        $nomeMetodo    = 'update_perfil';               // nome do método - permissão que usuário PRECISA ter
        $arrayCompleto = [$nomeMetodo, $perfil];        // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder   = json_encode($arrayCompleto);   // guard nao aceita array, envio entao um json

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $user_perfil_json->update($this->validateUserPerfilRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function destroy(UserPerfil $user_perfil_json) {
        Auth::loginUsingId(1);
        $perfil = UserPerfil::find($user_perfil_json->id);

        $nomeMetodo    = 'destroy_perfil';                                  // nome do método - permissão que usuário PRECISA ter
        $arrayCompleto = [$nomeMetodo, $perfil];                            // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder   = json_encode($arrayCompleto);                       // guard nao aceita array, envio entao um json

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $user_perfil_json->delete();
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    public function desativarUserPerfil(UserPerfil $user_perfil_json) {
        Auth::loginUsingId(1);
        $perfil = UserPerfil::find($user_perfil_json->id);

        $nomeMetodo    = 'desativar_perfil';                                // nome do método - permissão que usuário PRECISA ter
        $arrayCompleto = [$nomeMetodo, $perfil];                            // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder   = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $perfil->active = false;
            $perfil->save();
        } else {
            abort(403, 'Não encontrado!');
        }
    }

    public function inativosPerfil() {
        Auth::loginUsingId(1);
        $user       = Auth::user();
        $nomeMetodo = 'listar_perfis_desat';

        if (Gate::allows('tem-permissao', $nomeMetodo)) {
            return UserPerfil::where([['empresa_id', '=', $user->empresa_id], // do usuário
                                      ['active', '=', 0], // desativados
                                     ])->orderBy('updated_at', 'desc')->get();
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    // ========================= protected

    protected function validateUserPerfilRequest() {
        return request()->validate([
                                       'name' => 'required',
                                       'label' => 'nullable',
                                       'active' => 'nullable',
                                       'user_id' => 'nullable',
                                       'empresa_id' => 'required'
                                   ]);


    }
}
