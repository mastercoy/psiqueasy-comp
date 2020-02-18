<?php

namespace App\Http\Controllers;


use App\Models\EmpresaCategoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class EmpresaCategoriaController extends Controller {

    public function index() {
        Auth::loginUsingId(1);
        $nomeMetodo    = 'index_cat';
        $arrayCompleto = [$nomeMetodo];

        $categorias      = EmpresaCategoria::all();
        $listaCategorias = [];

        foreach ($categorias as $categoria) {
            if ($categoria->active != 0) {
                $arrayCompleto[1] = $categoria;
                $jsonEncoder      = json_encode($arrayCompleto);
                if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
                    $listaCategorias[] = $categoria;
                }
            }

        }
        return Response::json($listaCategorias);
    }

    public function store() {
        Auth::loginUsingId(1);
        $nomeMetodo = 'criar_cat';

        if (Gate::allows('tem-permissao', $nomeMetodo)) {
            EmpresaCategoria::create($this->validateCategoriasRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function show(EmpresaCategoria $empresa_categoria_json) {
        Auth::loginUsingId(1);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           //fixme retirar - só para teste
        $categoria = EmpresaCategoria::find($empresa_categoria_json->id);

        if ($categoria->active == 0) {
            return null;
        }

        $nomeMetodo    = 'show_cat';                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   // nome do método - permissão que usuário PRECISA ter
        $arrayCompleto = [$nomeMetodo, $categoria];                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder   = json_encode($arrayCompleto);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  // precisa transformar em json pois o guard nao aceita array

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            return $categoria;
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function update(EmpresaCategoria $empresa_categoria_json) {
        Auth::loginUsingId(1);
        $categoria = EmpresaCategoria::find($empresa_categoria_json->id);

        $nomeMetodo    = 'update_cat';
        $arrayCompleto = [$nomeMetodo, $categoria];
        $jsonEncoder   = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $empresa_categoria_json->update($this->validateCategoriasRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function destroy(EmpresaCategoria $empresa_categoria_json) {
        Auth::loginUsingId(1);
        $categoria = EmpresaCategoria::find($empresa_categoria_json->id);

        $nomeMetodo    = 'destroy_cat';
        $arrayCompleto = [$nomeMetodo, $categoria];
        $jsonEncoder   = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $empresa_categoria_json->delete();
        } else {
            abort(403, 'Sem Permissão!');
        }


    }

    public function desativarCategoria(EmpresaCategoria $empresa_categoria_json) {
        Auth::loginUsingId(1);
        $categoria = EmpresaCategoria::find($empresa_categoria_json->id);

        $nomeMetodo    = 'desativar_cat';
        $arrayCompleto = [$nomeMetodo, $categoria];
        $jsonEncoder   = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $categoria->active = false;
            $categoria->save();
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    // ========================= protected

    protected function validateCategoriasRequest() {
        return request()->validate([
                                       'name' => 'required',
                                       'descricao' => 'nullable',
                                       'active' => 'nullable',
                                       'empresa_id' => 'required'

                                   ]);
    }


}
