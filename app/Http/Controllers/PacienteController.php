<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class PacienteController extends Controller {

    public function index() {
        //
        $paciente = Paciente::all();
        return Response::json($paciente);
    }

    public function create() {
        //
    }

    public function store() {
        $paciente_json = Paciente::create($this->validatePacienteRequest());
    }

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

    public function show(Paciente $paciente_json) {
        //
        $paciente = Paciente::find($paciente_json->id);
        if (Gate::allows('pertence-usuario-logado', $paciente)) {
            return $paciente;
        } else {
            abort(403, 'Não encontrado!');
        }
    }

    public function edit($id) {
        //
    }

    public function update(Paciente $paciente_json) {
        //
        $paciente = Paciente::find($paciente_json->id);
        if (Gate::allows('pertence-usuario-logado', $paciente)) {
            $paciente_json->update($this->validatePacienteRequest());
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    public function destroy(Paciente $paciente_json) {
        //
        $paciente = Paciente::find($paciente_json->id);
        if (Gate::allows('pertence-usuario-logado', $paciente)) {
            $paciente_json->delete();
        } else {
            abort(403, 'Não encontrado!');
        }

    }

    // ========================= protected

    public function desativarPaciente(Paciente $paciente_json) {
        //
        $paciente = Paciente::find($paciente_json->id);
        if (Gate::allows('pertence-usuario-logado', $paciente)) {
            $paciente->active = false;
            $paciente->save();
        } else {
            abort(403, 'Não encontrado!');
        }

    }

}
