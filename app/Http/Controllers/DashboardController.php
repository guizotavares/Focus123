<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Hobby;
use App\Models\Diary;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'tarefasPorTipo'      => $this->contarPor(Task::class,  'tipo_tarefa'),
            'hobbiesPorCategoria' => $this->contarPor(Hobby::class, 'categoria'),
            'tarefasPorData'      => $this->contarPor(Task::class,  'data_inicio'),
            'diarioPorSentimento' => $this->contarPor(Diary::class, 'feeling_diary'),
        ]);
    }

    private function contarPor(string $model, string $coluna)
    {
        return $model::select($coluna)
            ->selectRaw('count(*) as total')
            ->whereNotNull($coluna)
            ->groupBy($coluna)
            ->orderBy($coluna)
            ->get();
    }
}