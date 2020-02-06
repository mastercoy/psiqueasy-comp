<?php

namespace App\Http\Controllers;

use App\Models\UserPerfilPivot;
use App\User;
use Illuminate\Support\Facades\Response;

class UserController extends Controller {

//fixme transferir pro próprio controller
    /*public function __construct() {
        //afazer middleware
        $this->middleware();
    }*/

    public function index() {
        //afazer começo da logica de permissões
        $user            = User::find(1);
        $pivot           = $user->perfilpivot()->get()->pluck('userperfil_id')->toArray();
        $userPerfilPivot = UserPerfilPivot::find($pivot[0]);

        dd($userPerfilPivot->perfis()->get());
//        dd($user->perfilpivot()->get()->perfis()->toArray());
        return 'em construção';
        // pegar id do user
        // comparar se tem um perfil onde userperfil_id = user->id
        // encadear relacionamentos com get() no final
        $perfilpivot = UserPerfilPivot::whereUserId($user->id)->get();

        /*if ($user->perfilpivot()->where('user_id', '=', $user->id) && ()) {
        }*/
        //obs mudar nome das tabelas 'perfil tem permissoes' 'user tem perfil'

//        dd($perfilpivot->toJson());
//        dd($user);
//        dd($user->toArray());
//        dd($perfilpivot->toArray());
//        return 'Esse é o pivot';
//        dd($user->toJson());
//        return Response::json($user);

        /*
         * $article = Article::with(['category', 'author'])->first();
$article->getRelations(); // get all the related models
$article->getRelation('author'); // to get only related author model
         */
    }

    public function create() {
        //
    }

    public function store() {
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
