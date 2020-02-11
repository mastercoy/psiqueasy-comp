<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class EmpresaController extends Controller {

    public function index() {
        //obs index_empresa
        $empresas     = Empresa::all();
        $listaEmpresa = [];

        foreach ($empresas as $empresa) {
            if (Gate::allows('pertence-a-empresa', $empresa)) {
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
        Auth::user();
        $empresa = Empresa::find($empresa_json->id);
        //dd(Auth::user());
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

    protected function validateEmpresaRequest() {
        return request()->validate([
                                       'cpf_cnpj' => 'required',
                                       'logo_marca' => 'required',
                                       'active' => 'nullable',
                                       'user_id' => 'nullable'
                                   ]);
    }


}
