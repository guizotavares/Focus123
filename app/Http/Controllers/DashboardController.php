<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Hobby;
use App\Models\Diary;

class DashboardController extends Controller
{
    /**
     * Exibe o dashboard com 4 gráficos alimentados pelo banco de dados.
     */
    public function index()
    {
        // Este arquivo faltava em app/Http/Controllers/ — sem ele, a rota
        // /dashboard (definida em routes/web.php) causa erro fatal
        // "Class DashboardController not found".
        // 1) GRÁFICO DE PIZZA — Tarefas agrupadas por Tipo (tipo_tarefa)
        $tarefasPorTipo = Task::select('tipo_tarefa')
            ->selectRaw('count(*) as total')
            ->whereNotNull('tipo_tarefa')
            ->groupBy('tipo_tarefa')
            ->get();

        // 2) GRÁFICO DE BARRAS — Hobbies agrupados por Categoria
        $hobbiesPorCategoria = Hobby::select('categoria')
            ->selectRaw('count(*) as total')
            ->whereNotNull('categoria')
            ->groupBy('categoria')
            ->get();

        // 3) GRÁFICO DE LINHA — Quantidade de tarefas criadas por data
        $tarefasPorData = Task::select('data_inicio')
            ->selectRaw('count(*) as total')
            ->whereNotNull('data_inicio')
            ->groupBy('data_inicio')
            ->orderBy('data_inicio')
            ->get();

        // 4) GRÁFICO DE ROSCA (DONUT) — Entradas do Diário por Sentimento
        $diarioPorSentimento = Diary::select('feeling_diary')
            ->selectRaw('count(*) as total')
            ->whereNotNull('feeling_diary')
            ->groupBy('feeling_diary')
            ->get();

        return view('dashboard.index', compact(
            'tarefasPorTipo',
            'hobbiesPorCategoria',
            'tarefasPorData',
            'diarioPorSentimento'
        ));
    }
}
