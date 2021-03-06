<?php

use App\Models\Avaliacoes;
use App\Models\AvaliacoesNotas;
use App\Models\Cursos;
use App\Models\Disciplinas;
use App\Models\Formularios;
use App\Models\FormulariosPerguntas;
use App\Models\Turmas;
use App\Models\Users;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('tp_usuario', ['P', 'C', 'S']);
            $table->timestamps();
        });

        Users::create([
            'id' => '1',
            'name' => 'Rogerio Nunes',
            'email' => 'rogerio@gmail.com',
            'password' => Hash::make('123456'),
            'tp_usuario' => 'C'
        ]);

        Users::create([
            'id' => '2',
            'name' => 'Alexandre Barbosa',
            'email' => 'alexandre@gmail.com',
            'password' => Hash::make('123456'),
            'tp_usuario' => 'P'
        ]);

        Users::create([
            'id' => '3',
            'name' => 'Francisco Henrique',
            'email' => 'francisco@gmail.com',
            'password' => Hash::make('123456'),
            'tp_usuario' => 'C'
        ]);

        Users::create([
            'id' => '4',
            'name' => 'Accacio Valente',
            'email' => 'accacio@gmail.com',
            'password' => Hash::make('123456'),
            'tp_usuario' => 'P'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Users::whereIn('id', ['1','2','3','4'])->delete();
        Schema::drop('users');
    }
}
