<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvaliacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaliacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_professor')->unsigned();
            $table->foreign('id_professor')->references('id')->on('users');
            $table->integer('id_curso')->unsigned();
            $table->foreign('id_curso')->references('id')->on('cursos');
            $table->integer('id_turma')->unsigned();
            $table->foreign('id_turma')->references('id')->on('turmas');
            $table->integer('id_disciplina')->unsigned();
            $table->foreign('id_disciplina')->references('id')->on('disciplinas');
            $table->string('pin');
            $table->dateTime('dataValidade');
            $table->enum('status', ['0','1']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avaliacoes');
    }
}
