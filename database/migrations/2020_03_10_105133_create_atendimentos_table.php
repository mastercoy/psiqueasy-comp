<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtendimentosTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('atendimentos', function (Blueprint $table) {

            $table->increments('id');
            $table->string('status');
            $table->dateTime('data')->nullable();
            $table->mediumText('obs')->nullable();
            $table->longText('resultado')->nullable();
            $table->string('procedimento')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->integer('paciente_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('atendimentos');
    }
}
