<?php

use App\Models\Formularios;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formularios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_curso')->unsigned();
            $table->foreign('id_curso')->references('id')->on('cursos');
            $table->string('descricao_avaliacao');
            $table->enum('ativo', ['1','0']);
            $table->timestamps();
        });

        Formularios::create([
            'id' => '1',
            'id_curso' => '1',
            'descricao_avaliacao' => 'Seja bem vindo aluno do curso 1',
            'ativo' => '1',
        ]);

        Formularios::create([
            'id' => '2',
            'id_curso' => '2',
            'descricao_avaliacao' => 'Seja bem vindo aluno do curso 2',
            'ativo' => '1',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Formularios::where('id', ['1','2'])->delete();
        Schema::drop('formularios');
    }
}
