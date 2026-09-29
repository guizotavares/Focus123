<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        $request->validate([
            'nome_hobby' => 'required|string|max:255',
            'meta'       => 'nullable|string|max:255',
            'categoria'  => 'nullable|string|max:255',
        ], [
            'nome_hobby.required' => 'O nome do hobby é obrigatório.',
        ]);

        Hobby::create([
            'nome_hobby' => $request->nome_hobby,
            'meta'       => $request->meta,
            'categoria'  => $request->categoria,
        ]);

        return redirect()->route('hobbies.index')->with('success', 'Hobby criado com sucesso!');
    }

    public function edit(string $id)
    {
        $hobby = Hobby::findOrFail($id);
        return view('hobbies.edit', compact('hobby'));
    }

    public function update(Request $request, string $id)
    {
        $hobby = Hobby::findOrFail($id);

        $request->validate([
            'nome_hobby' => 'required|string|max:255',
            'meta'       => 'nullable|string|max:255',
            'categoria'  => 'nullable|string|max:255',
        ]);

        $hobby->update([
            'nome_hobby' => $request->nome_hobby,
            'meta'       => $request->meta,
            'categoria'  => $request->categoria,
        ]);

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

        $hobby = Hobby::create($request->all());/*Fala com o banco */

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