<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Anuncio;
use App\Models\Equipamento;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->access == 'ADM') {
            return redirect()->route('admin'); 
        }

        // Se não for ADM, assume que é CLI
        return redirect()->route('home.cliente');
    }

    // Rota da sua Homepage Pública
    public function indexPublic()
    {
        if (Auth::check()) {
            return $this->index();
        }

        $equipamentosCount = Equipamento::count();
        $anunciosCount = Anuncio::count();

        $layout = 'layouts.default';

        return view('home.public', compact('layout', 'equipamentosCount', 'anunciosCount'));
    }
}