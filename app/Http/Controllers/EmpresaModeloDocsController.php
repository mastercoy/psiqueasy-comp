<?php

namespace App\Http\Controllers;

use App\Models\EmpresaModeloDocs;

class EmpresaModeloDocsController extends Controller {

    public function index() {

    }


    public function create() {

    }

    public function store() {
        $modelo = EmpresaModeloDocs::create($this->validateModeloDocsRequest());
    }

    protected function validateModeloDocsRequest() {
        return request()->validate([
                                       'name' => 'required',
                                       'conteudo' => 'nullable',
                                       'active' => 'nullable',
                                       'empresa_id' => 'nullable'
                                   ]);
    }

    public function show(EmpresaModeloDocs $empresa_modelo_docs_json) {
        return $modelo = EmpresaModeloDocs::find($empresa_modelo_docs_json->id);
    }

    public function edit(EmpresaModeloDocs $empresa_modelo_docs_json) {

    }

    public function update(EmpresaModeloDocs $empresa_modelo_docs_json) {
        $empresa_modelo_docs_json->update($this->validateModeloDocsRequest());
    }

    public function destroy(EmpresaModeloDocs $empresa_modelo_docs_json) {
        $empresa_modelo_docs_json->delete();
    }

    // ========================= protected

    public function desativarModeloDocs(EmpresaModeloDocs $empresa_modelo_docs_json) {
        $modelo         = EmpresaModeloDocs::find($empresa_modelo_docs_json->id);
        $modelo->active = false;
        $modelo->save();
    }
}
