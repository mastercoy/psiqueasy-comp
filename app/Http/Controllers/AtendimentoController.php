<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Paciente;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AtendimentoController extends Controller {

    public function index() {
        $nomeMetodo   = 'index_atendimento';
        $atendimentos = User::find(auth()->user()->id)->atendimentosHoje()->get();
        foreach ($atendimentos as $atendimento) {
            $atendimento->paciente = Paciente::find($atendimento->paciente_id);
        }
        return $atendimentos;
    }

    public function store(Request $request) {
        $nomeMetodo = 'criar_atendimento';
        $this->validate($request, [
            'status' => 'required | max: 190',
            'data' => 'date | nullable',
            'obs' => 'max: 190',
            'paciente_id' => 'required',
        ]);

        $atendimento               = new Atendimento;
        $atendimento->status       = $request->status;
        $atendimento->data         = ($request->data) ? date('Y-m-d H:i', strtotime($request->data)) : null;
        $atendimento->obs          = $request->obs;
        $atendimento->user_id      = $request->user()->id;
        $atendimento->paciente_id  = $request->paciente_id;
        $atendimento->teste_id     = $request->teste_id;
        $atendimento->resultado    = $request->resultado;
        $atendimento->procedimento = $request->procedimento;

        $atendimento->save();

        return Atendimento::find($atendimento->id);

    }

    public function show($id) {
        $nomeMetodo  = 'show_atendimento';
        $atendimento = Atendimento::find($id);
        if (Gate::denies('pertence-usuario-logado', $atendimento)) {
            abort(403, 'Não encontrado!');
        }
        $atendimento->paciente = Paciente::find($atendimento->paciente_id);

        return $atendimento;
    }

    public function update(Request $request, $id) {
        $nomeMetodo = 'update_atendimento';
        $this->validate($request, [
            'status' => 'required | max: 190',
            'data' => 'date | nullable',
            'obs' => 'max: 190',
            'paciente_id' => 'required',
        ]);

        $atendimento = Atendimento::find($id);
        if (Gate::denies('pertence-usuario-logado', $atendimento)) {
            abort(403, 'Não encontrado!');
        }
        $atendimento->status       = $request->status;
        $atendimento->data         = ($request->data) ? date('Y-m-d H:i', strtotime($request->data)) : null;
        $atendimento->obs          = $request->obs;
        $atendimento->user_id      = $request->user()->id;
        $atendimento->paciente_id  = $request->paciente_id;
        $atendimento->teste_id     = $request->teste_id;
        $atendimento->resultado    = $request->resultado;
        $atendimento->procedimento = $request->procedimento;

        $atendimento->save();

        return Atendimento::find($id);
    }

    public function destroy($id) {
        $nomeMetodo  = 'destroy_atendimento';
        $atendimento = Atendimento::find($id);
        if (Gate::denies('pertence-usuario-logado', $atendimento)) {
            abort(403, 'Não encontrado!');
        }
        $atendimento->active = false;
        $atendimento->save();

        return $atendimento;
    }

    public function buscar(Request $request) {
        $nomeMetodo = 'buscar_atendimento';
        $de         = ($request->de) ? date('Y-m-d 00:00', strtotime($request->de)) : null;
        $ate        = ($request->ate) ? date('Y-m-d 23:59', strtotime($request->ate)) : null;

        $user = $request->user();
        //todos
        if ($request->status == 'Todos') {
            $atendimentos = Atendimento::where([
                                                   ['user_id', $user->id],
                                                   ['active', 1],
                                               ])
                                       ->whereBetween('data', [$de, $ate]) //buscar por data
                                       ->orderBy('data', 'asc')
                                       ->get();

        } else {
            $atendimentos = Atendimento::where([
                                                   ['user_id', $user->id],
                                                   ['active', 1],
                                                   ['status', $request->status],
                                               ])
                                       ->whereBetween('data', [$de, $ate]) //buscar por data
                                       ->orderBy('data', 'asc')
                                       ->get();
        }
        foreach ($atendimentos as $atendimento) {
            $atendimento->paciente = Paciente::find($atendimento->paciente_id);
        }

        return $atendimentos;

    }

    // public function cencelados(Request $request)
    // {
    //
    //     $atendimentos = Atendimento::where([
    //         ['user_id', '=', auth()->user()->id ], //pacientes do usuário
    //         ['active', '=', 0], // excluidos
    //       ])
    //       ->orderBy('updated_at','desc')
    //       ->get();
    //
    // }
}
