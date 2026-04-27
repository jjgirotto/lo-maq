<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@lomaq.com',
            'password' => Hash::make('123456'),
            'access' => 'ADM'
        ]);

        // Alguns locatários de exemplo
        $locatarios = [
            [
                'name' => 'João Silva',
                'email' => 'joao@email.com',
                'password' => Hash::make('123456'),
                'access' => 'CLI'
            ],
            [
                'name' => 'Maria Santos',
                'email' => 'maria@email.com',
                'password' => Hash::make('123456'),
                'access' => 'CLI'
            ],
            [
                'name' => 'Pedro Oliveira',
                'email' => 'pedro@email.com',
                'password' => Hash::make('123456'),
                'access' => 'CLI'
            ]
        ];

        foreach ($locatarios as $locatario) {
            User::create($locatario);
        }
    }
}
