<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locacao extends Model
{
    protected $table = "locacoes";
    public $incrementing = true;

    protected $fillable = ['data_inicio', 'data_fim', 'valor_total', 'status_pagamento', 'equipamento_id', 'usuario_id', 'created_by'];

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class, "equipamento_id", "id");
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }

    public function locador()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function participantes()
    {
        return $this->hasMany(LocatarioDaLocacao::class, 'locacao_id', 'id');
    }

    public static function statusPagamentoAtivo(mixed $value): bool
    {
        return in_array($value, ['1', 1, 'sim', 'Sim', 'SIM', 's', 'S', true], true);
    }

    public function statusPagamentoLabel(): string
    {
        return self::statusPagamentoAtivo($this->status_pagamento) ? 'Sim' : 'Não';
    }
}
