<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //
    protected $table = 'categorias';
    public $incrementing = true;

    protected $fillable = ['titulo','equipamento_id'];

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class, 'equipamento_id', 'id');

    }
}

