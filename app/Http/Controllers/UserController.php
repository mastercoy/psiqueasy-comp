<?php

namespace App\Http\Controllers;

use App\Models\PerfilPermissaoPivot;
use App\Models\UserPerfil;
use App\Models\UserPerfilPivot;
use App\Models\UserPermissao;
use App\User;
use Illuminate\Support\Facades\Response;

class UserController extends Controller {

    public function index() {

        //fixme criar outros usuários com outros relacionamentos
        //afazer transformar no guard

        $id   = 1;
        $user = User::findOrFail($id)->with('perfil.permissao')->get()->toArray()[0]['perfil'][0]['permissao']; // [0] = array dos resultados, primeira posição|throw erro quando n tem permissão

        foreach ($user as $permissoes) {
            $listaPermissoes[] = $permissoes['name'];
        }
        dd($listaPermissoes);
        /*$perfil = UserPerfil::with( 'permissao.perfil')->get();
        foreach ($perfil as $permissoes) {
            $arrayPermissoes = $permissoes->permissao()->get()->toArray();
//            dd($arrayPermissoes);
            foreach ($arrayPermissoes as $permissao) {
//                dd($permissao);
                $listaPermissoes[] = $permissao['name'];

            }
        }
//        dd($listaPermissoes);
////        $perfil = UserPerfil::with('permissao')->get()->toArray();
//        $permissao = UserPermissao::has('perfil')->get()->toArray();
//        dd($permissao);
        /*$perfil = UserPerfil::first(); // acha o perfil
        $teste = $perfil->permissoes()->get()->toArray(); // pega as permissões do perfil
        dd($teste);*/


        /*$permissoes = UserPermissao::all();
        foreach ($permissoes as $permissao) {
            $listaPermissoes[] = $permissao->perfil();
        }
        dd($listaPermissoes);
//        dd($user->perfil()->get()->toArray());


//        listar permissões
//UserPermissao::with('perfis')->get();
//        dd($user);
//        dd($perfil->toArray()['created_at']);
//        dd($perfil->toArray()['created_at']);
//        dd($perfil->user()->get());
//        dd($user->perfil()->get());
//        dd($this->verificarPermissao($user, 'paciente_in'));

        /*$user = User::all();
        return Response::json($user);*/

    }

    public function create() {
        //
    }

    public function store() {
        //
        $user_json = User::create($this->validateUserRequest());
    }

    public function show(User $user_json) {
        $user = User::find($user_json->id);
        return Response::json($user);
    }

    public function edit(User $user) {
        //
    }

    public function update(User $user_json) {
        $user_json->update($this->validateUserRequest());
    }

    public function destroy(User $user_json) {
        $user_json->delete();
    }

    public function desativarUser(User $user_json) {
        $user         = User::find($user_json->id);
        $user->active = false;
        $user->save();
    }

    public function verificarPermissao(User $user_json, $string) {
        // cada método do crud terá um nome de permissão
        // criar_paciente, remover_paciente, editar_paciente, gerar_relat_financeiro, gerar_relat_atendimentos
        // usuario
        $usuario = User::find($user_json->id);
        // tabela pivot  user >< perfil
        $userPerfilPivot = UserPerfilPivot::whereUserId($usuario->id);
        // perfil bonitinho
        $perfil = UserPerfil::find($userPerfilPivot->get()->pluck('userperfil_id')->toArray()[0]);
        // tabela pivot  perfil >< permissoes
        $perfilPermissaoPivot = PerfilPermissaoPivot::whereUserperfilId($perfil->id)->get()->toArray();

        // confere permissões através da tabela pivot e salva os nomes em um array
        foreach ($perfilPermissaoPivot as $pivot) {
            $permissao       = UserPermissao::whereId($pivot['userpermissao_id'])->first()->toArray();
            $nomePermissao[] = $permissao['name'];
        }
        dd($nomePermissao); // mostra array com as permissões

        // verifica se existe a permissão questionada no array de permissões do usuário
        return in_array($string, $nomePermissao);

        /*foreach ($nomePermissao as $nome) {
            if ($nome == $string) {
                return true;
            }
        }
        return false;*/

    }

    // ========================= protected

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
}
