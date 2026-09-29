<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $hoje = Carbon::today();

        // [nome, descrição, dias a partir de hoje, horário, tipo, local, concluída]
        $tarefas = [
            ['Estudar MySQL',            'Revisar INSERT, SELECT e UPDATE',        0, '19:30', 'Estudo',   'Casa',        false],
            ['Fazer trabalho de Laravel','Finalizar listagem e cadastro',          1, '20:00', 'Estudo',   'Casa',        false],
            ['Organizar quarto',         'Guardar roupas e limpar a mesa',         1, '15:00', 'Limpeza',  'Casa',        true],
            ['Reunião do projeto',       'Alinhar entregas com o grupo',           2, '10:00', 'Trabalho', 'Escola',      false],
            ['Pizza com o Guizo',        'Comer pizza no fim de semana',           3, '19:00', 'Lazer',    'Casa',        false],
            ['Consulta de rotina',       'Check-up anual',                         5, '08:30', 'Saúde',    'Clínica',     false],
            ['Entregar relatório',       'Enviar relatório final da disciplina',  -2, '23:00', 'Trabalho', 'Online',      true],
            ['Caminhada no parque',      '40 minutos de caminhada leve',          -1, '07:00', 'Saúde',    'Parque',      true],
        ];

        foreach ($tarefas as [$nome, $desc, $dias, $hora, $tipo, $local, $concluida]) {
            $data = $hoje->copy()->addDays($dias)->toDateString();

            Task::updateOrCreate(
                ['nome_tarefa' => $nome, 'data_inicio' => $data],
                [
                    'descricao_tarefa' => $desc,
                    'horario_tarefa'   => $hora . ':00',
                    'tipo_tarefa'      => $tipo,
                    'local_tarefa'     => $local,
                    'concluida'        => $concluida,
                ]
            );
        }
    }
}
