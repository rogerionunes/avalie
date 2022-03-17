<?php

use App\Models\Cursos;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nm_curso');
            $table->timestamps();
        });

        // Cursos::create([
        //     'id' => '1',
        //     'nm_curso' => 'Engenharia de Softwares'
        // ]);

        // Cursos::create([
        //     'id' => '2',
        //     'nm_curso' => 'Aplicações Web'
        // ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Cursos::whereIn('id', ['2', '1'])->delete();
        Schema::drop('cursos');
    }
}
