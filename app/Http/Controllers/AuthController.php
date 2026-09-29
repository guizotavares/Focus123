<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:usuarios,email',
            'password'  => 'required|string|min:6',
            'cpf'       => 'nullable|string|max:14',
            'telefone'  => 'nullable|string|max:15',
            'data_nasc' => 'nullable|date',
        ], [
            'name.required'     => 'O nome é obrigatório.',
            'email.required'    => 'O e-mail é obrigatório.',
            'email.email'       => 'Informe um e-mail válido.',
            'email.unique'      => 'Este e-mail já está cadastrado.',
            'password.required' => 'A senha é obrigatória.',
            'password.min'      => 'A senha deve ter pelo menos 6 caracteres.',
        ]);

        Usuario::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'cpf'       => $request->cpf,
            'telefone'  => $request->telefone,
            'data_nasc' => $request->data_nasc,
        ]);

        return redirect('/auth')->with('sucesso', 'Conta criada com sucesso! Faça login.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required'    => 'O e-mail é obrigatório.',
            'email.email'       => 'Informe um e-mail válido.',
            'password.required' => 'A senha é obrigatória.',
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if (! $usuario || ! Hash::check($request->password, $usuario->password)) {
            return redirect('/auth')->with('erro', 'E-mail ou senha incorretos.');
        }

        $request->session()->regenerate();

        session([
            'usuario_id'     => $usuario->id,
            'usuario_logado' => $usuario->name,
        ]);

        return redirect('/');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/auth');
    }

    // API - listar usuários
    public function indexUserApi()
    {
        $usuarios = Usuario::orderBy('created_at', 'desc')->get();
        return response()->json($usuarios); 
    }

    // API - criar usuário
    public function storeApi(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:usuarios,email',
            'password'  => 'required|string|min:6',
            'cpf'       => 'nullable|string|max:14',
            'telefone'  => 'nullable|string|max:15',
            'data_nasc' => 'nullable|date',
        ]);

        $usuario = Usuario::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password), 
            'cpf'       => $request->cpf,
            'telefone'  => $request->telefone,
            'data_nasc' => $request->data_nasc,
        ]);

        return response()->json($usuario); 
    }

    // API - atualizar usuário
    public function updateUserApi(Request $request, string $id)
    {
        $usuario = Usuario::findOrFail($id);

        $usuario->update($request->all());

        return response()->json([
            'message' => 'Usuário alterado com sucesso',
            'usuario' => $usuario
        ]);
    }

    // API - deletar usuário
    public function destroyUserApi(string $id)
    {
        Usuario::where('id', $id)->delete();

        return response()->json([
            'message' => 'Usuário excluído com sucesso',
            'code'    => 200
        ]);
    }

    // API - contar usuários
    public function countUsuario()
    {
        return response()->json([
            'count' => Usuario::count(), 
            'code'  => 200
        ]);
    }
    public function idUsuarioApi(string $name) 
    {
       $usuario = Usuario::select('id')->where('name', '=', $name)->get();
        return response()->json($usuario);
    }
}