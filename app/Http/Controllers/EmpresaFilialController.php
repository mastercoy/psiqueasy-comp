<?php

namespace App\Http\Controllers;

use App\Models\EmpresaFilial;
use Illuminate\Support\Facades\Gate;

class EmpresaFilialController extends Controller {

    public function index() {
        //afazer mostrar todas as filiais
    }

    public function create() {

    }

    public function store() {
        $criar_filial_json = EmpresaFilial::create($this->validateFilialRequest());
    }

    public function show(EmpresaFilial $empresa_filial_json) {
        //
        $filial = EmpresaFilial::find($empresa_filial_json->id);
        if (Gate::allows('pertence-mesma-empresa', $filial)) {
            return $filial;
        } else {
            abort(403, 'Não encontrado!');
        }
    }

    public function edit(EmpresaFilial $empresa_filial_json) {

    }

    public function update(EmpresaFilial $empresa_filial_json) {
        //
        $filial = EmpresaFilial::find($empresa_filial_json->id);
        if (Gate::allows('pertence-mesma-empresa', $filial)) {
            $empresa_filial_json->update($this->validateFilialRequest());
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    public function destroy(EmpresaFilial $empresa_filial_json) {
        //
        $filial = EmpresaFilial::find($empresa_filial_json->id);
        if (Gate::allows('pertence-mesma-empresa', $filial)) {
            $empresa_filial_json->delete();
        } else {
            abort(403, 'Não encontrado!');
        }
    }


    public function desativarFilial(EmpresaFilial $empresa_filial_json) {
        //
        $filial = EmpresaFilial::find($empresa_filial_json->id);
        if (Gate::allows('pertence-mesma-empresa', $filial)) {
            $filial->active = false;
            $filial->save();
        } else {
            abort(403, 'Não encontrado!');
        }


    }

    // ========================= protected

    protected function validateFilialRequest() {
        return request()->validate([
                                       'name' => 'required',
                                       'active' => 'nullable',
                                       'empresa_id' => 'nullable',
                                   ]);

    }
}
