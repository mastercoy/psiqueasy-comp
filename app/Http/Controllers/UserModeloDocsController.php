<?php

namespace App\Http\Controllers;

use App\Models\UserModeloDocs;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class UserModeloDocsController extends Controller { //verificar se user->id == objeto->user_id

    public function index() {
        //obs index_user_model
        $modelos      = UserModeloDocs::all();
        $listaModelos = [];

        foreach ($modelos as $modelo) {
            if (Gate::allows('pertence-usuario-logado', $modelo)) {
                $listaModelos[] = $modelo;
            }
        }
        return Response::json($listaModelos);
    }

    public function create() {
        //
    }

    public function store() {
        //obs criar_user_model
        $modelo = UserModeloDocs::create($this->validateModeloDocsRequest());
    }

    public function show(UserModeloDocs $user_modelo_docs_json) {
        //obs show_user_model
        $modelo = UserModeloDocs::find($user_modelo_docs_json->id);
        if (Gate::allows('pertence-usuario-logado', $modelo)) {
            return $modelo;
        } else {
            abort(403, 'Não encontrado!');
        }
    }

    public function edit(UserModeloDocs $user_modelo_docs_json) {
        //
    }

    public function update(UserModeloDocs $user_modelo_docs_json) {
        //obs update_user_model
        $modelo = UserModeloDocs::find($user_modelo_docs_json->id);
        if (Gate::allows('pertence-usuario-logado', $modelo)) {
            $user_modelo_docs_json->update($this->validateModeloDocsRequest());
        } else {
            abort(403, 'Não encontrado!');
        }
    }

    public function destroy(UserModeloDocs $user_modelo_docs_json) {
        //obs destroy_user_model
        $modelo = UserModeloDocs::find($user_modelo_docs_json->id);
        if (Gate::allows('pertence-usuario-logado', $modelo)) {
            $user_modelo_docs_json->delete();
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    public function desativarModeloDocs(UserModeloDocs $user_modelo_docs_json) {
        //obs desativar_user_model
        $modelo = UserModeloDocs::find($user_modelo_docs_json->id);
        if (Gate::allows('pertence-usuario-logado', $modelo)) {
            $modelo->active = false;
            $modelo->save();
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    // ========================= protected

    protected function validateModeloDocsRequest() {
        return request()->validate([
                                       'name' => 'required',
                                       'conteudo' => 'nullable',
                                       'active' => 'nullable',
                                       'user_id' => 'nullable'
                                   ]);
    }

}
