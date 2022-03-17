<?php

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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('tp_usuario', ['P', 'C', 'S']);
            $table->timestamps();
        });

        Users::create([
            'name' => 'Super Usuário',
            'email' => 'superusuario@gmail.com',
            'password' => Hash::make('123456'),
            'tp_usuario' => 'S'
        ]);

        Users::create([
            'name' => 'Coordenador 1',
            'email' => 'coordenador1@gmail.com',
            'password' => Hash::make('123456'),
            'tp_usuario' => 'C'
        ]);

        Users::create([
            'name' => 'Coordenador 2',
            'email' => 'coordenador2@gmail.com',
            'password' => Hash::make('123456'),
            'tp_usuario' => 'C'
        ]);

        Users::create([
            'name' => 'Professor 1',
            'email' => 'professor1@gmail.com',
            'password' => Hash::make('123456'),
            'tp_usuario' => 'P'
        ]);

        Users::create([
            'name' => 'Professor 2',
            'email' => 'professor2@gmail.com',
            'password' => Hash::make('123456'),
            'tp_usuario' => 'P'
        ]);

        Users::create([
            'name' => 'Professor 3',
            'email' => 'professor3@gmail.com',
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
        Users::truncate();
        Schema::drop('users');
    }
}
