<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocatarioDaLocacao extends Model
{
    protected $table = "participantes_locacao";
    public $incrementing = true;

    // Trocámos 'locatario_id' por 'usuario_id' para bater com o banco
    protected $fillable = ['data_inicio', 'data_fim', 'valor_individual', 'status_pagamento', 'locacao_id', 'usuario_id'];

    public function locacao()
    {
        return $this->belongsTo(Locacao::class, "locacao_id", "id");
    }
    
    public function locatario()
    {
        // A chave no banco agora é 'usuario_id'
        return $this->belongsTo(User::class, "usuario_id", "id");
    }
}