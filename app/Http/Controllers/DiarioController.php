<?php

namespace App\Http\Controllers;

use App\Models\Diario;
use Illuminate\Http\Request;

class DiarioController extends Controller
{
    // GET — lista todas as entradas
    public function index()
    {
        $entradas = Diario::orderBy('data_entrada', 'desc')->get();
        return response()->json($entradas);
    }

    // GET — mostra uma entrada específica pelo ID
    public function show($id)
    {
        $entrada = Diario::findOrFail($id);
        return response()->json($entrada);
    }

    // POST — cria uma nova entrada
    public function store(Request $request)
    {
        $request->validate([
            'titulo'       => 'required|string|max:255',
            'conteudo'     => 'nullable|string',
            'data_entrada' => 'nullable|date',
            'humor'        => 'nullable|string|max:50',
        ]);

        $entrada = Diario::create($request->all());

        return response()->json($entrada, 201); // 201 = "criado com sucesso"
    }

    // PUT — atualiza uma entrada existente
    public function update(Request $request, $id)
    {
        $entrada = Diario::findOrFail($id);
        $entrada->update($request->all());

        return response()->json($entrada);
    }

    // DELETE — apaga uma entrada
    public function destroy($id)
    {
        Diario::findOrFail($id)->delete();

        return response()->json(['message' => 'Entrada excluída com sucesso']);
    }
}