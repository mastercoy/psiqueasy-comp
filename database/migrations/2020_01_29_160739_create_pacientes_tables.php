<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTables extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //
        Schema::create('pacientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->dateTime('data_nasc')->nullable();
            $table->string('serie')->nullable();
            $table->mediumText('end')->nullable();
            $table->string('tel')->nullable();
            $table->string('cpf')->nullable();
            $table->string('rg')->nullable();
            //documentos
            $table->longText('queixa')->nullable();
            $table->longText('relatorio_final')->nullable();
            $table->longText('encaminhamento')->nullable();
            $table->longText('informe')->nullable();
            $table->longText('informe_social')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->integer('user_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }
}
