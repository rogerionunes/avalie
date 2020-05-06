<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurmaDisciplinaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turma_disciplina', function (Blueprint $table) {
            $table->integer('id_turma')->unsigned();
            $table->foreign('id_turma')->references('id')->on('turmas');
            $table->integer('id_disciplina')->unsigned();
            $table->foreign('id_disciplina')->references('id')->on('disciplinas');
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
        Schema::dropIfExists('turma_disciplina');
    }
}
