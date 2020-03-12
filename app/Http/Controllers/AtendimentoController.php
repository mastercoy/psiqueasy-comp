<?php

namespace App\Http\Controllers;


use App\Models\Atendimento;
use App\Models\Paciente;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AtendimentoController extends Controller {

    public function store() {
        //obs formato da data é ANO-MES-DIA HORA:MINUTO
        Auth::loginUsingId(1); //fixme
        $nomeMetodo = 'criar_atendimento';

        if (Gate::allows('tem-permissao', $nomeMetodo)) {
            return Atendimento::create($this->validateAgendamentoRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function show($id) {
        Auth::loginUsingId(1);
        $paciente = Paciente::with('atendimentos')->find($id);

        $nomeMetodo = 'show_atendimento';

        if (Gate::allows('tem-permissao', $nomeMetodo)) {
            return response()->json($paciente);
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function update(Request $request, $id) {
        //obs formato da data é ANO-MES-DIA HORA:MINUTO
        Auth::loginUsingId(1);
        $atendimento = Atendimento::find($id);
        $nomeMetodo  = 'update_atendimento';

        if (Gate::allows('tem-permissao', $nomeMetodo)) {
            $atendimento->update($this->validateAgendamentoRequest());
            return $atendimento;
        } else {
            abort(403, 'Sem Permissão!');
        }


    }

    public function desativarAtendimento($id) { //fixme talvez trocar o gate
        Auth::loginUsingId(1);
        $atendimento = Atendimento::find($id);
        $nomeMetodo  = 'desativar_atendimento';

        if (Gate::denies('tem-permissao', $nomeMetodo)) {
            abort(403, 'Sem Permissão!');
        }

        $atendimento->active = false;
        $atendimento->save();

        return $atendimento;
    }

    public function buscarAtendimento(Request $request) {
        //teste
        $nomeMetodo = 'buscar_atendimento';

        if (Gate::denies('tem-permissao', $nomeMetodo)) {
            abort(403, 'Sem Permissão!');
        }

        $dataInicial = ($request->inicio) ? date('Y-m-d', strtotime($request->inicio)) : null;
        $dataFinal   = ($request->fim) ? date('Y-m-d', strtotime($request->fim)) : null;

        $usuario = User::find($request->toArray()['user_id']);

        if ($request->status == 'todos') {
            $atendimentos = Atendimento::where([
                                                   ['user_id', $usuario->id],
                                                   ['active', 1],
                                               ])
                                       ->whereBetween('data', [$dataInicial, $dataFinal]) //buscar por data
                                       ->orderBy('data', 'asc')
                                       ->get();

        } else {
            $atendimentos = Atendimento::where([
                                                   ['user_id', $usuario->id],
                                                   ['active', 1],
                                                   ['status', $request->status],
                                               ])
                                       ->whereBetween('data', [$dataInicial, $dataFinal]) //buscar por data
                                       ->orderBy('data', 'asc')
                                       ->get();
        }
        foreach ($atendimentos as $atendimento) {
            $atendimento->paciente = Paciente::find($atendimento->paciente_id);
        }

        return $atendimentos;

    }

    // ========================= protected

    protected function validateAgendamentoRequest() {
        return request()->validate([
                                       'status' => 'required | max: 190',
                                       'data' => 'required|date_format:"Y-m-d H:i"',
                                       'obs' => 'max: 190',
                                       'paciente_id' => 'required',
                                       'user_id' => 'required',
                                       'resultado' => 'nullable',
                                       'procedimento' => 'nullable',
                                   ]);
    }

}
