<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disciplinas extends Model
{
    protected $table = 'disciplinas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_professor',
        'id_turma',
        'nm_disciplina'
    ];

    /**
     * Get the phone record associated with the user.
     */
    public function turmas()
    {
        return $this->hasOne('App\Models\Turmas', 'id');
    }
}
