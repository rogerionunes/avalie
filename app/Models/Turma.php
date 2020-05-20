<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    protected $table = 'turmas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_curso',
        'nm_turma',
        'ano',
        'status',
        'semestre',
        'turno',
    ];

    public function disciplinas()
    {
        return $this->hasMany(Disciplinas::class, 'id_turma');
    }
}
