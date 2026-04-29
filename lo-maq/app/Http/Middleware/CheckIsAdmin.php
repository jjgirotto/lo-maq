<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica se o usuário está autenticado e é ADM
        if (!auth()->check() || auth()->user()->access !== 'ADM') {
            return redirect()->route('home')
                ->with('erro', 'Acesso negado. Apenas administradores podem acessar esta página.');
        }

        return $next($request);
    }
}
