<?php

namespace App\Http\Controllers;

use App\Models\Empresa;

class EmpresaController extends Controller {

    public function index() {
        //
    }

    public function create() {
        //
    }

    public function store() {
        $empresa_json = Empresa::create($this->validateEmpresaRequest());
    }

    protected function validateEmpresaRequest() {
        return request()->validate([
                                       'cpf_cnpj' => 'required',
                                       'logo_marca' => 'nullable',
                                       'active' => 'nullable',
                                       'empresa_categoria_id' => 'nullable'
                                   ]);
    }

    public function show(Empresa $empresa_json) {
        return $empresa = Empresa::find($empresa_json->id);
    }

    public function edit($id) {
        //
    }

    public function update(Empresa $empresa_json) {
        $empresa_json->update($this->validateEmpresaRequest());
    }

    public function destroy(Empresa $empresa_json) {
        $empresa_json->delete();
    }
}
