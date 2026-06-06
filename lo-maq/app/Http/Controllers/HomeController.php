<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Anuncio;
use App\Models\Categoria;
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
    public function indexPublic(Request $request)
    {

        if (Auth::check()) {
            return $this->index();
        }

        // Consulta de anúncios públicos com filtro simples de busca
        $query = Anuncio::with(['equipamento', 'equipamento.categoria', 'user']);
        $termo = $request->query('termo');
        if (!empty($termo)) {
            $query->where(function ($q) use ($termo) {
                $q->where('nome', 'like', "%{$termo}%")
                  ->orWhere('regiao', 'like', "%{$termo}%");
            });
        }

        $anuncios = $query->latest()->get();
        $categorias = Categoria::all();

        // contadores simples para destacar o que já existe no sistema
        $equipamentosCount = Equipamento::count();
        $anunciosCount = Anuncio::count();

        $layout = 'layouts.default';

        return view('home.public', compact('anuncios', 'termo', 'categorias', 'layout', 'equipamentosCount', 'anunciosCount'));
    }
}