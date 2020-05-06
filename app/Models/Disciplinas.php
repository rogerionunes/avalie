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
        'nm_disciplina'
    ];

    public function professores() {
        return $this->hasOne(Users::class);
    }
}
