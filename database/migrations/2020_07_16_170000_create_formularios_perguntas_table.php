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

        $formularios = DB::table('formularios')->get();

        foreach ($formularios as $formulario) {

            for ($i=1; $i<=6; $i++) {

                $tipo = 'notas';

                if ($i <= 2) {
                    $bloco = 'DP';
                } else if ($i <= 4) {
                    $bloco = 'IA';
                } else {
                    $bloco = 'O';
                    $tipo = 'texto';
                }

                FormulariosPerguntas::create([
                    'id_formulario' => $formulario->id,
                    'ordem' => $i,
                    'titulo' => 'Pergunta '.$i.' do '.$formulario->name,
                    'tipo' => $tipo,
                    'bloco' => $bloco,
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        FormulariosPerguntas::truncate();
        Schema::drop('formularios_perguntas');
    }
}
