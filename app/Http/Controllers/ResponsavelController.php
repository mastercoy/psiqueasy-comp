<?php

namespace App\Http\Controllers;


use App\Responsavel;
use Gate;

//afazer CLASSE CONTROLLER
/*namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Responsavel;
use App\User;
use Gate;

class ResponsavelController extends Controller
{
class ResponsavelController extends Controller {

    public function index() {
        return User::find(auth()->user()->id)->responsaveis()->get();
    }

    public function store(Request $request) {
        $this->validate($request, [
            'nome' => 'required | max: 190',
            'parentesco' => 'nullable | max: 190',
            'data_nasc' => 'date | nullable',
            'end' => 'nullable',
            'tel' => 'nullable | max: 190',
            'cpf' => 'nullable | cpf',
            'rg' => 'nullable | max: 100',
        ]);

        $responsavel             = new Responsavel;
        $responsavel->nome       = $request->nome;
        $responsavel->parentesco = $request->parentesco;
        $responsavel->data_nasc  = ($request->data_nasc) ? date('Y-m-d', strtotime($request->data_nasc)) : null;
        $responsavel->user_id    = $request->user()->id;
        $responsavel->end        = $request->end;
        $responsavel->tel        = $request->tel;
        $responsavel->cpf        = $request->cpf;
        $responsavel->rg         = $request->rg;

        $responsavel->save();
        return Responsavel::find($responsavel->id);
    }

    public function show($id) {

        $responsavel = Responsavel::find($id);
        if (Gate::denies('pertence-usuario-logado', $responsavel)) {
            abort(403, 'Não encontrado!');
        }
        return $responsavel;

    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'nome' => 'required | max: 190',
            'parentesco' => 'nullable | max: 190',
            'data_nasc' => 'date | nullable',
            'end' => 'nullable',
            'tel' => 'nullable | max: 190',
            'cpf' => 'nullable | cpf',
            'rg' => 'nullable | max: 100',
        ]);

        $responsavel = Responsavel::find($id);
        if (Gate::denies('pertence-usuario-logado', $responsavel)) {
            abort(403, 'Não encontrado!');
        }
        $responsavel->nome       = $request->nome;
        $responsavel->parentesco = $request->parentesco;
        $responsavel->data_nasc  = ($request->data_nasc) ? date('Y-m-d', strtotime($request->data_nasc)) : null;
        $responsavel->user_id    = $request->user()->id;
        $responsavel->end        = $request->end;
        $responsavel->tel        = $request->tel;
        $responsavel->cpf        = $request->cpf;
        $responsavel->rg         = $request->rg;

        $responsavel->save();

        return $responsavel;
    }

    public function destroy($id) {

        $responsavel = Responsavel::find($id);
        if (Gate::denies('pertence-usuario-logado', $responsavel)) {
            abort(403, 'Não encontrado!');
        }
        $responsavel->active = false;
        $responsavel->save();
        return $responsavel;
    }

    public function excluidos(Request $request) {
        return Responsavel::where([
                                      ['user_id', '=', $request->user()->id], // do usuário
                                      ['active', '=', 0], // excluidos
                                  ])
                          ->orderBy('updated_at', 'desc')
                          ->get();
    }
}*/

class ResponsavelController extends Controller {

    public function index() {
        //
    }


    public function create() {
        //
    }


    public function store() {
        $responsavel_json = Responsavel::create($this->validateResponsavelRequest());

    }


    public function show(Responsavel $responsavel_json) {
        return $responsavel = Responsavel::find($responsavel_json->id);
    }


    public function edit(Responsavel $responsavel) {
        //
    }


    //fixme usar GATE
    public function update(Responsavel $responsavel_json) {
        $responsavel_json->update($this->validateResponsavelRequest());
    }

    //fixme usar GATE
    public function destroy(Responsavel $responsavel_json) {
        $responsavel_json->delete();
    }

    protected function validateUserRequest() {
        return request()->validate([
                                       'name' => 'required',
                                       'foto' => 'nullable',
                                       'email' => 'required',
                                       'password' => 'required',
                                       'data_nasc' => 'nullable',
                                       'formacao' => 'nullable',
                                       'profissao' => 'nullable',
                                       'telefones' => 'nullable',
                                       'model_doc_top' => 'nullable',
                                       'model_doc_rodape' => 'nullable',
                                       'contrato' => 'nullable',
                                       'comprovante' => 'nullable',
                                       'venc_plano' => 'nullable',
                                       'plano_id' => 'nullable',
                                       'plano_solicitado_id' => 'nullable',
                                       'data_solicitacao_plano' => 'nullable',
                                       'debito_automatico' => 'nullable',
                                       'tipo_user' => 'nullable',
                                       'quant_acesso' => 'nullable',
                                       'ultimo_acesso' => 'nullable',
                                       'config' => 'nullable',
                                       'cpf' => 'nullable',
                                       'endereco' => 'nullable',
                                       'cartao' => 'nullable',
                                       'empresa_id' => 'nullable',

                                   ]);
    }

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
                                       'user_id' => 'nullable',


                                   ]);
    }
}
