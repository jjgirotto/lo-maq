<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locacao extends Model
{
    protected $table = "locacoes";
    public $incrementing = true;

    protected $fillable = ['data_inicio', 'data_fim', 'status_equipamento', 'tipo_locacao', 'valor_total', 'status_pagamento','equipamento_id','created_by'];

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class, "equipamento_id", "id");
    }
}
