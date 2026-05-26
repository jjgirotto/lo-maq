<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['titulo' => 'Escavadeiras'],
            ['titulo' => 'Retroescavadeiras'],
            ['titulo' => 'Pás Carregadeiras'],
            ['titulo' => 'Motoniveladoras'],
            ['titulo' => 'Rolos Compactadores'],
            ['titulo' => 'Tratores Agrícolas'],
            ['titulo' => 'Pulverizadores'],
            ['titulo' => 'Colheitadeiras'],
            ['titulo' => 'Plataformas Elevatórias'],
            ['titulo' => 'Caminhões Basculantes'],
            ['titulo' => 'Mini Escavadeiras'],
            ['titulo' => 'Perfuratrizes'],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}
