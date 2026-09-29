<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = [
            ['Guizo Admin',   'guizo@focus.com'],
            ['Joaquim Silva', 'joaquim@focus.com'],
            ['Ana Beatriz',   'ana@focus.com'],
            ['Marcelo Souza', 'marcelo@focus.com'],
            ['Yuri Alberto',  'yuri@focus.com'],
        ];

        foreach ($usuarios as [$nome, $email]) {
            User::updateOrCreate(
                ['email' => $email],
                ['name' => $nome, 'password' => Hash::make('123456')]
            );
        }
    }
}
