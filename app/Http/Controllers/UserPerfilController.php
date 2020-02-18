<?php

namespace App\Http\Controllers;

use App\Models\PerfilPermissaoPivot;
use App\Models\UserPerfil;
use App\Models\UserPerfilPivot;
use App\Models\UserPermissao;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class UserPerfilController extends Controller {

    public function setPermissaoPerfil(UserPerfil $user_perfil_json, UserPermissao $user_permissao_json) {
        Auth::loginUsingId(1);//fixme retirar - só para teste

        $nomeMetodo      = 'set_permissao';                                 //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();                      //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes];                 // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);

        //afazer foreach aqui
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

    public function setPermissoes(UserPerfil $user_perfil_json) { //obs ta filé - recebe um array tipo [1,2,3,6,10] com apenas o id das permissões
        Auth::loginUsingId(1);                                    //fixme retirar - só para teste

        $permissoes      = Input::all();                                    // agora é um array de permissões
        $nomeMetodo      = 'set_permissao';                                 // nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();                      // método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes];                 // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);                     // precisa transformar em json pois o guard nao aceita array

        foreach ($permissoes as $permissao) {

            $conditions           = ['perfil_id' => $user_perfil_json->id, 'permissao_id' => $permissao];
            $perfilPermissaoPivot = PerfilPermissaoPivot::where($conditions)->first();

            if (!isset($perfilPermissaoPivot)) {
                if (Gate::allows('tem-permissao', $jsonEncoder)) {
                    $perfil = UserPerfil::find($user_perfil_json->id);
                    $perfil->permissao()->attach($permissao);
                }
            }

        }


    }

    public function delPermissaoPerfil(UserPerfil $user_perfil_json, UserPermissao $user_permissao_json) {
        Auth::loginUsingId(1);//fixme retirar - só para teste

        $nomeMetodo      = 'del_permissao';                                 //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();                      //método retorna um array com as permissões do usuário
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

    public function index() {
        Auth::loginUsingId(1); //fixme remover

        $nomeMetodo      = 'index_perfil';                     // nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();         // método retorna um array com as permissões do usuário

        // joga tudo em um array, converte pra json e envia no guard
        $arrayCompleto = [$nomeMetodo, $arrayPermissoes];

        $perfis      = UserPerfil::all();
        $listaPerfis = [];

        foreach ($perfis as $perfil) {
            $arrayCompleto[2] = $perfil;
            $jsonEncoder      = json_encode($arrayCompleto); // precisa transformar em json pois o guard nao aceita array
            if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
                $quant         = count(UserPerfilPivot::where('perfil_id', $perfil->id)->get()->toArray());
                $listaPerfis[] = $perfil; //obs será q da pra melhorar?
                $listaPerfis[] = $quant;

            }
        }
        return Response::json($listaPerfis);
    }

    public function store() {
        Auth::loginUsingId(1); //fixme retirar

        $nomeMetodo      = 'criar_perfil';                     // passa como string, o 'nome' do método, utilizado para verificar a permissão, cujo o nome é o mesmo
        $arrayPermissoes = $this->retornaPermissoes();         // método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes];    // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);        // guard nao aceita array, envio entao um json

        if (Gate::allows('tem-permissao', $jsonEncoder)) {
            $conditions = ['name' => Input::get('name'), 'empresa_id' => Input::get('empresa_id')];

            if (!UserPerfil::where($conditions)) {
                $perfil = UserPerfil::create($this->validateUserPerfilRequest());
                return 'ID do perfil recém criado: ' . $perfil->id; //obs parei aqui
            } else {
                return 'Perfil já existe';
            }
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function show(UserPerfil $user_perfil_json) {
        Auth::loginUsingId(1);//fixme retirar - só para teste
        $perfil = UserPerfil::find($user_perfil_json->id);

        $nomeMetodo      = 'show_perfil';                                  //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();                     //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $perfil];       // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);                    // guard nao aceita array, envio entao um json

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            return $perfil;
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function update(UserPerfil $user_perfil_json) {
        Auth::loginUsingId(1);
        $perfil = UserPerfil::find($user_perfil_json->id);

        $nomeMetodo      = 'update_perfil';                                  //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();                       //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $perfil];         // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);                      // guard nao aceita array, envio entao um json

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $user_perfil_json->update($this->validateUserPerfilRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function destroy(UserPerfil $user_perfil_json) {
        //obs destroy_perfil
        Auth::loginUsingId(1);//fixme retirar - só para teste
        $perfil = UserPerfil::find($user_perfil_json->id);

        $nomeMetodo      = 'destroy_perfil';                                  //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();                        //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $perfil];          // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);                       // guard nao aceita array, envio entao um json

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $user_perfil_json->delete();
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    public function desativarUserPerfil(UserPerfil $user_perfil_json) {
        //obs desativar_perfil
        Auth::loginUsingId(1);//fixme retirar - só para teste
        $perfil = UserPerfil::find($user_perfil_json->id);

        $nomeMetodo      = 'desativar_perfil';                                //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();                        //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $perfil];          // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $perfil->active = false;
            $perfil->save();
        } else {
            abort(403, 'Não encontrado!');
        }
    }

    // ========================= protected

    protected function retornaPermissoes() {
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
