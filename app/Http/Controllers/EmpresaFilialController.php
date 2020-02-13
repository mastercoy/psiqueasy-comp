<?php

namespace App\Http\Controllers;

use App\Models\EmpresaFilial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class EmpresaFilialController extends Controller {

    public function index() { //
        Auth::loginUsingId(1); //*
        //obs index_filial
        $filiais      = EmpresaFilial::all();
        $listaFiliais = [];

        foreach ($filiais as $filial) {
            if (Gate::allows('pertence-mesma-empresa', $filial)) {
                $listaFiliais[] = $filial;
            }
        }
        return Response::json($listaFiliais);
    }

    public function create() {

    }

    public function store() {
        //obs criar_filial
        $criar_filial_json = EmpresaFilial::create($this->validateFilialRequest());
    }

    public function show(EmpresaFilial $empresa_filial_json) {
        //obs show_filial
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
        Auth::loginUsingId(1);
        //obs update_filial
        $filial = EmpresaFilial::find($empresa_filial_json->id);
        if (Gate::allows('pertence-mesma-empresa', $filial)) {
            $empresa_filial_json->update($this->validateFilialRequest());
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    public function destroy(EmpresaFilial $empresa_filial_json) {
        //obs destroy_filial
        $filial = EmpresaFilial::find($empresa_filial_json->id);
        if (Gate::allows('pertence-mesma-empresa', $filial)) {
            $empresa_filial_json->delete();
        } else {
            abort(403, 'Não encontrado!');
        }
    }


    public function desativarFilial(EmpresaFilial $empresa_filial_json) {
        //obs desativar_filial
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
                                       'user_id' => 'nullable'
                                   ]);

    }
}
