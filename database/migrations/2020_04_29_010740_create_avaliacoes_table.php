<?php

use App\Models\Avaliacoes;
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
            $table->id();
            $table->foreignId('id_professor');
            $table->foreign('id_professor')->references('id')->on('users');
            $table->foreignId('id_curso');
            $table->foreign('id_curso')->references('id')->on('cursos');
            $table->foreignId('id_turma');
            $table->foreign('id_turma')->references('id')->on('turmas');
            $table->foreignId('id_disciplina');
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
        Schema::drop('avaliacoes');
    }
}
