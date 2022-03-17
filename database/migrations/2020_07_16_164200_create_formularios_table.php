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
            $table->id();
            $table->foreignId('id_curso');
            $table->foreign('id_curso')->references('id')->on('cursos');
            $table->string('name');
            $table->text('descricao_avaliacao');
            $table->enum('ativo', ['1','0']);
            $table->timestamps();
        });

        $cursos = DB::table('cursos')->get();

        foreach ($cursos as $curso) {

            for ($i=1; $i<=2; $i++) {
                Formularios::create([
                    'id_curso' => $curso->id,
                    'name' => 'Formulário '.$i,
                    'descricao_avaliacao' => 'Seja bem vindo alunos do curso '.$curso->nm_curso,
                    'ativo' => '1',
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
        Formularios::truncate();
        Schema::drop('formularios');
    }
}
