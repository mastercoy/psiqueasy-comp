<?php

namespace App\Http\Controllers;

use App\Models\UserModeloDocs;

class UserModeloDocsController extends Controller {

    public function index() {
        //
    }

    public function create() {
        //
    }

    public function store() {
        $modelo = UserModeloDocs::create($this->validateModeloDocsRequest());
    }

    protected function validateModeloDocsRequest() {
        return request()->validate([
                                       'name' => 'required',
                                       'conteudo' => 'nullable',
                                       'active' => 'nullable',
                                       'user_id' => 'nullable'
                                   ]);
    }

    public function show(UserModeloDocs $user_modelo_docs_json) {
        return $modelo = UserModeloDocs::find($user_modelo_docs_json->id);
    }

    public function edit(UserModeloDocs $user_modelo_docs_json) {
        //
    }

    public function update(UserModeloDocs $user_modelo_docs_json) {
        $user_modelo_docs_json->update($this->validateModeloDocsRequest());
    }

    public function destroy(UserModeloDocs $user_modelo_docs_json) {
        $user_modelo_docs_json->delete();
    }

    // ========================= protected

    public function desativarModeloDocs(UserModeloDocs $user_modelo_docs_json) {
        $modelo         = UserModeloDocs::find($user_modelo_docs_json->id);
        $modelo->active = false;
        $modelo->save();
    }
}
