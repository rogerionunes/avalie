<?php

use App\Models\FormulariosPerguntas;
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
            $table->id();
            $table->foreignId('id_formulario');
            $table->foreign('id_formulario')->references('id')->on('formularios');
            $table->integer('ordem');
            $table->string('titulo');
            $table->enum('tipo', ['notas','opcoes','texto']);
            $table->enum('bloco', ['DP','IA','O']);
            $table->timestamps();
        });

        // FormulariosPerguntas::create([
        //     'id' => '1',
        //     'id_formulario' => '1',
        //     'ordem' => '1',
        //     'titulo' => 'pergunta 1?',
        //     'tipo' => 'notas',
        //     'bloco' => 'DP',
        // ]);

        // FormulariosPerguntas::create([
        //     'id' => '2',
        //     'id_formulario' => '1',
        //     'ordem' => '2',
        //     'titulo' => 'pergunta 2?',
        //     'tipo' => 'notas',
        //     'bloco' => 'DP',
        // ]);

        // FormulariosPerguntas::create([
        //     'id' => '3',
        //     'id_formulario' => '1',
        //     'ordem' => '3',
        //     'titulo' => 'pergunta 3?',
        //     'tipo' => 'notas',
        //     'bloco' => 'IA',
        // ]);

        // FormulariosPerguntas::create([
        //     'id' => '4',
        //     'id_formulario' => '1',
        //     'ordem' => '4',
        //     'titulo' => 'pergunta 4?',
        //     'tipo' => 'notas',
        //     'bloco' => 'IA',
        // ]);

        // FormulariosPerguntas::create([
        //     'id' => '5',
        //     'id_formulario' => '1',
        //     'ordem' => '5',
        //     'titulo' => 'pergunta 5?',
        //     'tipo' => 'texto',
        //     'bloco' => 'O',
        // ]);

        // FormulariosPerguntas::create([
        //     'id' => '6',
        //     'id_formulario' => '1',
        //     'ordem' => '6',
        //     'titulo' => 'pergunta 6?',
        //     'tipo' => 'texto',
        //     'bloco' => 'O',
        // ]);

        // FormulariosPerguntas::create([
        //     'id' => '1',
        //     'id_formulario' => '2',
        //     'ordem' => '1',
        //     'titulo' => 'pergunta 1?',
        //     'tipo' => 'notas',
        //     'bloco' => 'DP',
        // ]);

        // FormulariosPerguntas::create([
        //     'id' => '2',
        //     'id_formulario' => '2',
        //     'ordem' => '2',
        //     'titulo' => 'pergunta 2?',
        //     'tipo' => 'notas',
        //     'bloco' => 'DP',
        // ]);

        // FormulariosPerguntas::create([
        //     'id' => '3',
        //     'id_formulario' => '2',
        //     'ordem' => '3',
        //     'titulo' => 'pergunta 3?',
        //     'tipo' => 'notas',
        //     'bloco' => 'IA',
        // ]);

        // FormulariosPerguntas::create([
        //     'id' => '4',
        //     'id_formulario' => '2',
        //     'ordem' => '4',
        //     'titulo' => 'pergunta 4?',
        //     'tipo' => 'notas',
        //     'bloco' => 'IA',
        // ]);

        // FormulariosPerguntas::create([
        //     'id' => '5',
        //     'id_formulario' => '2',
        //     'ordem' => '5',
        //     'titulo' => 'pergunta 5?',
        //     'tipo' => 'texto',
        //     'bloco' => 'O',
        // ]);

        // FormulariosPerguntas::create([
        //     'id' => '6',
        //     'id_formulario' => '2',
        //     'ordem' => '6',
        //     'titulo' => 'pergunta 6?',
        //     'tipo' => 'texto',
        //     'bloco' => 'O',
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // FormulariosPerguntas::whereIn('id', ['1','2','3','4','5','6'])->delete();
        Schema::drop('formularios_perguntas');
    }
}
