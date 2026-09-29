<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class ContaController extends Controller
{
    /**
     * Exibe a página "Minha Conta" do usuário logado.
     */
    public function show()
    {
        $usuario = Usuario::findOrFail(session('usuario_id'));
        $tasks   = Task::orderBy('data_inicio')->get();

        return view('conta.show', compact('usuario', 'tasks'));
    }

    /**
     * Exibe o formulário de edição da conta.
     */
    public function edit()
    {
        $usuario = Usuario::findOrFail(session('usuario_id'));
        return view('conta.edit', compact('usuario'));
    }

    /**
     * Salva as alterações da conta.
     */
    public function update(Request $request)
    {
        $usuario = Usuario::findOrFail(session('usuario_id'));

        // Regras de validação dos dados básicos
        $rules = [
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:usuarios,email,' . $usuario->id,
            'cpf'       => 'nullable|string|max:14',
            'telefone'  => 'nullable|string|max:15',
            'data_nasc' => 'nullable|date',
        ];

        // Regras de senha — só aplicadas se o usuário quer alterar
        if ($request->filled('current_password')) {
            $rules['current_password'] = ['required', function ($attribute, $value, $fail) use ($usuario) {
                if (! Hash::check($value, $usuario->password)) {
                    $fail('A senha atual está incorreta.');
                }
            }];
            $rules['password'] = 'required|min:6|confirmed';
        } else {
            $rules['password'] = 'nullable';
        }

        $messages = [
            'name.required'             => 'O nome é obrigatório.',
            'email.required'            => 'O e-mail é obrigatório.',
            'email.email'               => 'Informe um e-mail válido.',
            'email.unique'              => 'Este e-mail já está em uso.',
            'current_password.required' => 'A senha atual é obrigatória para alterar a senha.',
            'password.required'         => 'A nova senha é obrigatória.',
            'password.min'              => 'A nova senha deve ter pelo menos 6 caracteres.',
            'password.confirmed'        => 'As senhas não coincidem.',
        ];

        $validated = $request->validate($rules, $messages);

        // Remove campos de senha dos dados a salvar
        $dados = Arr::except($validated, ['current_password', 'password', 'password_confirmation']);

        // Aplica hash na nova senha, se fornecida
        if ($request->filled('password')) {
            $dados['password'] = Hash::make($validated['password']);
        }

        $usuario->update($dados);

        // Atualiza o nome exibido na sidebar
        session(['usuario_logado' => $usuario->name]);

        return redirect()->route('conta.show')->with('success', 'Conta atualizada com sucesso!');
    }
    public function idUsuarioAPI() 
    {
        $usuario = Usuario::where('idUsuario','>',0)->orderBy('nome','desc')->get();
        return response()->json($usuario);
    }
}
