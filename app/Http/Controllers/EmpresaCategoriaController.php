<?php

namespace App\Http\Controllers;

use App\Models\EmpresaCategoria;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class EmpresaCategoriaController extends Controller {

    public function index() { //obs verificar se user->empresa_id == objeto->empresa_id
        //obs index_cat
        $categorias      = EmpresaCategoria::all();
        $listaCategorias = [];

        foreach ($categorias as $categoria) {
            if (Gate::allows('pertence-mesma-empresa', $categoria)) {
                $listaCategorias[] = $categoria;
            }
        }
        return Response::json($listaCategorias);

    }

    public function create() {

    }

    public function store() {
        //obs criar_cat
        $categoria = EmpresaCategoria::create($this->validateCategoriasRequest());
    }


    public function show(EmpresaCategoria $empresa_categoria_json) {
        //obs show_cat
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
        //obs update_cat
        $categoria = EmpresaCategoria::find($empresa_categoria_json->id);
        if (Gate::allows('pertence-mesma-empresa', $categoria)) {
            $empresa_categoria_json->update($this->validateCategoriasRequest());
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    public function destroy(EmpresaCategoria $empresa_categoria_json) {
        //obs destroy_cat
        $categoria = EmpresaCategoria::find($empresa_categoria_json->id);
        if (Gate::allows('pertence-mesma-empresa', $categoria)) {
            $empresa_categoria_json->delete();
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    public function desativarCategoria(EmpresaCategoria $empresa_categoria_json) {
        //obs desativar_cat
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
