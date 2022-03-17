<?php

use App\Models\Disciplinas;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisciplinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disciplinas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_professor')->unsigned();
            $table->foreign('id_professor')->references('id')->on('users');
            $table->string('nm_disciplina');
            $table->engine = 'InnoDB';
            $table->timestamps();
        });

        Disciplinas::create([
            'id' => '1',
            'id_professor' => '2',
            'nm_disciplina' => 'Disciplina 1'
        ]);

        Disciplinas::create([
            'id' => '2',
            'id_professor' => '2',
            'nm_disciplina' => 'Disciplina 2'
        ]);

        Disciplinas::create([
            'id' => '3',
            'id_professor' => '4',
            'nm_disciplina' => 'Disciplina 3'
        ]);

        Disciplinas::create([
            'id' => '4',
            'id_professor' => '4',
            'nm_disciplina' => 'Disciplina 4'
        ]);

        Disciplinas::create([
            'id' => '5',
            'id_professor' => '2',
            'nm_disciplina' => 'Disciplina 5'
        ]);

        Disciplinas::create([
            'id' => '6',
            'id_professor' => '2',
            'nm_disciplina' => 'Disciplina 6'
        ]);

        Disciplinas::create([
            'id' => '7',
            'id_professor' => '4',
            'nm_disciplina' => 'Disciplina 7'
        ]);

        Disciplinas::create([
            'id' => '8',
            'id_professor' => '4',
            'nm_disciplina' => 'Disciplina 8'
        ]);

        Disciplinas::create([
            'id' => '8',
            'id_professor' => '4',
            'nm_disciplina' => 'Disciplina 9'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Disciplinas::whereIn('id', ['1','2','3','4','5','6','7','8'])->delete();
        Schema::drop('disciplinas');
    }
}
