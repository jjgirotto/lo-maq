<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Equipamento;
use App\Models\User;
use Illuminate\Database\Seeder;

class EquipamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipamentos = [
            [
                'nome' => 'Escavadeira Hidráulica 20T',
                'marca' => 'Caterpillar',
                'modelo' => '320D',
                'ano' => 2021,
                'capacidade' => '20 toneladas',
                'preco_periodo' => 850.00,
                'disponibilidade_calendario' => '-',
                'regiao' => 'São Paulo - SP',
                'exige_operador_certificado' => true,
                'seguro_obrigatorio' => true,
                'caucao_obrigatoria' => true,
                'locador_email' => 'joao@email.com',
                'categoria_titulo' => 'Escavadeiras',
            ],
            [
                'nome' => 'Retroescavadeira 4x4',
                'marca' => 'Case',
                'modelo' => '580N',
                'ano' => 2019,
                'capacidade' => '1,1 m³',
                'preco_periodo' => 620.00,
                'disponibilidade_calendario' => '-',
                'regiao' => 'Campinas - SP',
                'exige_operador_certificado' => true,
                'seguro_obrigatorio' => true,
                'caucao_obrigatoria' => false,
                'locador_email' => 'joao@email.com',
                'categoria_titulo' => 'Retroescavadeiras',
            ],
            [
                'nome' => 'Pá Carregadeira Frontal',
                'marca' => 'Volvo',
                'modelo' => 'L90H',
                'ano' => 2020,
                'capacidade' => '3,4 m³',
                'preco_periodo' => 780.00,
                'disponibilidade_calendario' => '-',
                'regiao' => 'Ribeirão Preto - SP',
                'exige_operador_certificado' => true,
                'seguro_obrigatorio' => true,
                'caucao_obrigatoria' => true,
                'locador_email' => 'maria@email.com',
                'categoria_titulo' => 'Pás Carregadeiras',
            ],
            [
                'nome' => 'Motoniveladora 140K',
                'marca' => 'Caterpillar',
                'modelo' => '140K',
                'ano' => 2018,
                'capacidade' => '4,3 m',
                'preco_periodo' => 950.00,
                'disponibilidade_calendario' => '-',
                'regiao' => 'Sorocaba - SP',
                'exige_operador_certificado' => true,
                'seguro_obrigatorio' => false,
                'caucao_obrigatoria' => true,
                'locador_email' => 'maria@email.com',
                'categoria_titulo' => 'Motoniveladoras',
            ],
            [
                'nome' => 'Rolo Compactador Tandem',
                'marca' => 'Dynapac',
                'modelo' => 'CC1200',
                'ano' => 2022,
                'capacidade' => '12 toneladas',
                'preco_periodo' => 540.00,
                'disponibilidade_calendario' => '-',
                'regiao' => 'Santos - SP',
                'exige_operador_certificado' => false,
                'seguro_obrigatorio' => true,
                'caucao_obrigatoria' => false,
                'locador_email' => 'pedro@email.com',
                'categoria_titulo' => 'Rolos Compactadores',
            ],
        ];

        foreach ($equipamentos as $equipamento) {
            $locador = User::where('email', $equipamento['locador_email'])->firstOrFail();
            $categoria = Categoria::where('titulo', $equipamento['categoria_titulo'])->firstOrFail();

            Equipamento::create([
                'nome' => $equipamento['nome'],
                'marca' => $equipamento['marca'],
                'modelo' => $equipamento['modelo'],
                'ano' => $equipamento['ano'],
                'capacidade' => $equipamento['capacidade'],
                'preco_periodo' => $equipamento['preco_periodo'],
                'disponibilidade_calendario' => $equipamento['disponibilidade_calendario'],
                'regiao' => $equipamento['regiao'],
                'exige_operador_certificado' => $equipamento['exige_operador_certificado'],
                'seguro_obrigatorio' => $equipamento['seguro_obrigatorio'],
                'caucao_obrigatoria' => $equipamento['caucao_obrigatoria'],
                'locador_id' => $locador->id,
                'categoria_id' => $categoria->id,
            ]);
        }
    }
}
