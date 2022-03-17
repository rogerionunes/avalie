<?php

use App\Models\Turmas;
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
            $table->id();
            $table->foreignId('id_curso');
            $table->foreign('id_curso')->references('id')->on('cursos');
            $table->string('nm_turma');
            $table->string('ano');
            $table->enum('status', ['0','1']);
            $table->enum('semestre', ['1','2']);
            $table->enum('turno', ['M','T','N']);
            $table->timestamps();
        });

        $cursos = DB::table('cursos')->get();

        foreach ($cursos as $curso) {

            for ($i; $i<=5; $i++) {
                Turmas::create([
                    'id_curso' => $curso->id,
                    'nm_turma' => 'Turma '.$i,
                    'ano' => '2022',
                    'status' => '1',
                    'semestre' => '1',
                    'turno' => 'M',
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
        Turmas::truncate();
        Schema::drop('turmas');
    }
}
