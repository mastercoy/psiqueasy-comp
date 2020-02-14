<?php

namespace App\Http\Controllers;

use App\Models\EmpresaCategoria;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class EmpresaCategoriaController extends Controller {

    public function index() {  //Ok
        Auth::loginUsingId(1); //fixme remover

        $nomeMetodo      = 'index_cat';                     //nome do método - permissão que usuário PRECISA ter
        $user            = Auth::user();                    // usuário é o usuário logado atualmente no sistema
        $arrayPermissoes = $this->retornaPermissoes($user); //método retorna um array com as permissões do usuário

        // joga tudo em um array, converte pra json e envia no guard
        $arrayCompleto = [$nomeMetodo, $arrayPermissoes];

        $categorias      = EmpresaCategoria::all();
        $listaCategorias = [];

        foreach ($categorias as $categoria) {
            $arrayCompleto[2] = $categoria;
            $jsonEncoder      = json_encode($arrayCompleto); //precisa transformar em json pois o guard nao aceita array
            if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
                $listaCategorias[] = $categoria;
            }
        }
        return Response::json($listaCategorias);

    }

    public function store() {
        //obs criar_cat
        Auth::loginUsingId(1); //fixme retirar

        $nomeMetodo      = 'criar_cat';                     // passa como string, o 'nome' do método, utilizado para verificar a permissão, cujo o nome é o mesmo
        $user            = Auth::user();                    // usuário é o usuário logado
        $arrayPermissoes = $this->retornaPermissoes($user); //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes];
        $jsonEncoder     = json_encode($arrayCompleto); //precisa transformar em json pois o guard nao aceita array

        if (Gate::allows('tem-permissao', $jsonEncoder)) {
            $categoria = EmpresaCategoria::create($this->validateCategoriasRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function show(EmpresaCategoria $empresa_categoria_json) {
        //obs show_cat
        $categoria = EmpresaCategoria::find($empresa_categoria_json->id);
        Auth::loginUsingId(1);//fixme retirar - só para teste

        $nomeMetodo      = 'show_cat';                                  //nome do método - permissão que usuário PRECISA ter
        $user            = Auth::user();                                // usuário é o usuário logado atualmente no sistema
        $arrayPermissoes = $this->retornaPermissoes($user);             //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $categoria]; // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            return $categoria;
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function update(EmpresaCategoria $empresa_categoria_json) {
        //obs update_cat
        Auth::loginUsingId(1);//fixme retirar - só para teste
        $categoria = EmpresaCategoria::find($empresa_categoria_json->id);

        $nomeMetodo      = 'update_cat';                                //nome do método - permissão que usuário PRECISA ter
        $user            = Auth::user();                                // usuário é o usuário logado atualmente no sistema
        $arrayPermissoes = $this->retornaPermissoes($user);             //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $categoria]; // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $empresa_categoria_json->update($this->validateCategoriasRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function destroy(EmpresaCategoria $empresa_categoria_json) {
        //obs destroy_cat
        Auth::loginUsingId(1);//fixme retirar - só para teste
        $categoria = EmpresaCategoria::find($empresa_categoria_json->id);

        $nomeMetodo      = 'destroy_cat';                                //nome do método - permissão que usuário PRECISA ter
        $user            = Auth::user();                                 // usuário é o usuário logado atualmente no sistema
        $arrayPermissoes = $this->retornaPermissoes($user);              //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $categoria];  // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $empresa_categoria_json->delete();
        } else {
            abort(403, 'Sem Permissão!');
        }


    }

    public function desativarCategoria(EmpresaCategoria $empresa_categoria_json) {
        //obs desativar_cat
        Auth::loginUsingId(1);//fixme retirar - só para teste
        $categoria = EmpresaCategoria::find($empresa_categoria_json->id);

        $nomeMetodo      = 'desativar_cat';                                //nome do método - permissão que usuário PRECISA ter
        $user            = Auth::user();                                   // usuário é o usuário logado atualmente no sistema
        $arrayPermissoes = $this->retornaPermissoes($user);                //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $categoria];    // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);

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
                                       'descricao' => 'required',
                                       'active' => 'nullable',
                                       'empresa_id' => 'required'

                                   ]);
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

}
