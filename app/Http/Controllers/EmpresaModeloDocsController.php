<?php

namespace App\Http\Controllers;

use App\Models\EmpresaModeloDocs;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class EmpresaModeloDocsController extends Controller {

    public function index() {
        Auth::loginUsingId(1); //fixme remover

        $nomeMetodo      = 'index_emp_model';                     //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();            //método retorna um array com as permissões do usuário

        // joga tudo em um array, converte pra json e envia no guard
        $arrayCompleto = [$nomeMetodo, $arrayPermissoes];

        $modelos      = EmpresaModeloDocs::all();
        $listaModelos = [];

        foreach ($modelos as $modelo) {
            if ($modelo->active != 0) {
                $arrayCompleto[2] = $modelo;
                $jsonEncoder      = json_encode($arrayCompleto); //precisa transformar em json pois o guard nao aceita array
                if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
                    $listaModelos[] = $modelo;
                }
            }

        }
        return Response::json($listaModelos);
    }

    public function store() {
        //obs criar_emp_model
        Auth::loginUsingId(1); //fixme retirar

        $nomeMetodo      = 'criar_emp_model';                     // passa como string, o 'nome' do método, utilizado para verificar a permissão, cujo o nome é o mesmo
        $arrayPermissoes = $this->retornaPermissoes();            //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes];
        $jsonEncoder     = json_encode($arrayCompleto); //precisa transformar em json pois o guard nao aceita array

        if (Gate::allows('tem-permissao', $jsonEncoder)) {
            $modelo = EmpresaModeloDocs::create($this->validateModeloDocsRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function show(EmpresaModeloDocs $empresa_modelo_docs_json) {
        Auth::loginUsingId(1);//fixme retirar - só para teste
        $modelo = EmpresaModeloDocs::find($empresa_modelo_docs_json->id);

        if ($modelo->active == 0) {
            return null;
        }

        $nomeMetodo      = 'show_emp_model';                                  //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();                        //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $modelo];          // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);


        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            return $modelo;
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function update(EmpresaModeloDocs $empresa_modelo_docs_json) {
        Auth::loginUsingId(1);
        $modelo = EmpresaModeloDocs::find($empresa_modelo_docs_json->id);

        $nomeMetodo      = 'update_emp_model';                                //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();                        //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $modelo];          // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);


        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $empresa_modelo_docs_json->update($this->validateModeloDocsRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function destroy(EmpresaModeloDocs $empresa_modelo_docs_json) {
        //obs destroy_emp_model
        Auth::loginUsingId(1);//fixme retirar - só para teste
        $modelo = EmpresaModeloDocs::find($empresa_modelo_docs_json->id);

        $nomeMetodo      = 'destroy_emp_model';                                //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();                         //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $modelo];           // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $empresa_modelo_docs_json->delete();
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function desativarModeloDocs(EmpresaModeloDocs $empresa_modelo_docs_json) {
        Auth::loginUsingId(1);//fixme retirar - só para teste
        $modelo = EmpresaModeloDocs::find($empresa_modelo_docs_json->id);

        $nomeMetodo      = 'desativar_emp_model';                                //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();                           //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $modelo];             // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $modelo->active = false;
            $modelo->save();
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    // ========================= protected

    protected function validateModeloDocsRequest() {
        return request()->validate([
                                       'name' => 'required',
                                       'conteudo' => 'nullable',
                                       'active' => 'nullable',
                                       'empresa_id' => 'nullable' //fixme talvez pegar Auth:user()->empresa_id
                                   ]);
    }

    protected function retornaPermissoes() {
        $user                = Auth::user();
        $listaPermissoesUser = [];

        if (isset(User::where('id', $user->id)->with('perfil.permissao')->first()->toArray()['perfil'][0]['permissao'])) {
            $permissoes = User::where('id', $user->id)->with('perfil.permissao')->first()->toArray()['perfil'][0]['permissao'];

            foreach ($permissoes as $permissao) {
                $listaPermissoesUser[] = $permissao['name'];
            }
        } else {
            return $listaPermissoesUser;
        }
        return $listaPermissoesUser;
    }

}
