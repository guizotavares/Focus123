<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('data_inicio')->get();
        $tipos = Task::select('tipo_tarefa')->distinct()->get();
        $concluidas = Task::select('concluida')->distinct()->get();

        return view('tasks.index', compact('tasks', 'tipos', 'concluidas'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_tarefa'     => 'required|string|max:255',
            'descricao_tarefa' => 'nullable|string',
            'data_inicio'     => 'nullable|date',
            'horario_tarefa'  => 'nullable|date_format:H:i',
            'tipo_tarefa'     => 'required|string|max:255',
            'local_tarefa'    => 'nullable|string|max:255',
        ], [
            'nome_tarefa.required'       => 'O título é obrigatório.',
            'tipo_tarefa.required'       => 'O tipo é obrigatório.',
            'horario_tarefa.date_format' => 'Horário inválido.',
        ]);

        Task::create([
            'nome_tarefa'      => $request->nome_tarefa,
            'descricao_tarefa' => $request->descricao_tarefa,
            'data_inicio'      => $request->data_inicio,
            'horario_tarefa'   => $request->horario_tarefa,
            'tipo_tarefa'      => $request->tipo_tarefa,
            'local_tarefa'     => $request->local_tarefa,
            'concluida'        => false,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tarefa criada com sucesso!');
    }

    public function show(string $id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'nome_tarefa'      => 'required|string|max:255',
            'descricao_tarefa' => 'nullable|string',
            'data_inicio'      => 'nullable|date',
            'horario_tarefa'   => 'nullable|date_format:H:i',
            'tipo_tarefa'      => 'nullable|string|max:255',
            'local_tarefa'     => 'nullable|string|max:255',
        ], [
            'nome_tarefa.required'       => 'O título é obrigatório.',
            'horario_tarefa.date_format' => 'Horário inválido.',
        ]);

        $task->update([
            'nome_tarefa'      => $request->nome_tarefa,
            'descricao_tarefa' => $request->descricao_tarefa,
            'data_inicio'      => $request->data_inicio,
            'horario_tarefa'   => $request->horario_tarefa,
            'tipo_tarefa'      => $request->tipo_tarefa,
            'local_tarefa'     => $request->local_tarefa,
            'concluida'        => $request->boolean('concluida'),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada com sucesso!');
    }

    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tarefa excluída com sucesso!');
    }


    //Filtros
    public function concluir(string $id)
    {
        $task = Task::findOrFail($id);
        $task->concluida = true;
        $task->save();
        return redirect()->route('tasks.index')->with('success', 'Tarefa marcada como concluída!');
    }

    public function filterTipos(Request $request)
    {
        if ($request->txTipo == 'todas') {
            $tasks = Task::all();
        } else {
            $tasks = Task::where('tipo_tarefa', '=', $request->txTipo)->get();
        }
        $tipos = Task::select('tipo_tarefa')->distinct()->get();
        $concluidas = Task::select('concluida')->distinct()->get();
        return view('tasks.index', compact('tasks', 'tipos', 'concluidas'));
    }

    public function filterConcluidas(Request $request)
    {
        if ($request->txConcluir == 'todas') {
            $tasks = Task::all();
        } else {
            $tasks = Task::where('concluida', '=', $request->txConcluir)->get();
        }
        $tipos = Task::select('tipo_tarefa')->distinct()->get();
        $concluidas = Task::select('concluida')->distinct()->get();
        return view('tasks.index', compact('tasks', 'tipos', 'concluidas'));
    }

    public function filterEntreDatas(Request $request)
    {
        if ($request->data1 == null || $request->data2 == null) {
            $tasks = Task::all();
        } else {
            $tasks = Task::whereBetween('data_inicio', [
                $request->data1,
                $request->data2
            ])->get();
        }

        $tipos = Task::select('tipo_tarefa')->distinct()->get();
        $concluidas = Task::select('concluida')->distinct()->get();

        return view('tasks.index', compact('tasks', 'tipos', 'concluidas'));
    }

    public function filterPorData(Request $request)
    {
        if ($request->data == null) {
            $tasks = Task::all();
        } else {
            $tasks = Task::whereDate('data_inicio', $request->data)->get();
        }

        $tipos = Task::select('tipo_tarefa')->distinct()->get();
        $concluidas = Task::select('concluida')->distinct()->get();

        return view('tasks.index', compact('tasks', 'tipos', 'concluidas'));
    }

    // API - listar tarefas
    public function indexTasksApi()
    {
        $tasks = Task::orderBy('data_inicio')->get();
        return response()->json($tasks);
    }

    // API - criar tarefa
    public function storeApi(Request $request)
    {
        $request->validate([
            'nome_tarefa'      => 'required|string|max:255',
            'descricao_tarefa' => 'nullable|string',
            'data_inicio'      => 'nullable|date',
            'horario_tarefa'   => 'nullable|string',
            'tipo_tarefa'      => 'required|string|max:255',
            'local_tarefa'     => 'nullable|string|max:255',
            'concluida'        => 'nullable',
        ]);

        $task = Task::create($request->all());

        return response()->json($task);
    }

    // API - atualizar tarefa
    public function updateApi(Request $request, string $id)
    {
        $task = Task::findOrFail($id);

        $task->update($request->all());

        return response()->json([
            'message' => 'Tarefa alterada com sucesso',
            'tarefa'  => $task
        ]);
    }

    // API - deletar tarefa
    public function destroyApi(string $id)
    {
        Task::where('id', $id)->delete();

        return response()->json([
            'message' => 'Tarefa excluída com sucesso',
            'code'    => 200
        ]);
    }

    // API - contar tarefas
    public function countTask()
    {
        return response()->json([
            'count' => Task::count(),
            'code'  => 200
        ]);
    }

    // API - mostrar 1 tarefa

    public function showTask(string $id)
    {
        $task = Task::where('id', '=', $id)->get();
        return response()->json($task);
    }
}