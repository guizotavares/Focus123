<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Popula a tabela "users" (usada pelo Laravel Auth / Auth::attempt).
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'       => 'Guizo Admin',
                'email'      => 'guizo@focus.com',
                'password'   => Hash::make('123456'),
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'name'       => 'Joaquim Silva',
                'email'      => 'joaquim@focus.com',
                'password'   => Hash::make('123456'),
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'name'       => 'Ana Beatriz',
                'email'      => 'ana@focus.com',
                'password'   => Hash::make('123456'),
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'name'       => 'Marcelo Souza',
                'email'      => 'marcelo@focus.com',
                'password'   => Hash::make('123456'),
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'name'       => 'Yuri Alberto',
                'email'      => 'yuri@focus.com',
                'password'   => Hash::make('123456'),
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
        ]);
    }
}
