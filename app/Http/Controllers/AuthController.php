<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /* =========================================================
     |  WEB (sessão)
     ========================================================= */

    /** Tela de login/cadastro. Se já estiver logado, vai para o dashboard. */
    public function index()
    {
        if (session()->has('usuario_id')) {
            return redirect()->route('dashboard');
        }

        return view('welcome');
    }

    /** Cadastro de usuário (tabela "usuarios"). */
    public function store(Request $request)
    {
        // O formulário envia o telefone como "phone"; a coluna é "telefone".
        $request->merge(['telefone' => $request->input('telefone', $request->input('phone'))]);

        $dados = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:usuarios,email',
            'password'  => 'required|string|min:6|confirmed',
            'cpf'       => 'nullable|string|max:14',
            'telefone'  => 'nullable|string|max:15',
            'data_nasc' => 'nullable|date',
        ], [
            'name.required'      => 'O nome é obrigatório.',
            'email.required'     => 'O e-mail é obrigatório.',
            'email.email'        => 'Informe um e-mail válido.',
            'email.unique'       => 'Este e-mail já está cadastrado.',
            'password.required'  => 'A senha é obrigatória.',
            'password.min'       => 'A senha deve ter pelo menos 6 caracteres.',
            'password.confirmed' => 'As senhas não coincidem.',
            'data_nasc.date'     => 'Data de nascimento inválida.',
        ]);

        // O cast "hashed" do model já faz o hash; Hash::make deixa explícito
        // e é ignorado pelo cast se o valor já estiver com hash.
        $dados['password'] = Hash::make($dados['password']);

        Usuario::create($dados);

        return redirect()->route('auth.index')
            ->with('sucesso', 'Conta criada com sucesso! Faça login.');
    }

    /** Login: valida credenciais, abre a sessão e vai para o dashboard. */
    public function login(Request $request)
    {
        $credenciais = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required'    => 'O e-mail é obrigatório.',
            'email.email'       => 'Informe um e-mail válido.',
            'password.required' => 'A senha é obrigatória.',
        ]);

        $usuario = Usuario::where('email', $credenciais['email'])->first();

        if (! $usuario || ! Hash::check($credenciais['password'], $usuario->password)) {
            return redirect()->route('auth.index')
                ->withInput($request->only('email'))
                ->with('erro', 'E-mail ou senha incorretos.');
        }

        // Evita session fixation e só então grava os dados do usuário
        $request->session()->regenerate();

        session([
            'usuario_id'     => $usuario->id,
            'usuario_logado' => $usuario->name,
        ]);

        // Vai para a página que o usuário tentou abrir antes de logar,
        // ou para o dashboard de gráficos.
        return redirect()->intended(route('dashboard'));
    }

    /** Logout: destrói a sessão inteira. */
    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.index');
    }

    /* =========================================================
     |  API (JSON)
     ========================================================= */

    public function indexUserApi()
    {
        return response()->json(
            Usuario::orderBy('created_at', 'desc')->get()
        );
    }

    public function storeApi(Request $request)
    {
        $dados = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:usuarios,email',
            'password'  => 'required|string|min:6',
            'cpf'       => 'nullable|string|max:14',
            'telefone'  => 'nullable|string|max:15',
            'data_nasc' => 'nullable|date',
        ]);

        $dados['password'] = Hash::make($dados['password']);

        return response()->json(Usuario::create($dados), 201);
    }

    public function updateUserApi(Request $request, string $id)
    {
        $usuario = Usuario::findOrFail($id);

        $dados = $request->validate([
            'name'      => 'sometimes|required|string|max:255',
            'email'     => 'sometimes|required|email|unique:usuarios,email,' . $usuario->id,
            'password'  => 'sometimes|required|string|min:6',
            'cpf'       => 'nullable|string|max:14',
            'telefone'  => 'nullable|string|max:15',
            'data_nasc' => 'nullable|date',
        ]);

        if (isset($dados['password'])) {
            $dados['password'] = Hash::make($dados['password']);
        }

        $usuario->update($dados);

        return response()->json([
            'message' => 'Usuário alterado com sucesso',
            'usuario' => $usuario,
        ]);
    }

    public function destroyUserApi(string $id)
    {
        Usuario::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Usuário excluído com sucesso',
            'code'    => 200,
        ]);
    }

    public function countUsuario()
    {
        return response()->json([
            'count' => Usuario::count(),
            'code'  => 200,
        ]);
    }

    public function idUsuarioApi(string $name)
    {
        return response()->json(
            Usuario::select('id')->where('name', $name)->get()
        );
    }
}
