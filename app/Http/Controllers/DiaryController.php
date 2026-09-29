<?php

namespace App\Http\Controllers;

use App\Models\Diary;
use Illuminate\Http\Request;

class DiaryController extends Controller
{
    public function index(){
        $diary = Diary::orderBy('created_at', 'desc')->get();
        return view('diary.index', compact('diary'));
    }

    public function create(){
        return view('diary.create');
    }

    public function store(Request $request){
        $request->validate([
            'title_diary' => 'required|string|max:255',
            'date_diary' => 'nullable|date',
            'feeling_diary' => 'required|string|max:255',
            'descricao_diary' => 'nullable|string',
        ], [
            'title_diary.required' => 'O título do diário é obrigatório.',
            'date_diary.date_format' => 'Data inválida.',
            'feeling_diary.required' => 'Escolha como você está se sentindo.'
        ]);

        Diary::create([
            'title_diary' => $request->title_diary,
            'date_diary'=> $request->date_diary,
            'feeling_diary'=>$request->feeling_diary,
            'descricao_diary'=>$request->descricao_diary,
        ]);

        return redirect()->route('diary.index')->with('sucess', 'Diário criado com sucesso!');
    }

    public function edit(string $id){
        $diary = Diary::findOrFail($id);
        return view('diary.edit', compact('diary'));
    }

    public function update(Request $request, string $id){
        $diary = Diary::findOrFail($id);

        $request->validate([
            'title_diary' => 'required|string|max:255',
            'date_diary' => 'nullable|date',
            'feeling_diary' => 'required|string|max:255',
            'descricao_diary' => 'nullable|string',
        ]);

        $diary->update([
            'title_diary' => $request->title_diary,
            'date_diary'=> $request->date_diary,
            'feeling_diary'=>$request->feeling_diary,
            'descricao_diary'=>$request->descricao_diary,
        ]);

        return redirect()->route('diary.index')->with('success', 'Diário atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        $diary = Diary::findOrFail($id);
        $diary->delete();

        return redirect()->route('diary.index')->with('success', 'Diário excluído com sucesso!');
    }

   // API - listar diario
      public function apiIndex()
   {
       $diary = diary::orderBy('created_at', 'desc')->get();
       return response()->json($diary);
   }

   // API - criar diario
   public function apiStore(Request $request)
   {
       $request->validate([
           'title_diary' => 'required|string|max:255',
           'date_diary'       => 'nullable|string|max:255',
           'feeling_diary'  => 'nullable|string|max:255',
           'descricao_diary'  => 'nullable|string|max:255',
       ]);

       $diary = diary::create($request->all());/*Fala com o banco */

       return response()->json($diary);
   }

     // API - mostrar com o id 1 diario
     public function apiShow($id)
     {
         $diary = diary::findOrFail($id);
         return response()->json($diary);
     }

      // API - atualizar
    public function apiUpdate(Request $request, $id)
    {
        $diary = diary::findOrFail($id);

        $diary->update($request->all());

        return response()->json($diary);
    }

     // API - deletar
     public function apiDestroy($id)
     {
         $diary = diary::findOrFail($id);
         $diary->delete();
 
         return response()->json(['message' => 'Diário deletado']);
     }
}
