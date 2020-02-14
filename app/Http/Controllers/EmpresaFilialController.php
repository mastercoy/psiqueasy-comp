<?php

namespace App\Http\Controllers;

use App\Models\EmpresaFilial;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class EmpresaFilialController extends Controller {

    public function index() {  //Ok
        //obs index_filial
        Auth::loginUsingId(1); //fixme remover

        $nomeMetodo      = 'index_filial';                     //nome do método - permissão que usuário PRECISA ter
        $user            = Auth::user();                       // usuário é o usuário logado atualmente no sistema
        $arrayPermissoes = $this->retornaPermissoes($user);    //método retorna um array com as permissões do usuário

        // joga tudo em um array, converte pra json e envia no guard
        $arrayCompleto = [$nomeMetodo, $arrayPermissoes];

        $filiais      = EmpresaFilial::all();
        $listaFiliais = [];

        foreach ($filiais as $filial) {
            $arrayCompleto[2] = $filial;
            $jsonEncoder      = json_encode($arrayCompleto); //precisa transformar em json pois o guard nao aceita array
            if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
                $listaFiliais[] = $filial;

            }
        }
        return Response::json($listaFiliais);
    }

    public function create() {

    }

    public function store() {  //Ok
        //obs criar_filial
        Auth::loginUsingId(1); //fixme retirar

        $nomeMetodo      = 'criar_filial';                     // passa como string, o 'nome' do método, utilizado para verificar a permissão, cujo o nome é o mesmo
        $user            = Auth::user();                       // usuário é o usuário logado
        $arrayPermissoes = $this->retornaPermissoes($user);    //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes];
        $jsonEncoder     = json_encode($arrayCompleto); //precisa transformar em json pois o guard nao aceita array

        if (Gate::allows('tem-permissao', $jsonEncoder)) {
            $criar_filial_json = EmpresaFilial::create($this->validateFilialRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function show(EmpresaFilial $empresa_filial_json) {
        $filial = EmpresaFilial::find($empresa_filial_json->id);
        Auth::loginUsingId(1);//fixme retirar - só para teste

        $nomeMetodo      = 'show_filial';                                  //nome do método - permissão que usuário PRECISA ter
        $user            = Auth::user();                                   // usuário é o usuário logado atualmente no sistema
        $arrayPermissoes = $this->retornaPermissoes($user);                //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $filial];       // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            return $filial;
        } else {
            abort(403, 'Sem Permissão!');
        }

    }

    public function edit(EmpresaFilial $empresa_filial_json) {

    }

    public function update(EmpresaFilial $empresa_filial_json) {
        //obs update_filial
        Auth::loginUsingId(1);
        $filial = EmpresaFilial::find($empresa_filial_json->id);

        $nomeMetodo      = 'update_filial';                                //nome do método - permissão que usuário PRECISA ter
        $user            = Auth::user();                                   // usuário é o usuário logado atualmente no sistema
        $arrayPermissoes = $this->retornaPermissoes($user);                //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $filial];       // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $empresa_filial_json->update($this->validateFilialRequest());
        } else {
            abort(403, 'Sem Permissão!');
        }


    }

    public function destroy(EmpresaFilial $empresa_filial_json) {
        //obs destroy_filial
        Auth::loginUsingId(1);//fixme retirar - só para teste
        $filial = EmpresaFilial::find($empresa_filial_json->id);

        $nomeMetodo      = 'destroy_filial';                                //nome do método - permissão que usuário PRECISA ter
        $user            = Auth::user();                                    // usuário é o usuário logado atualmente no sistema
        $arrayPermissoes = $this->retornaPermissoes($user);                 //método retorna um array com as permissões do usuário
        $arrayCompleto   = [$nomeMetodo, $arrayPermissoes, $filial];        // jogo as informações anteriores em um array para enviar no guard
        $jsonEncoder     = json_encode($arrayCompleto);

        if (Gate::allows('pertence-mesma-empresa-e-tem-permissao', $jsonEncoder)) {
            $empresa_filial_json->delete();
        } else {
            abort(403, 'Sem Permissão!');
        }
    }

    public function desativarFilial(EmpresaFilial $empresa_filial_json) {
        //obs desativar_filial
        Auth::loginUsingId(1);//fixme retirar - só para teste
        $filial = EmpresaFilial::find($empresa_filial_json->id);

        $nomeMetodo      = 'desativar_filial';                                //nome do método - permissão que usuário PRECISA ter
        $user            = Auth::user();                                      // usuário é o usuário logado atualmente no sistema
        $arrayPermissoes = $this->retornaPermissoes($user);                   //método retorna um array com as permissões do usuário
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
                                       'empresa_id' => 'nullable',
                                       'user_id' => 'nullable'
                                   ]);

    }

    protected function retornaPermissoes(User $user_json) {

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
