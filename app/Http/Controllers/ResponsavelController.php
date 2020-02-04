<?php

namespace App\Http\Controllers;


use App\Models\Responsavel;
use App\User;
use Illuminate\Support\Facades\Gate;

class ResponsavelController extends Controller {

    public function index() { //fixme
        //afazer retornar os responsaveis
        return User::find(auth()->user()->id)->responsavel()->get();
    }

    public function create() {
        //
    }

    public function store() {
        $responsavel_json = Responsavel::create($this->validateResponsavelRequest());

    }

    public function show(Responsavel $responsavel_json) {
        //
        $responsavel = Responsavel::find($responsavel_json->id);
        if (Gate::allows('pertence-usuario-logado', $responsavel)) {
            return $responsavel;
        } else {
            abort(403, 'Não encontrado!');
        }
    }

    public function edit(Responsavel $responsavel) {
        //
    }

    public function update(Responsavel $responsavel_json) {
        //
        $responsavel = Responsavel::find($responsavel_json->id);
        if (Gate::allows('pertence-usuario-logado', $responsavel)) {
            $responsavel_json->update($this->validateResponsavelRequest());
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    public function destroy(Responsavel $responsavel_json) {
        //
        $responsavel = Responsavel::find($responsavel_json->id);
        if (Gate::allows('pertence-usuario-logado', $responsavel)) {
            $responsavel_json->delete();
        } else {
            abort(403, 'Não encontrado!');
        }
    }

    public function desativarResponsavel(Responsavel $responsavel_json) {
        //
        $responsavel = Responsavel::find($responsavel_json->id);
        if (Gate::allows('pertence-usuario-logado', $responsavel)) {
            $responsavel->active = false;
            $responsavel->save();
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    public function excluidosResponsavel(Responsavel $responsavel_json) {

        $user = User::find($responsavel_json->id);

        return Responsavel::where([
                                      ['user_id', '=', $user->id], // do usuário
                                      ['active', '=', 0], // excluidos
                                  ])
                          ->orderBy('updated_at', 'desc')
                          ->get();
    }

    // =========================================== protected

    protected function validateResponsavelRequest() {
        return request()->validate([
                                       'name' => 'required',
                                       'parentesco' => 'nullable',
                                       'data_nasc' => 'nullable',
                                       'end' => 'nullable',
                                       'tel' => 'nullable',
                                       'cpf' => 'nullable',
                                       'rg' => 'nullable',
                                       'active' => 'nullable',
                                       'user_id' => 'nullable'

                                   ]);
    }


}
