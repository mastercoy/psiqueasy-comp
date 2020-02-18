<?php

namespace App\Http\Controllers;

use App\Models\UserModeloDocs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class UserModeloDocsController extends Controller {

    public function index() {
        Auth::loginUsingId(1);

        $nomeMetodo    = 'index_user_model';    //nome do método - permissão que usuário PRECISA ter
        $arrayCompleto = [$nomeMetodo];

        $modelos      = UserModeloDocs::where('user_id', auth()->user()->id)->whereActive('1');
        $listaModelos = [];

        foreach ($modelos->get()->toArray() as $modelo) {
            $arrayCompleto[1] = $modelo;
            $jsonEncoder      = json_encode($arrayCompleto); //precisa transformar em json pois o guard nao aceita array
            if (Gate::allows('pertence-usuario-logado-e-tem-permissao', $jsonEncoder)) {
                $listaModelos[] = $modelo;
            }


        }
        return Response::json($listaModelos);
    }

    public function store() {
        Auth::loginUsingId(1);
        $nomeMetodo = 'criar_user_model'; //nome do método - permissão que usuário PRECISA ter

        if (Gate::allows('tem-permissao', $nomeMetodo)) {
            UserModeloDocs::create($this->validateModeloDocsRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function show(UserModeloDocs $user_modelo_docs_json) {
        Auth::loginUsingId(1);
        $modelo = UserModeloDocs::find($user_modelo_docs_json->id);

        if ($modelo->active == 0) {
            return null;
        }

        $nomeMetodo    = 'show_user_model';                                   //nome do método - permissão que usuário PRECISA ter
        $arrayCompleto = [$nomeMetodo, $modelo];                              // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder   = json_encode($arrayCompleto);                         // guard nao aceita array, envio entao um json

        if (Gate::allows('pertence-usuario-logado-e-tem-permissao', $jsonEncoder)) {
            return $modelo;
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function update(UserModeloDocs $user_modelo_docs_json) {

        Auth::loginUsingId(1);
        $modelo = UserModeloDocs::find($user_modelo_docs_json->id);

        $nomeMetodo    = 'update_user_model';               //nome do método - permissão que usuário PRECISA ter
        $arrayCompleto = [$nomeMetodo, $modelo];            // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder   = json_encode($arrayCompleto);       // guard nao aceita array, envio entao um json

        if (Gate::allows('pertence-usuario-logado-e-tem-permissao', $jsonEncoder)) {
            $user_modelo_docs_json->update($this->validateModeloDocsRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function destroy(UserModeloDocs $user_modelo_docs_json) {
        Auth::loginUsingId(1);
        $modelo = UserModeloDocs::find($user_modelo_docs_json->id);

        $nomeMetodo    = 'destroy_user_model';         //nome do método - permissão que usuário PRECISA ter
        $arrayCompleto = [$nomeMetodo, $modelo];       // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder   = json_encode($arrayCompleto);  // guard nao aceita array, envio entao um json

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

        $nomeMetodo    = 'desativar_responsavel';    //nome do método - permissão que usuário PRECISA ter
        $arrayCompleto = [$nomeMetodo, $modelo];     // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder   = json_encode($arrayCompleto);// guard nao aceita array, envio entao um json

        if (Gate::allows('pertence-usuario-logado-e-tem-permissao', $jsonEncoder)) {
            $modelo->active = false;
            $modelo->save();
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    // ========================= protected


    protected function validateModeloDocsRequest() {
        return request()->validate([
                                       'name' => 'required',
                                       'conteudo' => 'nullable',
                                       'active' => 'nullable',
                                       'user_id' => 'required'
                                   ]);
    }

}
