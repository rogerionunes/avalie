<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avaliacoes extends Model
{
    protected $table = 'avaliacoes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_professor', 
        'id_curso', 
        'id_turma', 
        'id_disciplina', 
        'pin', 
        'dataValidade', 
        'status', 
        'created_at'
    ];

    /**
     * Get the phone record associated with the user.
     */
    public function professor()
    {
        return $this->hasOne('App\Models\Users', 'id');
    }

    /**
     * Get the phone record associated with the user.
     */
    public function curso()
    {
        return $this->hasOne('App\Models\Cursos', 'id');
    }
}
