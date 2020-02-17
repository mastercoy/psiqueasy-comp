<?php

namespace App\Http\Controllers;

use App\Models\EmpresaFilial;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class EmpresaFilialController extends Controller {

    public function index() {
        Auth::loginUsingId(1); //fixme remover

        $nomeMetodo      = 'index_filial';                     //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();         //método retorna um array com as permissões do usuário

        // joga tudo em um array, converte pra json e envia no guard
        $arrayCompleto = [$nomeMetodo, $arrayPermissoes];

        $filiais      = EmpresaFilial::all();
        $listaFiliais = [];

        foreach ($filiais as $filial) {
            $arrayCompleto[2] = $filial;
            $jsonEncoder      = json_encode($arrayCompleto); //precisa transformar em json pois o guard nao aceita array
            if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
                //afazer
                $listaFiliais[] = $filial;

            }
        }
        return Response::json($listaFiliais);
    }

    public function store() {
        Auth::loginUsingId(1); //fixme retirar

        $nomeMetodo      = 'criar_filial';                     // passa como string, o 'nome' do método, utilizado para verificar a permissão, cujo o nome é o mesmo
        $arrayPermissoes = $this->retornaPermissoes();         //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes];    // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);        // guard nao aceita array, envio entao um json

        if (Gate::allows('tem-permissao', $jsonEncoder)) {
            $criar_filial_json = EmpresaFilial::create($this->validateFilialRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function show(EmpresaFilial $empresa_filial_json) {
        Auth::loginUsingId(1);//fixme retirar - só para teste
        $filial = EmpresaFilial::find($empresa_filial_json->id);

        $nomeMetodo      = 'show_filial';                                  //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();                     //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $filial];       // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);                    // guard nao aceita array, envio entao um json

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            return $filial;
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function update(EmpresaFilial $empresa_filial_json) {
        Auth::loginUsingId(1);
        $filial = EmpresaFilial::find($empresa_filial_json->id);

        $nomeMetodo      = 'update_filial';                                  //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();                       //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $filial];         // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);                      // guard nao aceita array, envio entao um json

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $empresa_filial_json->update($this->validateFilialRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function destroy(EmpresaFilial $empresa_filial_json) {
        Auth::loginUsingId(1);//fixme retirar - só para teste
        $filial = EmpresaFilial::find($empresa_filial_json->id);

        $nomeMetodo      = 'destroy_filial';                                  //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();                        //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $filial];          // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);                       // guard nao aceita array, envio entao um json

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $empresa_filial_json->delete();
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function desativarFilial(EmpresaFilial $empresa_filial_json) {
        Auth::loginUsingId(1);//fixme retirar - só para teste
        $filial = EmpresaFilial::find($empresa_filial_json->id);

        $nomeMetodo      = 'desativar_filial';                                //nome do método - permissão que usuário PRECISA ter
        $arrayPermissoes = $this->retornaPermissoes();                        //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $filial];          // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $filial->active = false;
            $filial->save();
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
}
