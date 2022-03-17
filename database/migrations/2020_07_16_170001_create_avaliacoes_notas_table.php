<?php

use App\Models\AvaliacoesNotas;
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
            $table->id();
            $table->foreignId('avaliacao_id');
            $table->foreign('avaliacao_id')->references('id')->on('avaliacoes');
            $table->foreignId('pergunta_id');
            $table->foreign('pergunta_id')->references('id')->on('formularios_perguntas');
            $table->integer('nota')->nullable(true);
            $table->text('texto')->nullable(true);
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
        Schema::drop('avaliacoes_notas');
    }
}
