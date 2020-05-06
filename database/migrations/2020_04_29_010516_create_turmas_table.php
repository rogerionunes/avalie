<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turmas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_curso')->unsigned();
            $table->foreign('id_curso')->references('id')->on('cursos');
            $table->string('nm_turma');
            $table->string('ano');
            $table->enum('status', ['0','1']);
            $table->enum('semestre', ['1','2']);
            $table->enum('turno', ['M','T','N']);
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
        Schema::dropIfExists('turmas');
    }
}
