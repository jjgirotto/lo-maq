<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $table = "avaliacoes";
    public $incrementing = true;

    // Campos atualizados para usar usuario_id
    protected $fillable = ['nota', 'comentario', 'estado_equipamento', 'cumprimento_contrato', 'locacao_id', 'usuario_id'];

    public function locacao()
    {
        return $this->belongsTo(Locacao::class, "locacao_id", "id");
    }
    
    public function usuario()
    {
        // Relacionamento aponta para usuario_id
        return $this->belongsTo(User::class, "usuario_id", "id");
    }
}