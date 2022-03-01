<?php

use App\Models\TurmasDisciplinas;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurmasDisciplinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turmas_disciplinas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('turma_id')->unsigned();
            $table->foreign('turma_id')->references('id')->on('turmas');
            $table->integer('disciplina_id')->unsigned();
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');
            $table->engine = 'InnoDB';
            $table->timestamps();
        });

        TurmasDisciplinas::create([
            'id' => '1',
            'turma_id' => '1',
            'disciplina_id' => '1'
        ]);

        TurmasDisciplinas::create([
            'id' => '2',
            'turma_id' => '1',
            'disciplina_id' => '2'
        ]);

        TurmasDisciplinas::create([
            'id' => '3',
            'turma_id' => '1',
            'disciplina_id' => '3'
        ]);

        TurmasDisciplinas::create([
            'id' => '4',
            'turma_id' => '2',
            'disciplina_id' => '1'
        ]);

        TurmasDisciplinas::create([
            'id' => '5',
            'turma_id' => '2',
            'disciplina_id' => '2'
        ]);

        TurmasDisciplinas::create([
            'id' => '6',
            'turma_id' => '2',
            'disciplina_id' => '3'
        ]);

        TurmasDisciplinas::create([
            'id' => '7',
            'turma_id' => '3',
            'disciplina_id' => '4'
        ]);

        TurmasDisciplinas::create([
            'id' => '8',
            'turma_id' => '3',
            'disciplina_id' => '5'
        ]);

        TurmasDisciplinas::create([
            'id' => '9',
            'turma_id' => '3',
            'disciplina_id' => '6'
        ]);

        TurmasDisciplinas::create([
            'id' => '10',
            'turma_id' => '4',
            'disciplina_id' => '5'
        ]);

        TurmasDisciplinas::create([
            'id' => '11',
            'turma_id' => '4',
            'disciplina_id' => '6'
        ]);

        TurmasDisciplinas::create([
            'id' => '12',
            'turma_id' => '4',
            'disciplina_id' => '7'
        ]);

        TurmasDisciplinas::create([
            'id' => '13',
            'turma_id' => '4',
            'disciplina_id' => '8'
        ]);

        TurmasDisciplinas::create([
            'id' => '14',
            'turma_id' => '1',
            'disciplina_id' => '9'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        TurmasDisciplinas::whereIn('id', ['1','2','3','4','5','6','7','8','9','10','11','12','13','14'])->delete();
        Schema::drop('turmas_disciplinas');
    }
}
