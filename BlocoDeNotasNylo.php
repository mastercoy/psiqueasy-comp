<?php
/**
 * Criado por  PhpStorm
 * User:       Nylo Pinto
 * Filename:   BlocoDeNotasNylo.php
 * Data:       27/01/2020
 * Hora:       20:28
 */

/*

    ilustração de tabelas e pivots

| users | > users_usersperfis <  | usersperfis |
| usersperfis | > usersperfis_userspermissoes | userspermissoes |
 *
//afazer envio de email para confirmar conta
// TABELA EMPRESA
// TABELA USER PERMISSOES ITENS
// RESPONSAVEL CONTROLLER
namespace App\Http\Controllers;

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
}

//fixme relações
// Um usuario pode ter muitos user_modelos_docs
// Um usuário só pode ter um perfil
// um perfil pode pertencer a varios usuarios obs model perfil
// um perfil tem varias permissões obs model permissoes
// uma permissão pode pertencer a varios perfis

// TABELA RESPONSAVEL
Schema::create('responsaveis', function(Blueprint $table){

          $table->increments('id');
          $table->string('nome');
          $table->string('parentesco')->nullable();
          $table->dateTime('data_nasc')->nullable();
          $table->mediumText('end')->nullable();
          $table->string('tel')->nullable();
          $table->string('cpf')->nullable();
          $table->string('rg')->nullable();
          $table->boolean('active')->default(true);
          $table->timestamps();
          $table->integer('user_id')->unsigned();
        });

// TABELA EMPRESA CATEGORIAS
Schema::create('empresa_categs', function(Blueprint $table){
            $table->increments('id');
            $table->string('nome');
            $table->string('descricao')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::table('empresas', function(Blueprint $table){
            $table->foreign('empresa_categ_id')
                    ->references('id')
                    ->on('empresa_categs')
                    ->onDelete('cascade');
        });

// TABELA EMPRESA MODELO DOCUMENTOS
Schema::create('empresa_modelos_docs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->longText('conteudo')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->integer('empresa_id')->unsigned();
            $table->foreign('empresa_id')
                    ->references('id')
                    ->on('empresas')
                    ->onDelete('cascade');
        });

//TABELA USER MODELO DOCUMENTOS
Schema::create('user_modelos_docs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->longText('conteudo')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
        });

//TABELA USER PERFIS
Schema::create('user_perfis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('label');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('user_permissoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('label');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('user_perfis_itens', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            $table->integer('user_perfis_id')->unsigned();
            $table->foreign('user_perfis_id')
                    ->references('id')
                    ->on('user_perfis')
                    ->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('user_permissoes_itens', function (Blueprint $table) {
            $table->integer('user_perfis_id')->unsigned();
            $table->foreign('user_perfis_id')
                    ->references('id')
                    ->on('user_perfis')
                    ->onDelete('cascade');
            $table->integer('user_permissoes_id')->unsigned();
            $table->foreign('user_permissoes_id')
                    ->references('id')
                    ->on('user_permissoes')
                    ->onDelete('cascade');
            $table->timestamps();
        });

//afazer VALIDATION
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\UserPermissao;
app/Providers/AuthServiceProvider.php
Schema::defaultStringLength(191);
        $this->registerPolicies();

        /*
        |--------------------------------------------------------------------------
        | VERIFICAR SE O OBJETO PASSADO PERTENCE A USUÁRIO LOGADO
        |--------------------------------------------------------------------------
        |
        |


Gate::define('pertence-usuario-logado', function($user, $objeto){
    return $user->id == $objeto->user_id;
});
/*
|--------------------------------------------------------------------------
| VERIFICAR SE O PACIENTE PASSADO PERTENCE A USUÁRIO LOGADO E ESTÁ ATIVO
|--------------------------------------------------------------------------
|
|


Gate::define('pertence-usuario-logado-e-active', function($user, $objeto){
    return $user->id == $objeto->user_id && $objeto->active == 1;
});



*/


