<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class EmpresaController extends Controller {

    public function index() {
        Auth::loginUsingId(1); //fixme retirar

        $nomeMetodo      = 'index_empresa';
        $arrayPermissoes = $this->retornaPermissoes(); //método retorna um array com as permissões do usuário

        // joga tudo em um array, posteriormente converte pra json e envia no guard
        $arrayCompleto = [$nomeMetodo, $arrayPermissoes];

        $empresas     = Empresa::all();
        $listaEmpresa = [];

        foreach ($empresas as $empresa) {
            $arrayCompleto[2] = $empresa;
            $jsonEncoder      = json_encode($arrayCompleto); //precisa transformar em json pois o guard nao aceita array
            if (Gate::allows('pertence-a-empresa-e-tem-permissao', $jsonEncoder)) {
                $listaEmpresa[] = $empresa;
            }
        }

        return Response::json($listaEmpresa);
    }

    public function store() {
        Auth::loginUsingId(1); //fixme retirar

        $nomeMetodo      = 'criar_empresa';                 // passa como string, o 'nome' do método, utilizado para verificar a permissão, cujo o nome é o mesmo
        $arrayPermissoes = $this->retornaPermissoes();      // método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes]; // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);     // precisa transformar em json pois o guard nao aceita array

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
        $arrayPermissoes = $this->retornaPermissoes();                //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $empresa]; // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);               //precisa transformar em json pois o guard nao aceita array

        if (Gate::allows('pertence-a-empresa-e-tem-permissao', $jsonEncoder)) { //guard não aceita vários parâmetros, por isso coloquei tudo em um
            return $empresa;
        } else {
            abort(403, 'Sem Permissão!');
        }


    }

    public function update(Empresa $empresa_json) {
        Auth::loginUsingId(1); //fixme retirar
        $empresa = Empresa::find($empresa_json->id);

        $nomeMetodo      = 'update_empresa';
        $arrayPermissoes = $this->retornaPermissoes(); //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $empresa];
        $jsonEncoder     = json_encode($arrayCompleto); //precisa transformar em json pois o guard nao aceita array

        if (Gate::allows('pertence-a-empresa-e-tem-permissao', $jsonEncoder)) {
            $empresa_json->update($this->validateEmpresaRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function destroy(Empresa $empresa_json) { //Ok
        Auth::loginUsingId(1);                       //fixme retirar
        $empresa = Empresa::find($empresa_json->id);

        $nomeMetodo      = 'destroy_empresa';
        $arrayPermissoes = $this->retornaPermissoes(); //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $empresa];
        $jsonEncoder     = json_encode($arrayCompleto); //precisa transformar em json pois o guard nao aceita array

        if (Gate::allows('pertence-a-empresa-e-tem-permissao', $jsonEncoder)) {
            $empresa_json->delete();
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function desativarEmpresa(Empresa $empresa_json) { //Ok
        Auth::loginUsingId(1);                                //fixme retirar
        $empresa = Empresa::find($empresa_json->id);

        $nomeMetodo      = 'desativar_empresa';
        $arrayPermissoes = $this->retornaPermissoes(); //método retorna um array com as permissões do usuário
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

    protected function validateEmpresaRequest() {
        return request()->validate([
                                       'cpf_cnpj' => 'required',
                                       'logo_marca' => 'required',
                                       'active' => 'nullable',
                                       'user_id' => 'required'
                                   ]);
    }


}
