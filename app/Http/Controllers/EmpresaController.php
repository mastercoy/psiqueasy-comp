<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\EmpresaFilial;

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

    // =============================== CRIAR FILIAIS

    public function criarFilial() {
        $criar_filial_json = EmpresaFilial::create($this->validateFilialRequest());

    }

    public function showFilial(EmpresaFilial $empresa_filial_json) {
        return $filial = EmpresaFilial::find($empresa_filial_json->id);
    }

    public function updateFilial(EmpresaFilial $empresa_filial_json) {
        $empresa_filial_json->update($this->validateFilialRequest());

    }

    public function destruirFilial(EmpresaFilial $empresa_filial_json) {
        $empresa_filial_json->delete();
    }

    public function desativarFilial(EmpresaFilial $empresa_filial_json) {

        $filial         = EmpresaFilial::find($empresa_filial_json->id);
        $filial->active = false;
        $filial->save();
//        dd(EmpresaFilial::first());


    }


    // =========================== protected

    protected function validateModeloDocsRequest() {
        return request()->validate([
                                       'name' => 'required',
                                       'conteudo'
                                   ]);
    }

    protected function validateFilialRequest() { //fixme como pegar o id da empresa
        return request()->validate([
                                       'name' => 'required',
                                       'active' => 'nullable',
                                       'empresa_id' => 'nullable',
                                   ]);

    }

    protected function validateEmpresaRequest() {
        return request()->validate([
                                       'cpf_cnpj' => 'required',
                                       'logo_marca' => 'nullable',
                                       'active' => 'nullable',
                                       'empresa_categoria_id' => 'nullable'
                                   ]);
    }


}
