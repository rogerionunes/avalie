<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvaliacoesNotas extends Model
{
    protected $table = 'avaliacoes_notas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'avaliacao_id', 'pergunta_id', 'nota', 'texto'
    ];

    /**
     * Get the phone record associated with the user.
     */
    public function avaliacao()
    {
        return $this->hasOne('App\Models\Avaliacoes', 'avaliacao_id');
    }

    /**
     * Get the phone record associated with the user.
     */
    public function pergunta()
    {
        return $this->hasOne('App\Models\Formularios_Perguntas', 'pergunta_id');
    }
}
