<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvaliacoesNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaliacoes_notas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('avaliacao_id')->unsigned();
            $table->foreign('avaliacao_id')->references('id')->on('avaliacoes');
            $table->integer('pergunta_id')->unsigned();
            $table->foreign('pergunta_id')->references('id')->on('formularios_perguntas');
            $table->integer('nota');
            $table->text('texto');
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
        Schema::dropIfExists('avaliacoes_notas');
    }
}
