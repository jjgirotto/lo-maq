<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avaliacao;
use App\Models\Locacao;
use Illuminate\Support\Facades\Auth;

class AvaliacaoController extends Controller
{    
    public function index()
    {
        $avaliacoes = Avaliacao::with(['locacao', 'usuario'])->get();
        
        return view('adm.avaliacoes.index', compact('avaliacoes'));
    }

    public function show($id)
    {
        $avaliacao = Avaliacao::with(['locacao.equipamento', 'usuario'])->findOrFail($id);
        
        return view('adm.avaliacoes.show', compact('avaliacao'));
    }

    public function destroy($id)
    {
        $avaliacao = Avaliacao::findOrFail($id);
        $avaliacao->delete();
        
        return redirect()->route('adm.avaliacoes.index')
                         ->with('sucesso', 'Avaliação removida com sucesso!');
    }

    public function createClient($id)
    {
        $locacao = Locacao::findOrFail($id);
        
        if (Auth::user()->id !== $locacao->usuario_id) {
            return redirect()->route('locacoes.index')
                             ->with('erro', 'Acesso negado. Você não tem permissão para avaliar esta locação.');
        }

        return view('locacoes.avaliacoes.create', compact('locacao'));
    }

    public function storeClient(Request $request, $id)
    {
        $request->validate([
            'nota'                 => 'required|integer|min:1|max:5',
            'estado_equipamento'   => 'nullable|string|max:255',
            'cumprimento_contrato' => 'nullable|string|max:255',
            'comentario'           => 'nullable|string|max:1000',
        ]);

        Avaliacao::create([
            'nota'                 => $request->nota,
            'estado_equipamento'   => $request->estado_equipamento,
            'cumprimento_contrato' => $request->cumprimento_contrato,
            'comentario'           => $request->comentario,
            'locacao_id'           => $id,
            'usuario_id'           => Auth::id(),
        ]);

        return redirect()->route('locacoes.index')
                         ->with('sucesso', 'Obrigado! Sua avaliação foi enviada com sucesso.');
    }
}