<?php

namespace App\Http\Controllers;

use App\Models\EmpresaModeloDocs;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class EmpresaModeloDocsController extends Controller {

    public function index() { //verificar se user->empresa_id = objeto->empresa_id
        //obs index_emp_model
        $modelos      = EmpresaModeloDocs::all();
        $listaModelos = [];

        foreach ($modelos as $modelo) {
            if (Gate::allows('pertence-mesma-empresa', $modelo)) {
                $listaModelos[] = $modelo;
            }
        }
        return Response::json($listaModelos);
    }

    public function create() {
        //
    }

    public function store() {
        //obs criar_emp_model
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
        //obs show_emp_model
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
        //obs update_emp_model
        $modelo = EmpresaModeloDocs::find($empresa_modelo_docs_json->id);
        if (Gate::allows('pertence-mesma-empresa', $modelo)) {
            $empresa_modelo_docs_json->update($this->validateModeloDocsRequest());
        } else {
            abort(403, 'Não encontrado!');
        }
    }

    public function destroy(EmpresaModeloDocs $empresa_modelo_docs_json) {
        //obs destroy_emp_model
        $modelo = EmpresaModeloDocs::find($empresa_modelo_docs_json->id);
        if (Gate::allows('pertence-mesma-empresa', $modelo)) {
            $empresa_modelo_docs_json->delete();
        } else {
            abort(403, 'Não encontrado!');
        }
    }

    // ========================= protected

    public function desativarModeloDocs(EmpresaModeloDocs $empresa_modelo_docs_json) {
        //obs desativar_emp_model
        $modelo = EmpresaModeloDocs::find($empresa_modelo_docs_json->id);
        if (Gate::allows('pertence-mesma-empresa', $modelo)) {
            $modelo->active = false;
            $modelo->save();
        } else {
            abort(403, 'Não encontrado!');
        }

    }


}
