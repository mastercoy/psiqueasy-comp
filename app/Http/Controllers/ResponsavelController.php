<?php

namespace App\Http\Controllers;


use App\Models\Responsavel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class ResponsavelController extends Controller {

    public function index() {
        Auth::loginUsingId(1);

        $nomeMetodo    = 'index_responsavel';
        $arrayCompleto = [$nomeMetodo];

        $responsaveis      = Responsavel::where('user_id', auth()->user()->id)->whereActive('1');
        $listaResponsaveis = [];

        foreach ($responsaveis->get()->toArray() as $responsavel) {
            $arrayCompleto[1] = $responsavel;
            $jsonEncoder      = json_encode($arrayCompleto);
            if (Gate::allows('pertence-usuario-logado-e-tem-permissao', $jsonEncoder)) {
                $listaResponsaveis[] = $responsavel;
            }

        }
        return Response::json($listaResponsaveis);
    }

    public function store() {
        Auth::loginUsingId(1);
        $nomeMetodo = 'criar_responsavel';

        if (Gate::allows('tem-permissao', $nomeMetodo)) {
            $responsavel_json = Responsavel::create($this->validateResponsavelRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function show(Responsavel $responsavel_json) {
        Auth::loginUsingId(1);
        $responsavel = Responsavel::find($responsavel_json->id);

        if ($responsavel->active == 0) {
            return null;
        }

        $nomeMetodo    = 'show_responsavel';
        $arrayCompleto = [$nomeMetodo, $responsavel];
        $jsonEncoder   = json_encode($arrayCompleto);

        if (Gate::allows('pertence-usuario-logado-e-tem-permissao', $jsonEncoder)) {
            return $responsavel;
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function update(Responsavel $responsavel_json) {
        Auth::loginUsingId(1);
        $responsavel = Responsavel::find($responsavel_json->id);

        $nomeMetodo    = 'update_responsavel';
        $arrayCompleto = [$nomeMetodo, $responsavel];
        $jsonEncoder   = json_encode($arrayCompleto);

        if (Gate::allows('pertence-usuario-logado-e-tem-permissao', $jsonEncoder)) {
            $responsavel_json->update($this->validateResponsavelRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function destroy(Responsavel $responsavel_json) {
        Auth::loginUsingId(1);
        $responsavel = Responsavel::find($responsavel_json->id);

        $nomeMetodo    = 'destroy_responsavel';
        $arrayCompleto = [$nomeMetodo, $responsavel];
        $jsonEncoder   = json_encode($arrayCompleto);

        if (Gate::allows('pertence-usuario-logado-e-tem-permissao', $jsonEncoder)) {
            $responsavel_json->delete();
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function desativarResponsavel(Responsavel $responsavel_json) {
        Auth::loginUsingId(1);
        $responsavel = Responsavel::find($responsavel_json->id);

        $nomeMetodo    = 'desativar_responsavel';
        $arrayCompleto = [$nomeMetodo, $responsavel];
        $jsonEncoder   = json_encode($arrayCompleto);

        if (Gate::allows('pertence-usuario-logado-e-tem-permissao', $jsonEncoder)) {
            $responsavel->active = false;
            $responsavel->save();
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function inativosResponsavel() {
        Auth::loginUsingId(1);
        $user = Auth::user();

        $nomeMetodo = 'listar_resp_desat';

        if (Gate::allows('tem-permissao', $nomeMetodo)) {
            return Responsavel::where([['user_id', '=', $user->id], // do usuário
                                       ['active', '=', 0], // desativados
                                      ])->orderBy('updated_at', 'desc')->get();
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    // =========================================== protected

    protected function validateResponsavelRequest() {
        return request()->validate(['name' => 'required', 'parentesco' => 'nullable', 'data_nasc' => 'nullable', 'end' => 'nullable', 'tel' => 'nullable', 'cpf' => 'nullable', 'rg' => 'nullable', 'active' => 'nullable', 'user_id' => 'required'

                                   ]);
    }


}
