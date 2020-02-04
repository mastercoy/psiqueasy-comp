<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class EmpresaController extends Controller {

    // ========================= EMPRESA
    // ao criar, empresa->user_id == user->id
    // gate utiliza o user
    public function index() {
        //
        $empresa = Empresa::all();
        return Response::json($empresa);
    }

    public function create() {
        //
    }

    public function store() {
        $empresa_json = Empresa::create($this->validateEmpresaRequest());
    }
    //afazer testar métodos show
    public function show(Empresa $empresa_json) {
        //
        $empresa = Empresa::find($empresa_json->id);
        if (Gate::allows('pertence-usuario-logado', $empresa)) {
            return $empresa;
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    public function edit($id) {
        //
    }

    public function update(Empresa $empresa_json) {
        //
        $empresa = Empresa::find($empresa_json->id);
        if (Gate::allows('pertence-usuario-logado', $empresa)) {
            $empresa_json->update($this->validateEmpresaRequest());
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    public function destroy(Empresa $empresa_json) {
        //
        $empresa = Empresa::find($empresa_json->id);
        if (Gate::allows('pertence-usuario-logado', $empresa)) {
            $empresa_json->delete();
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    public function desativarEmpresa(Empresa $empresa_json) {
        //
        $empresa = Empresa::find($empresa_json->id);
        if (Gate::allows('pertence-usuario-logado', $empresa)) {
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
