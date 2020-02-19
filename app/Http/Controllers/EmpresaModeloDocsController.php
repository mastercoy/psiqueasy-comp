<?php

namespace App\Http\Controllers;

use App\Models\EmpresaModeloDocs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class EmpresaModeloDocsController extends Controller {

    public function index() {
        Auth::loginUsingId(1);
        $nomeMetodo    = 'index_emp_model';
        $arrayCompleto = [$nomeMetodo];
        $modelos       = EmpresaModeloDocs::where('empresa_id', auth()->user()->empresa_id)->whereActive('1');
        $listaModelos  = [];

        foreach ($modelos->get()->toArray() as $modelo) {
            $arrayCompleto[1] = $modelo;
            $jsonEncoder      = json_encode($arrayCompleto);
            if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
                $listaModelos[] = $modelo;

            }

        }
        return Response::json($listaModelos);
    }

    public function store() {
        Auth::loginUsingId(1);
        $nomeMetodo = 'criar_emp_model';

        if (Gate::allows('tem-permissao', $nomeMetodo)) {
            EmpresaModeloDocs::create($this->validateModeloDocsRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function show(EmpresaModeloDocs $empresa_modelo_docs_json) {
        Auth::loginUsingId(1);
        $modelo = EmpresaModeloDocs::find($empresa_modelo_docs_json->id);

        if ($modelo->active == 0) {
            return null;
        }

        $nomeMetodo    = 'show_emp_model';
        $arrayCompleto = [$nomeMetodo, $modelo];
        $jsonEncoder   = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            return $modelo;
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function update(EmpresaModeloDocs $empresa_modelo_docs_json) {
        Auth::loginUsingId(1);
        $modelo = EmpresaModeloDocs::find($empresa_modelo_docs_json->id);

        $nomeMetodo    = 'update_emp_model';
        $arrayCompleto = [$nomeMetodo, $modelo];
        $jsonEncoder   = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $empresa_modelo_docs_json->update($this->validateModeloDocsRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function destroy(EmpresaModeloDocs $empresa_modelo_docs_json) {
        Auth::loginUsingId(1);
        $modelo        = EmpresaModeloDocs::find($empresa_modelo_docs_json->id);
        $nomeMetodo    = 'destroy_emp_model';
        $arrayCompleto = [$nomeMetodo, $modelo];
        $jsonEncoder   = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $empresa_modelo_docs_json->delete();
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function desativarModeloDocs(EmpresaModeloDocs $empresa_modelo_docs_json) {
        Auth::loginUsingId(1);
        $modelo = EmpresaModeloDocs::find($empresa_modelo_docs_json->id);

        $nomeMetodo    = 'desativar_emp_model';
        $arrayCompleto = [$nomeMetodo, $modelo];
        $jsonEncoder   = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $modelo->active = false;
            $modelo->save();
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function inativosModelEmp() {
        Auth::loginUsingId(1);
        $user       = Auth::user();
        $nomeMetodo = 'listar_emp_model_desat';

        if (Gate::allows('tem-permissao', $nomeMetodo)) {
            return EmpresaModeloDocs::where([['empresa_id', '=', $user->empresa_id], // do usuário
                                             ['active', '=', 0], // desativados
                                            ])->orderBy('updated_at', 'desc')->get();
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
                                       'empresa_id' => 'required'
                                   ]);
    }


}
