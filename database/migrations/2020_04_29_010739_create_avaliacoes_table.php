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

        Avaliacoes::create([
            'id' => '1',
            'id_professor' => '2',
            'id_curso' => '1',
            'id_turma' => '1',
            'id_disciplina' => '1',
            'pin' => 'BDB181',
            'dataValidade' => '2020-12-31 00:00:00',
            'status' => '1',
        ]);

        Avaliacoes::create([
            'id' => '2',
            'id_professor' => '2',
            'id_curso' => '1',
            'id_turma' => '2',
            'id_disciplina' => '1',
            'pin' => 'ABS987',
            'dataValidade' => '2020-12-31 00:00:00',
            'status' => '0',
        ]);

        Avaliacoes::create([
            'id' => '3',
            'id_professor' => '4',
            'id_curso' => '2',
            'id_turma' => '3',
            'id_disciplina' => '1',
            'pin' => 'JUH213',
            'dataValidade' => '2020-12-31 00:00:00',
            'status' => '1',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Avaliacoes::whereIn('id', ['1','2','3'])->delete();
        Schema::drop('avaliacoes');
    }
}
