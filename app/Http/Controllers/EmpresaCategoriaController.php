<?php

namespace App\Http\Controllers;

use App\Models\EmpresaCategoria;

class EmpresaCategoriaController extends Controller {

    public function index() {

    }

    public function create() {

    }

    public function store() {
        $categoria = EmpresaCategoria::create($this->validateCategoriasRequest());
    }

    protected function validateCategoriasRequest() {
        return request()->validate([
                                       'name' => 'required',
                                       'descricao' => 'required',
                                       'active' => 'nullable',

                                   ]);
    }

    public function show(EmpresaCategoria $empresa_categoria_json) {
        return $categoria = EmpresaCategoria::find($empresa_categoria_json->id);
    }

    public function edit(EmpresaCategoria $empresa_categoria_json) {

    }

    public function update(EmpresaCategoria $empresa_categoria_json) {
        $empresa_categoria_json->update($this->validateCategoriasRequest());
    }

    public function destroy(EmpresaCategoria $empresa_categoria_json) {
        $empresa_categoria_json->delete();
    }

    // ========================= protected

    public function desativarCategoria(EmpresaCategoria $empresa_categoria_json) {
        $categoria         = EmpresaCategoria::find($empresa_categoria_json->id);
        $categoria->active = false;
        $categoria->save();
    }
}
