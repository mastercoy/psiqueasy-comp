<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\User;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class EmpresaController extends Controller {

    public function index() { //afazer limpar
        //obs index_empresa
        // Auth::loginUsingId(1); 
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

    public function create() {
        //
    }

    public function store() {
        //obs criar_empresa
        $empresa_json = Empresa::create($this->validateEmpresaRequest());
    }

    public function show(Empresa $empresa_json) {
        //obs show_empresa
        // Auth::loginUsingId(1);
        $empresa = Empresa::find($empresa_json->id);
        if (Gate::allows('pertence-a-empresa', $empresa)) {
            return $empresa;
        } else {
            abort(403, 'Não encontrado!');
        }
    }

    public function edit($id) {
        //
    }

    public function update(Empresa $empresa_json) {
        //obs update_empresa
        $empresa = Empresa::find($empresa_json->id);
        if (Gate::allows('pertence-a-empresa', $empresa)) {
            $empresa_json->update($this->validateEmpresaRequest());
        } else {
            abort(403, 'Não encontrado!');
        }
    }

    public function destroy(Empresa $empresa_json) {
        //obs destroy_empresa
        $empresa = Empresa::find($empresa_json->id);
        if (Gate::allows('pertence-a-empresa', $empresa)) {
            $empresa_json->delete();
        } else {
            abort(403, 'Não encontrado!');
        }
    }

    public function desativarEmpresa(Empresa $empresa_json) {
        //obs desativar_empresa
        $empresa = Empresa::find($empresa_json->id);
        if (Gate::allows('pertence-a-empresa', $empresa)) {
            $empresa->active = false;
            $empresa->save();
        } else {
            abort(403, 'Não encontrado!');
        }
    }

    // ========================= protected

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

    protected function validateEmpresaRequest() {
        return request()->validate([
                                       'cpf_cnpj' => 'required',
                                       'logo_marca' => 'required',
                                       'active' => 'nullable',
                                       'user_id' => 'nullable'
                                   ]);
    }


}
