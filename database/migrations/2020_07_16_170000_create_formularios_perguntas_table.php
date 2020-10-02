<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulariosPerguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formularios_perguntas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_formulario')->unsigned();
            $table->foreign('id_formulario')->references('id')->on('formularios');
            $table->integer('ordem');
            $table->string('titulo');
            $table->enum('tipo', ['notas','opcoes','texto']);
            $table->enum('bloco', ['DP','IA','N']);
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
        Schema::dropIfExists('formularios_perguntas');
    }
}
