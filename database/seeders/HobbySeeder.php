<?php

namespace Database\Seeders;

use App\Models\Hobby;
use Illuminate\Database\Seeder;

class HobbySeeder extends Seeder
{
    public function run(): void
    {
        // Categorias usadas pela interface: Aprendizado, Criativo, Bem-estar, Fitness
        $hobbies = [
            ['Leitura',   '20 min por dia',     'Aprendizado'],
            ['Idiomas',   '15 min por dia',     'Aprendizado'],
            ['Desenho',   '30 min por dia',     'Criativo'],
            ['Fotografia','1x por semana',      'Criativo'],
            ['Yoga',      '2x por semana',      'Bem-estar'],
            ['Meditação', '10 min por dia',     'Bem-estar'],
            ['Treinar',   '4x por semana',      'Fitness'],
            ['Caminhada', '3x por semana',      'Fitness'],
        ];

        foreach ($hobbies as [$nome, $meta, $categoria]) {
            Hobby::updateOrCreate(
                ['nome_hobby' => $nome],
                ['meta' => $meta, 'categoria' => $categoria]
            );
        }
    }
}
