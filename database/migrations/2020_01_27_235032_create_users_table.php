<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('users', function (Blueprint $table) {
            //fixme os nullable
            $table->increments('id');
            $table->string('name', 191)->nullable();
            $table->string('foto', 191)->nullable();
            $table->string('email', 191)->unique();
            $table->string('password', 191);
            $table->rememberToken();
            $table->timestamps();
            $table->dateTime('data_nasc')->nullable();
            $table->string('formacao', 191)->nullable();
            $table->string('profissao', 191)->nullable();
            $table->string('telefones', 191)->nullable();
            $table->longText('model_doc_topo')->nullable();
            $table->longText('model_doc_rodape')->nullable();
            $table->longText('contrato')->nullable();
            $table->longText('comprovante')->nullable();
            $table->dateTime('venc_plano')->nullable();
            $table->integer('plano_id')->nullable();
            $table->integer('plano_solicitado_id')->nullable();
            $table->dateTime('data_solicitacao_plano')->nullable();
            $table->tinyInteger('debito_automatico')->nullable();
            $table->string('tipo_user', 191)->nullable();
            $table->integer('quant_acesso')->nullable()->default('0');
            $table->dateTime('ultimo_acesso')->nullable();
            $table->mediumText('config')->nullable();
            $table->string('cpf', 191)->nullable();
            $table->mediumText('endereco')->nullable();
            $table->mediumText('cartao')->nullable();
            $table->integer('empresa_id')->unsigned()->nullable();
            $table->foreign('empresa_id')
                  ->references('id')
                  ->on('empresas')
                  ->onDelete('cascade');
        });

        // tabela pivot | users | > users_userperfil <  | userperfil |
        Schema::table('users_userperfil', function (Blueprint $table) {

            $table->integer('users_id')->unsigned()->nullable();
            $table->foreign('users_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->integer('userperfil_id')->unsigned()->nullable();
            $table->foreign('userperfil_id')
                  ->references('id')
                  ->on('userperfil')
                  ->onDelete('cascade');
            $table->timestamps();
        });

        //fixme PRIMARY?
        Schema::table('userperfil', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->string('label', 45)->nullable();
            $table->tinyInteger('active')->default(true);
            $table->timestamps();

        });

        // tabela pivot | userperfil | > userperfil_userpermissoes < | userpermissoes |
        Schema::table('userperfil_userpermissoes', function (Blueprint $table) {

            $table->integer('userperfil_id')->unsigned()->nullable();
            $table->foreign('userperfil_id')
                  ->references('id')
                  ->on('userperfil')
                  ->onDelete('cascade');

            $table->integer('userpermissoes_id')->unsigned()->nullable();
            $table->foreign('userpermissoes_id')
                  ->references('id')
                  ->on('userpermissoes')
                  ->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('userpermissoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->string('label', 45)->nullable();
            $table->tinyInteger('active')->default(true);
            $table->timestamps();

        });

        Schema::table('user_modelos_docs', function (Blueprint $table) {
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
            $table->timestamps();
        });

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('users', function (Blueprint $table) {
            //
        });
        Schema::table('users_userperfil', function (Blueprint $table) {
            //
        });
        Schema::table('userperfil', function (Blueprint $table) {
            //
        });
        Schema::table('userperfil_userpermissoes', function (Blueprint $table) {
            //
        });
        Schema::table('userpermissoes', function (Blueprint $table) {
            //
        });
    }
}
