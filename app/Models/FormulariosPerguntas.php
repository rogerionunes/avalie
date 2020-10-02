<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormulariosPerguntas extends Model
{
    protected $table = 'formularios_perguntas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_formulario', 'ordem', 'titulo', 'tipo', 'bloco'
    ];
}
