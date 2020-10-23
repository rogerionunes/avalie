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
            $table->increments('id');
            $table->integer('avaliacao_id')->unsigned();
            $table->foreign('avaliacao_id')->references('id')->on('avaliacoes');
            $table->integer('pergunta_id')->unsigned();
            $table->foreign('pergunta_id')->references('id')->on('formularios_perguntas');
            $table->integer('nota');
            $table->text('texto');
            $table->timestamps();
        });

        AvaliacoesNotas::create([
            'id' => '1',
            'avaliacao_id' => '1',
            'pergunta_id' => '1',
            'nota' => '0',
            'texto' => '',
        ]);

        AvaliacoesNotas::create([
            'id' => '2',
            'avaliacao_id' => '1',
            'pergunta_id' => '2',
            'nota' => '1',
            'texto' => '',
        ]);

        AvaliacoesNotas::create([
            'id' => '3',
            'avaliacao_id' => '1',
            'pergunta_id' => '3',
            'nota' => '2',
            'texto' => '',
        ]);

        AvaliacoesNotas::create([
            'id' => '4',
            'avaliacao_id' => '1',
            'pergunta_id' => '4',
            'nota' => '3',
            'texto' => '',
        ]);

        AvaliacoesNotas::create([
            'id' => '5',
            'avaliacao_id' => '1',
            'pergunta_id' => '5',
            'nota' => '4',
            'texto' => 'teste',
        ]);

        AvaliacoesNotas::create([
            'id' => '6',
            'avaliacao_id' => '1',
            'pergunta_id' => '6',
            'nota' => '5',
            'texto' => 'teste',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        AvaliacoesNotas::where('id', ['1','2','3','4','5','6'])->delete();
        Schema::drop('avaliacoes_notas');
    }
}
