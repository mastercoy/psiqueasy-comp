<?php

namespace App\Http\Controllers;


use App\Models\Responsavel;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class ResponsavelController extends Controller { //verificar se user->id == responsavel->user_id

    public function index() {
        //obs index_responsavel
        $responsaveis      = Responsavel::all();
        $listaResponsaveis = [];

        foreach ($responsaveis as $responsavel) {
            if (Gate::allows('pertence-usuario-logado', $responsavel)) {
                $listaResponsaveis[] = $responsavel;
            }
        }
        return Response::json($listaResponsaveis);
    }

    public function create() {
        //
    }

    public function store() {
        //obs criar_responsavel
        $responsavel_json = Responsavel::create($this->validateResponsavelRequest());

    }

    public function show(Responsavel $responsavel_json) {
        //obs show_responsavel
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
        //obs update_responsavel
        $responsavel = Responsavel::find($responsavel_json->id);
        if (Gate::allows('pertence-usuario-logado', $responsavel)) {
            $responsavel_json->update($this->validateResponsavelRequest());
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    public function destroy(Responsavel $responsavel_json) {
        //obs destroy_responsavel
        $responsavel = Responsavel::find($responsavel_json->id);
        if (Gate::allows('pertence-usuario-logado', $responsavel)) {
            $responsavel_json->delete();
        } else {
            abort(403, 'Não encontrado!');
        }
    }

    public function desativarResponsavel(Responsavel $responsavel_json) {
        //obs desativar_responsavel
        $responsavel = Responsavel::find($responsavel_json->id);
        if (Gate::allows('pertence-usuario-logado', $responsavel)) {
            $responsavel->active = false;
            $responsavel->save();
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    public function excluidosResponsavel(Responsavel $responsavel_json) {
        //obs listar_desativados_responsavel
        $user = User::find($responsavel_json->id);

        return Responsavel::where([
                                      ['user_id', '=', $user->id], // do usuário
                                      ['active', '=', 0], // desativados
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
