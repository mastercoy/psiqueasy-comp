<?php

namespace App\Http\Controllers;

use App\Models\UserModeloDocs;
use Illuminate\Support\Facades\Gate;

class UserModeloDocsController extends Controller {

    public function index() {
        //afazer retornar todos os modelos
    }

    public function create() {
        //
    }

    public function store() {
        $modelo = UserModeloDocs::create($this->validateModeloDocsRequest());
    }

    public function show(UserModeloDocs $user_modelo_docs_json) {
        //
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
        //
        $modelo = UserModeloDocs::find($user_modelo_docs_json->id);
        if (Gate::allows('pertence-usuario-logado', $modelo)) {
            $user_modelo_docs_json->update($this->validateModeloDocsRequest());
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    public function destroy(UserModeloDocs $user_modelo_docs_json) {
        //
        $modelo = UserModeloDocs::find($user_modelo_docs_json->id);
        if (Gate::allows('pertence-usuario-logado', $modelo)) {
            $user_modelo_docs_json->delete();
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    public function desativarModeloDocs(UserModeloDocs $user_modelo_docs_json) {
        //
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
