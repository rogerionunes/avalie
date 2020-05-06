<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessorDisciplinaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professor_disciplina', function (Blueprint $table) {
            $table->integer('id_professor')->unsigned();
            $table->foreign('id_professor')->references('id')->on('users');
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
        Schema::dropIfExists('professor_disciplina');
    }
}
