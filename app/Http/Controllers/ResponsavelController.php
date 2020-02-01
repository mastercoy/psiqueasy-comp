<?php

namespace App\Http\Controllers;


use App\Responsavel;
use App\User;
use Gate;

class ResponsavelController extends Controller {

    public function index() { //fixme
        return User::find(auth()->user()->id)->responsavel()->get();
    }

    public function create() {
        //
    }

    public function store() {
        $responsavel_json = Responsavel::create($this->validateResponsavelRequest());

    }

    public function show(Responsavel $responsavel_json) {
        return $responsavel = Responsavel::find($responsavel_json->user_id);
    }

    public function edit(Responsavel $responsavel) {
        //
    }

    public function update(Responsavel $responsavel_json) {
        $responsavel_json->update($this->validateResponsavelRequest());
    }

    public function destroy(Responsavel $responsavel_json) {
        $responsavel_json->delete();
    }

    public function desativarResponsavel(Responsavel $responsavel_json) {
        $responsavel         = Responsavel::find($responsavel_json->id);
        $responsavel->active = false;
        $responsavel->save();
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
