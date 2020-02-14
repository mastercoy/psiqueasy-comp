<?php

namespace App\Http\Controllers;

use App\Models\EmpresaCategoria;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class EmpresaCategoriaController extends Controller {

    public function index() {  //obs verificar se user->empresa_id == objeto->empresa_id
        //afazer to aqui
        Auth::loginUsingId(1); //fixme retirar

        $nomeMetodo      = 'index_cat';
        $user            = Auth::user();                    // usuário é o usuário logado
        $arrayPermissoes = $this->retornaPermissoes($user); //método retorna um array com as permissões do usuário

        // joga tudo em um array, converte pra json e envia no guard
        $arrayCompleto = [$nomeMetodo, $arrayPermissoes];

        //fixme testar o array nesse ponto
        $categorias      = EmpresaCategoria::all();
        $listaCategorias = [];

        foreach ($categorias as $categoria) { //fixme nao ta entrando aqui
            dd('teste');
            $arrayCompleto[2] = $categoria;
            $jsonEncoder      = json_encode($arrayCompleto); //precisa transformar em json pois o guard nao aceita array
            if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) { //fixme guard
                $listaCategorias[] = $categoria;
            }
        }
        return Response::json($listaCategorias);

    }

    protected function retornaPermissoes(User $user_json) {

        $listaPermissoesUser = [];

        if (isset(User::where('id', $user_json->id)->with('perfil.permissao')->first()->toArray()['perfil'][0]['permissao'])) {
            $permissoes = User::where('id', $user_json->id)->with('perfil.permissao')->first()->toArray()['perfil'][0]['permissao'];

            foreach ($permissoes as $permissao) {
                $listaPermissoesUser[] = $permissao['name'];
            }

        } else {
            return $listaPermissoesUser;
        }

        return $listaPermissoesUser;
    }

    public function store() {
        //obs criar_cat
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
        //obs show_cat
        $categoria = EmpresaCategoria::find($empresa_categoria_json->id);
        if (Gate::allows('pertence-mesma-empresa', $categoria)) {
            return $categoria;
        } else {
            abort(403, 'Não encontrado!');
        }
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

    // ========================= protected

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

}
