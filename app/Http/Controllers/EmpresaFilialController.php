<?php

namespace App\Http\Controllers;

use App\Models\EmpresaFilial;

class EmpresaFilialController extends Controller {

    public function index() {

    }

    public function create() {

    }

    public function store() {
        $criar_filial_json = EmpresaFilial::create($this->validateFilialRequest());
    }

    protected function validateFilialRequest() { //fixme como pegar o id da empresa
        return request()->validate([
                                       'name' => 'required',
                                       'active' => 'nullable',
                                       'empresa_id' => 'nullable',
                                   ]);

    }

    public function show(EmpresaFilial $empresa_filial_json) {
        return $filial = EmpresaFilial::find($empresa_filial_json->id);
    }

    public function edit(EmpresaFilial $empresa_filial_json) {

    }

    public function update(EmpresaFilial $empresa_filial_json) {
        $empresa_filial_json->update($this->validateFilialRequest());
    }

    public function destroy(EmpresaFilial $empresa_filial_json) {
        $empresa_filial_json->delete();
    }

    // ========================= protected

    public function desativarFilial(EmpresaFilial $empresa_filial_json) {

        $filial         = EmpresaFilial::find($empresa_filial_json->id);
        $filial->active = false;
        $filial->save();


    }
}
