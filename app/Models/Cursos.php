<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    protected $table = 'cursos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nm_curso'
    ];

    public function turmas()
    {
        return $this->hasMany('App\Models\Turma', 'id_curso');
    }

    /**
     * Get the phone record associated with the user.
     */
    public function formularios()
    {
        return $this->hasOne('App\Models\Formularios', 'id_curso');
    }
}
