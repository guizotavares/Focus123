<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AutenticacaoMiddleware
{
    /**
     * Redireciona para /auth se o usuário não estiver logado.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! session()->has('usuario_id')) {
            return redirect('/auth')->with('erro', 'Faça login para acessar esta página.');
        }

        return $next($request);
    }
}
