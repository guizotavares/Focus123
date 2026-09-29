<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /** Senha de todos os usuários de teste: 123456 */
    public function run(): void
    {
        $usuarios = [
            ['Maria Eduarda',  'mary@focus.com',      '11111111111', '11999990001', '2005-04-01'],
            ['Ana Beatriz',    'beatriz@gmail.com',   '12345678901', '11987654321', '2005-08-12'],
            ['Pedro Henrique', 'pedro@gmail.com',     '98765432109', '11976543210', '2004-03-25'],
            ['Mariana Lima',   'mariana@gmail.com',   '45678912300', '11965432109', '2006-11-18'],
        ];

        foreach ($usuarios as [$nome, $email, $cpf, $telefone, $nasc]) {
            Usuario::updateOrCreate(
                ['email' => $email],
                [
                    'name'      => $nome,
                    'password'  => Hash::make('123456'),
                    'cpf'       => $cpf,
                    'telefone'  => $telefone,
                    'data_nasc' => $nasc,
                ]
            );
        }
    }
}
