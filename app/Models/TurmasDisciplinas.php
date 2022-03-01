<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TurmasDisciplinas extends Model
{
    protected $table = 'turmas_disciplinas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'turma_id',
        'disciplina_id',
    ];
}
