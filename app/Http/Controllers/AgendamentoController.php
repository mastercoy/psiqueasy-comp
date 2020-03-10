<?php

namespace App\Http\Controllers;


use App\Models\Atendimento;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AgendamentoController extends Controller {

    public function store(Request $request) {
        $nomeMetodo = 'criar_agendamento';

        //fixme
        $this->validate($request, [
            'status' => 'required | max: 190',
            'date' => 'date | required',
            'obs' => 'max: 190',
            'paciente_id' => 'required',
        ]);

        $atendimento         = new Atendimento;
        $atendimento->status = $request->status;
        //afazer validar a data, qual formato?
        $atendimento->data        = ($request->date) ? date('Y-m-d H:i', strtotime($request->date)) : null;
        $atendimento->obs         = $request->obs;
        $atendimento->user_id     = $request->user()->id;
        $atendimento->paciente_id = $request->paciente_id;

        $atendimento->save();

        return Atendimento::find($atendimento->id);

    }

    public function show($id) {
        $nomeMetodo = 'show_agendamento';
        $paciente   = Paciente::with('atendimentos')->find($id);

        if (Gate::denies('pertence-usuario-logado', $paciente)) {
            abort(403, 'Não encontrado!');
        }

        return response()->json($paciente);

    }

    public function update(Request $request, $id) {
        $nomeMetodo = 'update_agendamento';
        $this->validate($request, [
            'status' => 'required | max: 190',
            'date' => 'date | required',
            'obs' => 'max: 190',
            'paciente_id' => 'required',
        ]);

        $atendimento = Atendimento::find($id);

        if (Gate::denies('pertence-usuario-logado', $atendimento)) {
            abort(403, 'Não encontrado!');
        }

        $atendimento->status = $request->status;
        $atendimento->data   = ($request->date) ? date('Y-m-d H:i', strtotime($request->date)) : null;
        $atendimento->obs    = $request->obs;

        $atendimento->save();

        return Atendimento::find($id);
    }

    public function destroy($id) {
        $nomeMetodo  = 'destroy_agendamento';
        $atendimento = Atendimento::find($id);
        if (Gate::denies('pertence-usuario-logado', $atendimento)) {
            abort(403, 'Não encontrado!');
        }
        $atendimento->active = false;
        $atendimento->save();

        return $atendimento;
    }

    // ========================= protected

    protected function validateAgendamentoRequest() {
        return request()->validste([
                                       'status' => 'required | max: 190',
                                       'date' => 'date | required',
                                       'obs' => 'max: 190',
                                       'paciente_id' => 'required',
                                       'user_id' => 'required'
                                   ]);
    }

}
