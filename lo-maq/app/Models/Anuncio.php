<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    protected $table = 'anuncios';
    public $incrementing = true;

    // Campos básicos para o formulário; você pode ajustar depois
    protected $fillable = [
        'nome',
        'equipamento_id',
        'valor_diaria',
        'regiao',
        'user_id'
    ];

    // Relacionamento com User (criador do anúncio)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacionamento com Equipamento
    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }
}
