<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\EmpresaCategoria;
use App\Models\EmpresaFilial;
use App\Models\EmpresaModeloDocs;

class EmpresaController extends Controller {

    // ========================= EMPRESA

    public function index() {
        //
    }

    public function create() {
        //
    }

    public function store() {
        $empresa_json = Empresa::create($this->validateEmpresaRequest());

        return response()->json(array('success' => true, 'last_insert_id' => $empresa_json->id), 200);

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

    public function desativarEmpresa(Empresa $empresa_json) {
        $empresa         = Empresa::find($empresa_json->id);
        $empresa->active = false;
        $empresa->save();
    }

    // ========================= MODELOS DOCS

    public function showModeloDocs(EmpresaModeloDocs $empresa_modelo_json) {
        return $modelo = EmpresaModeloDocs::find($empresa_modelo_json->id);
    }

    public function criarModeloDocs() {
        $modelo = EmpresaModeloDocs::create($this->validateModeloDocsRequest());
    }

    public function updateModeloDocs(EmpresaModeloDocs $empresa_modelo_json) {
        $empresa_modelo_json->update($this->validateModeloDocsRequest());

    }

    public function destruirModeloDocs(EmpresaModeloDocs $empresa_modelo_json) {
        $empresa_modelo_json->delete();
    }

    public function desativarModeloDocs(EmpresaModeloDocs $empresa_modelo_json) {
        $modelo         = EmpresaModeloDocs::find($empresa_modelo_json->id);
        $modelo->active = false;
        $modelo->save();
    }

    // ========================= FILIAL

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


    }

    // ========================= CATEGORIAS

    public function showCategoria(EmpresaCategoria $empresa_categoria_json) {
        return $categoria = EmpresaCategoria::find($empresa_categoria_json->id);

    }

    public function criarCategoria() {
        $categoria = EmpresaCategoria::create($this->validateCategoriasRequest());
    }

    public function updateCategoria(EmpresaCategoria $empresa_categoria_json) {
        $empresa_categoria_json->update($this->validateCategoriasRequest());
    }

    public function destruirCategoria(EmpresaCategoria $empresa_categoria_json) {
        $empresa_categoria_json->delete();
    }

    public function desativarCategoria(EmpresaCategoria $empresa_categoria_json) {
        $categoria         = EmpresaCategoria::find($empresa_categoria_json->id);
        $categoria->active = false;
        $categoria->save();
    }

    // ========================= protected

    protected function validateCategoriasRequest() {
        return request()->validate([
                                       'name' => 'required',
                                       'descricao' => 'required',
                                       'active' => 'nullable',

                                   ]);
    }

    protected function validateModeloDocsRequest() {
        return request()->validate([
                                       'name' => 'required',
                                       'conteudo' => 'nullable',
                                       'active' => 'nullable',
                                       'empresa_id' => 'nullable'
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
                                       'logo_marca' => 'required',
                                       'active' => 'nullable',
                                       'empresa_categoria_id' => 'nullable'
                                   ]);
    }


}
