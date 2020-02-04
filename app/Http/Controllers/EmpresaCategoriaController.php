<?php

namespace App\Http\Controllers;

use App\Models\EmpresaCategoria;
use Illuminate\Support\Facades\Gate;

class EmpresaCategoriaController extends Controller {

    public function index() {
        //afazer mostrar todas as categorias disponiveis
    }

    public function create() {

    }

    public function store() {
        $categoria = EmpresaCategoria::create($this->validateCategoriasRequest());
    }


    public function show(EmpresaCategoria $empresa_categoria_json) {
        //
        $categoria = EmpresaCategoria::find($empresa_categoria_json->id);
        if (Gate::allows('pertence-mesma-empresa', $categoria)) {
            return $categoria;
        } else {
            abort(403, 'Não encontrado!');
        }
    }

    public function edit(EmpresaCategoria $empresa_categoria_json) {

    }

    public function update(EmpresaCategoria $empresa_categoria_json) {
        //
        $categoria = EmpresaCategoria::find($empresa_categoria_json->id);
        if (Gate::allows('pertence-mesma-empresa', $categoria)) {
            $empresa_categoria_json->update($this->validateCategoriasRequest());
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    public function destroy(EmpresaCategoria $empresa_categoria_json) {
        //
        $categoria = EmpresaCategoria::find($empresa_categoria_json->id);
        if (Gate::allows('pertence-mesma-empresa', $categoria)) {
            $empresa_categoria_json->delete();
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    public function desativarCategoria(EmpresaCategoria $empresa_categoria_json) {
        //
        $categoria = EmpresaCategoria::find($empresa_categoria_json->id);
        if (Gate::allows('pertence-mesma-empresa', $categoria)) {
            $categoria->active = false;
            $categoria->save();
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    // ========================= protected

    protected function validateCategoriasRequest() {
        return request()->validate([
                                       'name' => 'required',
                                       'descricao' => 'required',
                                       'active' => 'nullable',

                                   ]);
    }

}
