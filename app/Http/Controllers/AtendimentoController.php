<?php

namespace App\Http\Controllers;


use App\Models\Atendimento;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AtendimentoController extends Controller {

    public function store(Request $request) {
        Auth::loginUsingId(1); //fixme
        $nomeMetodo = 'criar_atendimento';

        if (Gate::denies('tem-permissao', $nomeMetodo)) {
            abort(403, 'Sem Permissão!');
        }

        $this->validate($request, [
            'status' => 'required | max: 190',
            'date' => 'date | required',
            'obs' => 'max: 190',
            'paciente_id' => 'required',
            'user_id' => 'required',
        ]);

        $atendimento               = new Atendimento;
        $atendimento->status       = $request->status;
        $atendimento->data         = ($request->date) ? date('Y-m-d H:i', strtotime($request->date)) : null;
        $atendimento->obs          = $request->obs;
        $atendimento->user_id      = $request->user()->id;
        $atendimento->paciente_id  = $request->paciente_id;
        $atendimento->resultado    = $request->resultado;
        $atendimento->procedimento = $request->procedimento;

        $atendimento->save();

        return Atendimento::find($atendimento->id);

    }

    public function show($id) {
        Auth::loginUsingId(1);
        $paciente = Paciente::with('atendimentos')->find($id);

        $nomeMetodo    = 'show_atendimento';             // nome do método - permissão que usuário PRECISA ter
        $arrayCompleto = [$nomeMetodo, $paciente];       // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder   = json_encode($arrayCompleto);    // precisa transformar em json pois o guard nao aceita array

        if (Gate::allows('pertence-usuario-logado-e-tem-permissao', $jsonEncoder)) {
            return response()->json($paciente);
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function update(Request $request, $id) {
        Auth::loginUsingId(1);
        $atendimento = Atendimento::find($id);

        $this->validate($request, [
            'status' => 'required | max: 190',
            'date' => 'date | required',
            'obs' => 'max: 190',
            'paciente_id' => 'required',
        ]);

        $nomeMetodo    = 'update_atendimento';
        $arrayCompleto = [$nomeMetodo, $atendimento];
        $jsonEncoder   = json_encode($arrayCompleto);

        if (Gate::denies('pertence-usuario-logado-e-tem-permissao', $jsonEncoder)) {
            abort(403, 'Não encontrado!');
        }

        $atendimento->status = $request->status;
        $atendimento->data   = ($request->date) ? date('Y-m-d H:i', strtotime($request->date)) : null;
        $atendimento->obs    = $request->obs;

        $atendimento->save();
        return Atendimento::find($id);

    }

    public function desativarAtendimento($id) {
        Auth::loginUsingId(1);
        $atendimento = Atendimento::find($id);

        $nomeMetodo    = 'desativar_atendimento';
        $arrayCompleto = [$nomeMetodo, $atendimento];
        $jsonEncoder   = json_encode($arrayCompleto);

        if (Gate::denies('pertence-usuario-logado-e-tem-permissao', $jsonEncoder)) {
            abort(403, 'Sem Permissão!');
        }

        $atendimento->active = false;
        $atendimento->save();

        return $atendimento;
    }

    public function buscarAtendimento(Request $request) {
        $nomeMetodo = 'buscar_atendimento';

        $dataInicial = ($request->dataInicial) ? date('Y-m-d 00:00', strtotime($request->dataInicial)) : null;
        $dataFinal   = ($request->dataFinal) ? date('Y-m-d 23:59', strtotime($request->dataFinal)) : null;

        $user = $request->user();
        //todos
        if ($request->status == 'Todos') {
            $atendimentos = Atendimento::where([
                                                   ['user_id', $user->id],
                                                   ['active', 1],
                                               ])
                                       ->whereBetween('data', [$dataInicial, $dataFinal]) //buscar por data
                                       ->orderBy('data', 'asc')
                                       ->get();

        } else {
            $atendimentos = Atendimento::where([
                                                   ['user_id', $user->id],
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
                                       'date' => 'date | required',
                                       'obs' => 'max: 190',
                                       'paciente_id' => 'required',
                                       'user_id' => 'required'
                                   ]);
    }

}
