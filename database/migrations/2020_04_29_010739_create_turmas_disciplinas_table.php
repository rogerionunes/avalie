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
            $table->id();
            $table->foreignId('turma_id');
            $table->foreign('turma_id')->references('id')->on('turmas');
            $table->foreignId('disciplina_id');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');
            $table->engine = 'InnoDB';
            $table->timestamps();
        });

        $turmas = DB::table('turmas')->get();
        $disciplinas = DB::table('disciplinas')->get();

        foreach ($turmas as $t => $turma) {

            foreach ($disciplinas as $d => $disciplina) {

                if ($t <= 1 && $d <= 5) {
                    TurmasDisciplinas::create([
                        'turma_id' => $turma->id,
                        'disciplina_id' => $disciplina->id
                    ]);
                } elseif (($t >= 1 && $t <= 3) && ($d > 3 && $d <=7)) {
                    TurmasDisciplinas::create([
                        'turma_id' => $turma->id,
                        'disciplina_id' => $disciplina->id
                    ]);
                } elseif (($t >= 3 && $t <= 5) && ($d >= 5 && $d <=11)) {
                    TurmasDisciplinas::create([
                        'turma_id' => $turma->id,
                        'disciplina_id' => $disciplina->id
                    ]);
                }
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
        TurmasDisciplinas::truncate();
        Schema::drop('turmas_disciplinas');
    }
}
