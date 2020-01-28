<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     * Empresa
     * id int
     * nome varchar 191
     * cpf_cnpj varchar 191
     * logo_marca varchar 191
     * empresa_categoria_id int
     * active tinyinteger
     */
    public function up() {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cpf_cnpj', 191);
            $table->string('logo_marca', 191);
            $table->tinyInteger('active')->default(true);
            $table->timestamps();
        });

        Schema::create('empresa_categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191);
            $table->string('descricao', 191);
            $table->tinyInteger('active')->default(true);
            $table->timestamps();
        });

        Schema::create('empresa_filiais', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191);
            $table->tinyInteger('active');
            $table->integer('empresa_id')->unsigned()->nullable();
            $table->foreign('empresa_id')
                  ->references('id')
                  ->on('empresas');
            $table->timestamps();
        });

        Schema::create('empresa_modelos_docs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('conteudo')->nullable();
            $table->boolean('active')->default(true);
            $table->integer('empresa_id')->unsigned()->nullable();
            $table->foreign('empresa_id')
                  ->references('id')
                  ->on('empresas')
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
        Schema::dropIfExists('empresas');
        Schema::dropIfExists('empresa_categorias');
        Schema::dropIfExists('empresa_filiais');
        Schema::dropIfExists('empresa_modelos_docs');
    }
}
