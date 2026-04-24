<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    //
    protected $table = "equipamento";
    public $incrementing = true;

    protected $fillable = ['nome', 'marca', 'modelo', 'image_path', 'ano', 'capacidade', 'preco_periodo', 'disponibilidade_calendario', 'regiao', 'exige_operador_certificado', 'seguro_obrigatorio', 'caucao_obrigatoria', 'locador_id', 'categoria_id'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
    }
    public function locador()
    {
        return $this->belongsTo(User::class, 'locador_id', 'id');
    }
}
