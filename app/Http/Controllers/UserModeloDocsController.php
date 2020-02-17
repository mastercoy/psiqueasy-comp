<?php

namespace App\Http\Controllers;

use App\Models\UserModeloDocs;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class UserModeloDocsController extends Controller { //verificar se user->id == objeto->user_id

    public function index() {
        Auth::loginUsingId(1); //fixme remover

        $nomeMetodo      = 'index_user_model';                      //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();              //método retorna um array com as permissões do usuário

        // joga tudo em um array, converte pra json e envia no guard
        $arrayCompleto = [$nomeMetodo, $arrayPermissoes];

        $modelos      = UserModeloDocs::all();
        $listaModelos = [];

        foreach ($modelos as $modelo) {
            $arrayCompleto[2] = $modelo;
            $jsonEncoder      = json_encode($arrayCompleto); //precisa transformar em json pois o guard nao aceita array
            if (Gate::allows('pertence-usuario-logado-e-tem-permissao', $jsonEncoder)) {
                $listaModelos[] = $modelo;
            }
        }
        return Response::json($listaModelos);
    }

    public function store() {
        //obs criar_user_model
        Auth::loginUsingId(1); //fixme retirar

        $nomeMetodo      = 'criar_user_model';                      //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();              //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes];         // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);             //precisa transformar em json pois o guard nao aceita array

        if (Gate::allows('tem-permissao', $jsonEncoder)) {
            $modelo = UserModeloDocs::create($this->validateModeloDocsRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function show(UserModeloDocs $user_modelo_docs_json) {
        Auth::loginUsingId(1);//fixme retirar - só para teste
        $modelo = UserModeloDocs::find($user_modelo_docs_json->id);

        $nomeMetodo      = 'show_user_model';                                   //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();                          //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $modelo];            // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);                         // guard nao aceita array, envio entao um json

        if (Gate::allows('pertence-usuario-logado-e-tem-permissao', $jsonEncoder)) {
            return $modelo;
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function update(UserModeloDocs $user_modelo_docs_json) {
        //obs update_user_model
        Auth::loginUsingId(1);
        $modelo = UserModeloDocs::find($user_modelo_docs_json->id);

        $nomeMetodo      = 'update_user_model';                                        //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();                                 //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $modelo];                   // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);                                // guard nao aceita array, envio entao um json

        if (Gate::allows('pertence-usuario-logado-e-tem-permissao', $jsonEncoder)) {
            $user_modelo_docs_json->update($this->validateModeloDocsRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function destroy(UserModeloDocs $user_modelo_docs_json) {
        Auth::loginUsingId(1);//fixme retirar - só para teste
        $modelo = UserModeloDocs::find($user_modelo_docs_json->id);

        $nomeMetodo      = 'destroy_user_model';                                   //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();                             //método retorna um array com as permissões do usuário logado atualmente no sistema
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $modelo];               // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);                            // guard nao aceita array, envio entao um json

        if (Gate::allows('pertence-usuario-logado', $jsonEncoder)) {
            $user_modelo_docs_json->delete();
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function desativarModeloDocs(UserModeloDocs $user_modelo_docs_json) {
        //obs desativar_user_model
        Auth::loginUsingId(1);//fixme retirar - só para teste
        $modelo = UserModeloDocs::find($user_modelo_docs_json->id);

        $nomeMetodo      = 'desativar_responsavel';                                  //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();                               //método retorna um array com as permissões do usuário logado atualmente no sistema
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $modelo];                 // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);                              // guard nao aceita array, envio entao um json

        if (Gate::allows('pertence-usuario-logado-e-tem-permissao', $jsonEncoder)) {
            $modelo->active = false;
            $modelo->save();
        } else {
            abort(403, 'Sem Permissão!');
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

    protected function validateModeloDocsRequest() {
        return request()->validate([
                                       'name' => 'required',
                                       'conteudo' => 'nullable',
                                       'active' => 'nullable',
                                       'user_id' => 'required'
                                   ]);
    }

}
