<?php

namespace App\Http\Controllers;


use App\Models\Responsavel;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class ResponsavelController extends Controller { //verificar se user->id == responsavel->user_id

    public function index() {
        Auth::loginUsingId(1); //fixme remover

        $nomeMetodo      = 'index_responsavel';                     //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();              //método retorna um array com as permissões do usuário

        // joga tudo em um array, converte pra json e envia no guard
        $arrayCompleto = [$nomeMetodo, $arrayPermissoes];

        $responsaveis      = Responsavel::all();
        $listaResponsaveis = [];

        foreach ($responsaveis as $responsavel) {
            if ($responsavel->active != 0) {
                $arrayCompleto[2] = $responsavel;
                $jsonEncoder      = json_encode($arrayCompleto); //precisa transformar em json pois o guard nao aceita array
                if (Gate::allows('pertence-usuario-logado-e-tem-permissao', $jsonEncoder)) {
                    $listaResponsaveis[] = $responsavel;
                }
            }

        }
        return Response::json($listaResponsaveis);
    }

    public function store() {
        Auth::loginUsingId(1); //fixme retirar

        $nomeMetodo      = 'criar_responsavel';                     //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();              //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes];         // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);             //precisa transformar em json pois o guard nao aceita array

        if (Gate::allows('tem-permissao', $jsonEncoder)) {
            $responsavel_json = Responsavel::create($this->validateResponsavelRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function show(Responsavel $responsavel_json) {
        Auth::loginUsingId(1);//fixme retirar - só para teste
        $responsavel = Responsavel::find($responsavel_json->id);

        if ($responsavel->active == 0) {
            return null;
        }

        $nomeMetodo      = 'show_responsavel';                                  //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();                          //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $responsavel];       // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);                         // guard nao aceita array, envio entao um json

        if (Gate::allows('pertence-usuario-logado-e-tem-permissao', $jsonEncoder)) {
            return $responsavel;
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function update(Responsavel $responsavel_json) {
        Auth::loginUsingId(1);
        $responsavel = Responsavel::find($responsavel_json->id);

        $nomeMetodo      = 'update_responsavel';                                       //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();                                 //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $responsavel];              // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);                                // guard nao aceita array, envio entao um json

        if (Gate::allows('pertence-usuario-logado-e-tem-permissao', $jsonEncoder)) {
            $responsavel_json->update($this->validateResponsavelRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function destroy(Responsavel $responsavel_json) {
        Auth::loginUsingId(1);//fixme retirar - só para teste
        $responsavel = Responsavel::find($responsavel_json->id);

        $nomeMetodo      = 'destroy_responsavel';                                  //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();                             //método retorna um array com as permissões do usuário logado atualmente no sistema
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $responsavel];          // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);                            // guard nao aceita array, envio entao um json

        if (Gate::allows('pertence-usuario-logado-e-tem-permissao', $jsonEncoder)) {
            $responsavel_json->delete();
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function desativarResponsavel(Responsavel $responsavel_json) {
        Auth::loginUsingId(1);//fixme retirar - só para teste
        $responsavel = Responsavel::find($responsavel_json->id);

        $nomeMetodo      = 'desativar_responsavel';                                  //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();                               //método retorna um array com as permissões do usuário logado atualmente no sistema
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $responsavel];            // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);                              // guard nao aceita array, envio entao um json

        if (Gate::allows('pertence-usuario-logado-e-tem-permissao', $jsonEncoder)) {
            $responsavel->active = false;
            $responsavel->save();
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function excluidosResponsavel() {
        Auth::loginUsingId(1);//fixme retirar - só para teste
        $user = Auth::user();

        $nomeMetodo      = 'listar_respon_desat';                                    //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();                               //método retorna um array com as permissões do usuário logado atualmente no sistema
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes];                          // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);                              // guard nao aceita array, envio entao um json

        if (Gate::allows('tem-permissao', $jsonEncoder)) {
            return Responsavel::where([
                                          ['user_id', '=', $user->id], // do usuário
                                          ['active', '=', 0], // desativados
                                      ])
                              ->orderBy('updated_at', 'desc')
                              ->get();
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    // =========================================== protected

    protected function retornaPermissoes() {
        $user_json           = Auth::user();
        $listaPermissoesUser = [];

        if (isset(User::where('id', $user_json->id)->with('perfil.permissao')->first()->toArray()['perfil'][0]['permissao'])) {
            $permissoes = User::where('id', $user_json->id)->with('perfil.permissao')->first()->toArray()['perfil'][0]['permissao'];

            foreach ($permissoes as $permissao) {
                $listaPermissoesUser[] = $permissao['name'];
            }

        } else {
            return $listaPermissoesUser;
        }

        return $listaPermissoesUser;
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
                                       'user_id' => 'required'

                                   ]);
    }


}
