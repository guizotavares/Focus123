<?php

namespace App\Http\Controllers;

use App\Http\Requests\HobbyFormRequest;
use App\Models\Hobby;
use Illuminate\Http\Request;

class HobbyController extends Controller
{
    public function index()
    {
        $hobbies = Hobby::orderBy('created_at', 'desc')->get();
        return view('hobbies.index', compact('hobbies'));
    }

    public function create()
    {
        return view('hobbies.create');
    }

    /**
     * A validação acontece ANTES de entrar neste método, dentro do
     * HobbyFormRequest. Se falhar, o Laravel volta ao formulário com
     * $errors e old(); se passar, chegamos aqui com dados válidos.
     */
    public function store(HobbyFormRequest $request)
    {
        Hobby::create($request->validated());

        return redirect()->route('hobbies.index')->with('success', 'Hobby criado com sucesso!');
    }

    public function edit(string $id)
    {
        $hobby = Hobby::findOrFail($id);
        return view('hobbies.edit', compact('hobby'));
    }

    public function update(HobbyFormRequest $request, string $id)
    {
        $hobby = Hobby::findOrFail($id);

        $hobby->update($request->validated());

        return redirect()->route('hobbies.index')->with('success', 'Hobby atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        $hobby = Hobby::findOrFail($id);
        $hobby->delete();

        return redirect()->route('hobbies.index')->with('success', 'Hobby excluído com sucesso!');
    }

    // API - listar hobbies
    public function apiIndex()
    {
        $hobbies = Hobby::orderBy('created_at', 'desc')->get();
        return response()->json($hobbies);
    }

    // API - criar hobby
    public function apiStore(Request $request)
    {
        $request->validate([
            'nome_hobby' => 'required|string|max:255',
            'meta'       => 'nullable|string|max:255',
            'categoria'  => 'nullable|string|max:255',
        ]);

        $hobby = Hobby::create($request->all()); /*Fala com o banco */

        return response()->json($hobby);
    }

    // API - mostrar 1 hobby
    public function apiShow($id)
    {
        $hobby = Hobby::findOrFail($id);
        return response()->json($hobby);
    }

    // API - atualizar
    public function apiUpdate(Request $request, $id)
    {
        $hobby = Hobby::findOrFail($id);

        $hobby->update($request->all());

        return response()->json($hobby);
    }

    // API - deletar
    public function apiDestroy($id)
    {
        $hobby = Hobby::findOrFail($id);
        $hobby->delete();

        return response()->json(['message' => 'Hobby deletado']);
    }
}