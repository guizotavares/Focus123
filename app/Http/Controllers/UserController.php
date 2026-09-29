<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Cria um novo usuário na tabela "users".
     */
    public function store(Request $request)
    {
        $user = new User();

        $user->name     = $request->txNome;
        $user->email    = $request->txEmail;
        $user->password = Hash::make($request->txSenha);
        $user->created_at = date('Y-m-d');
        $user->updated_at = date('Y-m-d');

        $user->save();

        // Auth::login($user);

        return redirect()->route('painel.dashboard')->with('mensagem', 'Usuário criado com sucesso!');
    }

    /**
     * Verifica e-mail/senha e autentica o usuário.
     */
    public function fazerLogin(Request $request)
    {
        if (! Auth::attempt($request->only(['email', 'password']))) {
            return redirect('/login')->with('erro', 'E-mail ou senha incorretos.');
        } else {
            return redirect()->route('painel.dashboard');
        }
    }

    /**
     * Encerra a sessão do usuário autenticado.
     */
    public function fazerLogOut(Request $request)
    {
        Auth::logout();

        return redirect('/login');
    }
}
