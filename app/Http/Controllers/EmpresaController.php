<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class EmpresaController extends Controller {

    public function index() {//Ok //afazer limpar
        //obs index_empresa

        Auth::loginUsingId(1); //fixme retirar

        $nomeMetodo      = 'index_empresa';
        $user            = Auth::user();                    // usuário é o usuário logado
        $arrayPermissoes = $this->retornaPermissoes($user); //método retorna um array com as permissões do usuário

        // joga tudo em um array, posteriormente converte pra json e envia no guard
        $arrayCompleto = [$nomeMetodo, $arrayPermissoes];

        $empresas     = Empresa::all();
        $listaEmpresa = [];
        //obs executar query no usuario where com as condições

        foreach ($empresas as $empresa) {
            $arrayCompleto[2] = $empresa;
            $jsonEncoder      = json_encode($arrayCompleto); //precisa transformar em json pois o guard nao aceita array
            if (Gate::allows('pertence-a-empresa-e-tem-permissao', $jsonEncoder)) {
                $listaEmpresa[] = $empresa;
            }
        }

        return Response::json($listaEmpresa);
    }

    public function store() {  //Ok
        //obs criar_empresa
        Auth::loginUsingId(1); //fixme retirar

        $nomeMetodo      = 'criar_empresa';                 // passa como string, o 'nome' do método, utilizado para verificar a permissão, cujo o nome é o mesmo
        $user            = Auth::user();                    // usuário é o usuário logado
        $arrayPermissoes = $this->retornaPermissoes($user); //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes];
        $jsonEncoder     = json_encode($arrayCompleto); //precisa transformar em json pois o guard nao aceita array

        if (Gate::allows('tem-permissao', $jsonEncoder)) {
            $empresa_json = Empresa::create($this->validateEmpresaRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function show(Empresa $empresa_json) {

        Auth::loginUsingId(1);                    //fixme retirar - só para teste
        $empresa = Empresa::find($empresa_json->id);

        $nomeMetodo      = 'show_empresa';                            //nome do método - permissão que usuário PRECISA ter
        $user            = Auth::user();                              // usuário é o usuário logado atualmente no sistema
        $arrayPermissoes = $this->retornaPermissoes($user);           //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $empresa]; // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);               //precisa transformar em json pois o guard nao aceita array

        if (Gate::allows('pertence-a-empresa-e-tem-permissao', $jsonEncoder)) { //guard não aceita vários parâmetros, por isso coloquei tudo em um
            return $empresa;
        } else {
            abort(403, 'Sem Permissão!');
        }


    }

    public function update(Empresa $empresa_json) {
        //obs update_empresa
        Auth::loginUsingId(1); //fixme retirar
        $empresa = Empresa::find($empresa_json->id);

        $nomeMetodo      = 'update_empresa';
        $user            = Auth::user();                    // usuário é o usuário logado
        $arrayPermissoes = $this->retornaPermissoes($user); //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $empresa];
        $jsonEncoder     = json_encode($arrayCompleto); //precisa transformar em json pois o guard nao aceita array

        if (Gate::allows('pertence-a-empresa-e-tem-permissao', $jsonEncoder)) {
            $empresa_json->update($this->validateEmpresaRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function destroy(Empresa $empresa_json) { //Ok
        //obs destroy_empresa
        Auth::loginUsingId(1);                       //fixme retirar
        $empresa = Empresa::find($empresa_json->id);

        $nomeMetodo      = 'destroy_empresa';
        $user            = Auth::user();                    // usuário é o usuário logado
        $arrayPermissoes = $this->retornaPermissoes($user); //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $empresa];
        $jsonEncoder     = json_encode($arrayCompleto); //precisa transformar em json pois o guard nao aceita array

        if (Gate::allows('pertence-a-empresa-e-tem-permissao', $jsonEncoder)) {
            $empresa_json->delete();
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function desativarEmpresa(Empresa $empresa_json) { //Ok
        //obs desativar_empresa
        Auth::loginUsingId(1);                                //fixme retirar
        $empresa = Empresa::find($empresa_json->id);

        $nomeMetodo      = 'desativar_empresa';
        $user            = Auth::user();                    // usuário é o usuário logado
        $arrayPermissoes = $this->retornaPermissoes($user); //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $empresa];
        $jsonEncoder     = json_encode($arrayCompleto); //precisa transformar em json pois o guard nao aceita array

        if (Gate::allows('pertence-a-empresa-e-tem-permissao', $jsonEncoder)) {
            $empresa->active = false;
            $empresa->save();
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    // ========================= protected

    protected function retornaPermissoes(User $user_json) { // recebe um usuário e retorna um array com as diversas permissões dele

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

    protected function validateEmpresaRequest() {
        return request()->validate([
                                       'cpf_cnpj' => 'required',
                                       'logo_marca' => 'required',
                                       'active' => 'nullable',
                                       'user_id' => 'nullable'
                                   ]);
    }


}
