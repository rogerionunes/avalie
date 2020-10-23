<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formularios extends Model
{
    protected $table = 'formularios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_curso', 'descricao_avaliacao', 'ativo'
    ];

    /**
     * Get the phone record associated with the user.
     */
    public function formulariosPerguntas()
    {
        return $this->hasMany('App\Models\FormulariosPerguntas', 'id_formulario')->orderBy('ordem');
    }
}
