<?php

namespace Database\Seeders;

use App\Models\Diary;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DiarySeeder extends Seeder
{
    public function run(): void
    {
        $hoje = Carbon::today();

        // Sentimentos usados pela interface:
        // Feliz, Triste, Emocionante, Estressante, Ansioso, Tedioso, Animado, Normal
        // [título, dias atrás, sentimento, descrição (máx. 255 caracteres)]
        $entradas = [
            ['Dia produtivo',          0, 'Feliz',       'Terminei várias atividades e fiquei satisfeita com meu desempenho.'],
            ['Cansada, mas bem',       1, 'Normal',      'O dia foi corrido, mas consegui organizar minhas tarefas.'],
            ['Apresentação na escola', 2, 'Ansioso',     'Fiquei nervosa antes da apresentação, mas deu tudo certo no final.'],
            ['Semana de provas',       3, 'Estressante', 'Muito conteúdo para revisar e pouco tempo.'],
            ['Passeio com amigos',     4, 'Animado',     'Fomos ao parque e ao cinema. Foi ótimo espairecer.'],
            ['Sábado parado',          5, 'Tedioso',     'Não tive vontade de fazer nada e o dia demorou a passar.'],
            ['Notícia inesperada',     6, 'Emocionante', 'Recebi uma notícia boa que eu estava esperando havia semanas.'],
            ['Dia difícil',            7, 'Triste',      'Senti saudade de casa e o dia foi mais pesado que o normal.'],
        ];

        foreach ($entradas as [$titulo, $diasAtras, $sentimento, $descricao]) {
            Diary::updateOrCreate(
                [
                    'title_diary' => $titulo,
                    'date_diary'  => $hoje->copy()->subDays($diasAtras)->toDateString(),
                ],
                [
                    'feeling_diary'   => $sentimento,
                    'descricao_diary' => $descricao,
                ]
            );
        }
    }
}
