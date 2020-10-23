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
            $table->increments('id');
            $table->integer('id_curso')->unsigned();
            $table->foreign('id_curso')->references('id')->on('cursos');
            $table->string('nm_turma');
            $table->string('ano');
            $table->enum('status', ['0','1']);
            $table->enum('semestre', ['1','2']);
            $table->enum('turno', ['M','T','N']);
            $table->timestamps();
        });

        Turmas::create([
            'id' => '1',
            'id_curso' => '1',
            'nm_turma' => 'Turma 1',
            'ano' => '2020',
            'status' => '1',
            'semestre' => '1',
            'turno' => 'M',
        ]);

        Turmas::create([
            'id' => '2',
            'id_curso' => '1',
            'nm_turma' => 'Turma 2',
            'ano' => '2019',
            'status' => '0',
            'semestre' => '2',
            'turno' => 'N',
        ]);

        Turmas::create([
            'id' => '3',
            'id_curso' => '2',
            'nm_turma' => 'Turma 3',
            'ano' => '2020',
            'status' => '1',
            'semestre' => '1',
            'turno' => 'M',
        ]);

        Turmas::create([
            'id' => '4',
            'id_curso' => '2',
            'nm_turma' => 'Turma 4',
            'ano' => '2019',
            'status' => '0',
            'semestre' => '2',
            'turno' => 'N',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Turmas::where('id', ['1','2','3','4'])->delete();
        Schema::drop('turmas');
    }
}
