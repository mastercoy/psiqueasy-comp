<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToTables extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //
        Schema::table('users', function ($table) {
            $table->integer('empresa_id')->unsigned()->nullable();
            $table->foreign('empresa_id')
                  ->references('id')
                  ->on('empresas')
                  ->onDelete('cascade');
        });

        Schema::table('empresas', function ($table) {
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });

        Schema::table('users', function ($table) {
            $table->integer('responsavel_id')->unsigned()->nullable();
            $table->foreign('responsavel_id')
                  ->references('id')
                  ->on('responsavel')
                  ->onDelete('cascade');
        });

        Schema::table('perfil', function ($table) { //fixme nullable
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->integer('empresa_id')->unsigned()->nullable();
            $table->foreign('empresa_id')
                  ->references('id')
                  ->on('empresas')
                  ->onDelete('cascade');
        });

    }

    public function down() {
        //
    }
}
