<?php

namespace App\Http\Controllers;

use App\Models\EmpresaModeloDocs;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class EmpresaModeloDocsController extends Controller {

    public function index() {
        //
        $modelo = EmpresaModeloDocs::all();
        return Response::json($modelo);
    }

    public function create() {
        //
    }

    public function store() {
        $modelo = EmpresaModeloDocs::create($this->validateModeloDocsRequest());
    }

    public function show(EmpresaModeloDocs $empresa_modelo_docs_json) {
        //
        $modelo = EmpresaModeloDocs::find($empresa_modelo_docs_json->id);
        if (Gate::allows('pertence-mesma-empresa', $modelo)) {
            return $modelo;
        } else {
            abort(403, 'Não encontrado!');
        }
    }

    public function edit(EmpresaModeloDocs $empresa_modelo_docs_json) {
        //
    }

    public function update(EmpresaModeloDocs $empresa_modelo_docs_json) {
        //
        $modelo = EmpresaModeloDocs::find($empresa_modelo_docs_json->id);
        if (Gate::allows('pertence-mesma-empresa', $modelo)) {
            $empresa_modelo_docs_json->update($this->validateModeloDocsRequest());
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    public function destroy(EmpresaModeloDocs $empresa_modelo_docs_json) {
        //
        $modelo = EmpresaModeloDocs::find($empresa_modelo_docs_json->id);
        if (Gate::allows('pertence-mesma-empresa', $modelo)) {
            $empresa_modelo_docs_json->delete();
        } else {
            abort(403, 'Não encontrado!');
        }

    }


    public function desativarModeloDocs(EmpresaModeloDocs $empresa_modelo_docs_json) {
        //
        $modelo = EmpresaModeloDocs::find($empresa_modelo_docs_json->id);
        if (Gate::allows('pertence-mesma-empresa', $modelo)) {
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
                                       'empresa_id' => 'nullable'
                                   ]);
    }


}
