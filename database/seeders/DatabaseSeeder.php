<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,     // tabela users
            UsuarioSeeder::class,  // tabela usuarios (login do app)
            TaskSeeder::class,     // tabela tasks
            HobbySeeder::class,    // tabela hobbies
            DiarySeeder::class,    // tabela diary
        ]);
    }
}
