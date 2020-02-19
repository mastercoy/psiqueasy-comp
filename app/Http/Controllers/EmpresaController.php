<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class EmpresaController extends Controller {

    public function index() {
        Auth::loginUsingId(1);
        $nomeMetodo    = 'index_empresa';
        $arrayCompleto = [$nomeMetodo];
        $empresas      = Empresa::where('id', auth()->user()->empresa_id)->whereActive('1');
        $listaEmpresa  = [];

        foreach ($empresas->get()->toArray() as $empresa) {
            $arrayCompleto[1] = $empresa;
            $jsonEncoder      = json_encode($arrayCompleto);
            if (Gate::allows('pertence-a-empresa-e-tem-permissao', $jsonEncoder)) {
                $listaEmpresa[] = $empresa;
            }
        }
        return Response::json($listaEmpresa);
    }

    public function store() {
        Auth::loginUsingId(1);
        $nomeMetodo = 'criar_empresa';

        if (Gate::allows('tem-permissao', $nomeMetodo)) {
            Empresa::create($this->validateEmpresaRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function show(Empresa $empresa_json) {
        Auth::loginUsingId(1);                    //fixme retirar - só para teste
        $empresa = Empresa::find($empresa_json->id);

        if ($empresa->active == 0) {
            return null;
        }

        $nomeMetodo    = 'show_empresa';                // nome do método - permissão que usuário PRECISA ter
        $arrayCompleto = [$nomeMetodo, $empresa];       // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder   = json_encode($arrayCompleto);   // precisa transformar em json pois o guard nao aceita array

        if (Gate::allows('pertence-a-empresa-e-tem-permissao', $jsonEncoder)) { //guard não aceita vários parâmetros, por isso coloquei tudo em um
            return $empresa;
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function update(Empresa $empresa_json) {
        Auth::loginUsingId(1); //fixme retirar
        $empresa = Empresa::find($empresa_json->id);

        $nomeMetodo    = 'update_empresa';
        $arrayCompleto = [$nomeMetodo, $empresa];
        $jsonEncoder   = json_encode($arrayCompleto);

        if (Gate::allows('pertence-a-empresa-e-tem-permissao', $jsonEncoder)) {
            $empresa_json->update($this->validateEmpresaRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function destroy(Empresa $empresa_json) { //Ok
        Auth::loginUsingId(1);                       //fixme retirar
        $empresa = Empresa::find($empresa_json->id);

        $nomeMetodo    = 'destroy_empresa';
        $arrayCompleto = [$nomeMetodo, $empresa];
        $jsonEncoder   = json_encode($arrayCompleto);

        if (Gate::allows('pertence-a-empresa-e-tem-permissao', $jsonEncoder)) {
            $empresa_json->delete();
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function desativarEmpresa(Empresa $empresa_json) { //Ok
        Auth::loginUsingId(1);                                //fixme retirar
        $empresa = Empresa::find($empresa_json->id);

        $nomeMetodo    = 'desativar_empresa';
        $arrayCompleto = [$nomeMetodo, $empresa];
        $jsonEncoder   = json_encode($arrayCompleto);

        if (Gate::allows('pertence-a-empresa-e-tem-permissao', $jsonEncoder)) {
            $empresa->active = false;
            $empresa->save();
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function inativosEmpresa() {
        Auth::loginUsingId(1);
        $user       = Auth::user();
        $nomeMetodo = 'listar_emp_desat';

        if (Gate::allows('tem-permissao', $nomeMetodo)) {
            return Empresa::where([['id', '=', $user->empresa_id], // do usuário
                                   ['active', '=', 0], // desativados
                                  ])->orderBy('updated_at', 'desc')->get();
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    // ========================= protected

    protected function validateEmpresaRequest() {
        return request()->validate([
                                       'cpf_cnpj' => 'required',
                                       'logo_marca' => 'required',
                                       'active' => 'nullable',
                                       'user_id' => 'required'
                                   ]);
    }


}
