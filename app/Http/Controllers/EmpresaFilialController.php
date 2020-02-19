<?php

namespace App\Http\Controllers;

use App\Models\EmpresaFilial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class EmpresaFilialController extends Controller {

    public function index() {
        Auth::loginUsingId(1);
        $nomeMetodo    = 'index_filial';
        $arrayCompleto = [$nomeMetodo];
        $filiais       = EmpresaFilial::where('empresa_id', auth()->user()->empresa_id)->whereActive('1');
        $listaFiliais  = [];

        foreach ($filiais->get()->toArray() as $filial) {
            $arrayCompleto[1] = $filial;
            $jsonEncoder      = json_encode($arrayCompleto);
            if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
                $listaFiliais[] = $filial;
            }
        }
        return Response::json($listaFiliais);
    }

    public function store() {
        Auth::loginUsingId(1);
        $nomeMetodo = 'criar_filial';

        if (Gate::allows('tem-permissao', $nomeMetodo)) {
            EmpresaFilial::create($this->validateFilialRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function show(EmpresaFilial $empresa_filial_json) {
        Auth::loginUsingId(1);
        $filial = EmpresaFilial::find($empresa_filial_json->id);

        if ($filial->active == 0) {
            return 'filial desativada';
        }

        $nomeMetodo    = 'show_filial';               // nome do método - permissão que usuário PRECISA ter
        $arrayCompleto = [$nomeMetodo, $filial];      // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder   = json_encode($arrayCompleto); // guard nao aceita array, envio entao um json

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            return $filial;
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function update(EmpresaFilial $empresa_filial_json) {
        Auth::loginUsingId(1);
        $filial = EmpresaFilial::find($empresa_filial_json->id);

        $nomeMetodo    = 'update_filial';             // nome do método - permissão que usuário PRECISA ter
        $arrayCompleto = [$nomeMetodo, $filial];      // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder   = json_encode($arrayCompleto); // guard nao aceita array, envio entao um json

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $empresa_filial_json->update($this->validateFilialRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function destroy(EmpresaFilial $empresa_filial_json) {
        Auth::loginUsingId(1);
        $filial = EmpresaFilial::find($empresa_filial_json->id);

        $nomeMetodo    = 'destroy_filial';            // nome do método - permissão que usuário PRECISA ter
        $arrayCompleto = [$nomeMetodo, $filial];      // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder   = json_encode($arrayCompleto); // guard nao aceita array, envio entao um json

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $empresa_filial_json->delete();
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function desativarFilial(EmpresaFilial $empresa_filial_json) {
        Auth::loginUsingId(1);
        $filial = EmpresaFilial::find($empresa_filial_json->id);

        $nomeMetodo    = 'desativar_filial';        // nome do método - permissão que usuário PRECISA ter
        $arrayCompleto = [$nomeMetodo, $filial];    // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder   = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $filial->active = false;
            $filial->save();
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function inativosFilial() {
        Auth::loginUsingId(1);
        $user       = Auth::user();
        $nomeMetodo = 'listar_filial_desat';

        if (Gate::allows('tem-permissao', $nomeMetodo)) {
            return EmpresaFilial::where([['empresa_id', '=', $user->empresa_id], // do usuário
                                         ['active', '=', 0], // desativados
                                        ])->orderBy('updated_at', 'desc')->get();
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    // ========================= protected

    protected function validateFilialRequest() {
        return request()->validate([
                                       'name' => 'required',
                                       'active' => 'nullable',
                                       'empresa_id' => 'required',
                                   ]);

    }

}
