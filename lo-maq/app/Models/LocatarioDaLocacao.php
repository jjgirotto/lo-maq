<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocatarioDaLocacao extends Model
{
    protected $table = "locatariosdalocacao";
    public $incrementing = true;

    protected $fillable = ['data_inicio', 'data_fim', 'valor_individual', 'status_pagamento', 'locacao_id', 'locatario_id'];

    public function locacao()
    {
        return $this->belongsTo(Locacao::class, "locacao_id", "id");
    }
    public function locatario()
    {
        return $this->belongsTo(User::class, "locatario_id", "id");
    }
}
