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
            $table->foreignId('id_professor');
            $table->foreign('id_professor')->references('id')->on('users');
            $table->string('nm_disciplina');
            $table->engine = 'InnoDB';
            $table->timestamps();
        });

        $users = DB::table('users')->where('tp_usuario', 'P')->get();

        foreach ($users as $user) {

            for ($i=1; $i<=10; $i++) {
                Disciplinas::create([
                    'id_professor' => $user->id,
                    'nm_disciplina' => 'Disciplina '.$i,
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
        Disciplinas::truncate();
        Schema::drop('disciplinas');
    }
}
