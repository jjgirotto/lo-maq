<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// Deixamos os models comentados para o futuro
// use App\Models\Anuncio;
// use App\Models\Categoria;

class HomeController extends Controller
{
    // Rota ativada quando o usuário JÁ está logado
    public function index()
    {
        $user = Auth::user();
        
        // Por enquanto, redireciona todos de volta para a raiz
        return redirect()->intended("/");
    }

    // Rota da sua Homepage Pública (o que aparece ao acessar localhost:8000)
    public function indexPublic(Request $request)
    {
        return view('welcome'); // Sem compact('layout')!
    }
}