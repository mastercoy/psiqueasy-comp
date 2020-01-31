<?php

namespace App\Http\Controllers;

use App\Models\Paciente;

class PacienteController extends Controller {

    public function index() {
        //
    }

    public function create() {
        //
    }

    public function store() {
        $paciente_json = Paciente::create($this->validatePacienteRequest());
    }

    public function show(Paciente $paciente_json) {
        return $paciente = Paciente::find($paciente_json->id);
    }

    public function edit($id) {
        //
    }

    public function update(Paciente $paciente_json) {
        $paciente_json->update($this->validatePacienteRequest());
    }

    public function destroy(Paciente $paciente_json) {
        $paciente_json->delete();
    }

    public function desativarPaciente(Paciente $paciente_json) {
        $paciente         = Paciente::find($paciente_json->id);
        $paciente->active = false;
        $paciente->save();
    }

    // ========================= protected

    protected function validatePacienteRequest() {
        return request()->validate([
                                       'name' => 'required',
                                       'data_nasc' => 'nullable',
                                       'serie' => 'nullable',
                                       'end' => 'nullable',
                                       'tel' => 'nullable',
                                       'cpf' => 'nullable',
                                       'rg' => 'nullable',
                                       'queixa' => 'nullable',
                                       'relatorio_final' => 'nullable',
                                       'encaminhamento' => 'nullable',
                                       'informe' => 'nullable',
                                       'informe_social' => 'nullable',
                                       'active' => 'nullable',
                                       'user_id' => 'nullable'
                                   ]);
    }

}
