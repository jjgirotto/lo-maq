<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncio;
use Illuminate\Support\Facades\Auth;
use App\Models\Equipamento;
use App\Models\Categoria;
use App\Models\Avaliacao;
use App\Models\Locacao;
use Illuminate\Support\Facades\Log;

class AnuncioController extends Controller
{
    /**
     * Exibe o formulário de criação de um novo anúncio
     */
    public function create()
    {
        // Busca equipamentos com seus relacionamentos
        $equipamentos = Equipamento::orderBy('nome')
            ->with(['categoria', 'locador'])
            ->get();
        $user = Auth::user();
        return view('anuncios.create', compact('equipamentos','user'));
    }

    /**
     * Armazena um novo anúncio
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'equipamento_id' => 'required|exists:equipamento,id',
            'valor_diaria' => 'required|numeric|min:0',
            'regiao' => 'required|string|max:255'
        ]);

        try {
            $data['user_id'] = auth()->id(); // vincula ao usuário logado
            Anuncio::create($data);

            return redirect()->route('anuncios.index')->with('sucesso', 'Anúncio criado com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao salvar Anuncio: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'data' => $data
            ]);
            return redirect()->back()->with('erro', 'Erro ao criar anúncio.');
        }
    }

    /**
     * Exibe a listagem de anúncios com filtros
     */
    public function index(Request $request)
    {
        $query = Anuncio::with([
            'equipamento',
            'equipamento.categoria',
            'equipamento.locador',
            'user'
        ]);

        // Filtros
        $termo = $request->query('termo');
        $categoria = $request->query('categoria');

        // Filtro por termo (nome ou região)
        if (!empty($termo)) {
            $query->where(function ($q) use ($termo) {
                $q->where('nome', 'like', "%{$termo}%")
                    ->orWhere('regiao', 'like', "%{$termo}%");
            });
        }

        // Filtro por categoria
        if (!empty($categoria)) {
            $query->whereHas('equipamento.categoria', function ($q) use ($categoria) {
                $q->where('id', $categoria);
            });
        }

        // Consulta final
        $anuncios = $query->latest()->get();
        $categorias = Categoria::all();

        // Layout dinâmico (ADM ou padrão)
        $layout = (auth()->check() && auth()->user()->access === 'ADM')
            ? 'layouts.admin'
            : 'layouts.default';

        if (Auth::user() != null) {
            $user = Auth::user();
            return view('anuncios.index', compact('anuncios', 'categorias', 'layout', 'user'));
        } else
            return view('anuncios.index', compact('anuncios', 'categorias', 'layout'));
    }

    /**
     * Exibe formulário de edição de um anúncio existente
     */
    public function edit($id)
    {
        $anuncio = Anuncio::findOrFail($id);

        // Permissão: ADM ou dono do anúncio
        if (auth()->user()->access !== 'ADM' && $anuncio->user_id !== auth()->id()) {
            return redirect()->route('anuncios.index')->with('erro', 'Você não tem permissão para editar este anúncio.');
        }

        $equipamentos = Equipamento::all();
        $layout = (auth()->check() && auth()->user()->access === 'ADM')
            ? 'layouts.admin'
            : 'layouts.default';

        return view('anuncios.edit', compact('anuncio', 'equipamentos', 'layout'));
    }

    /**
     * Atualiza um anúncio existente
     */
    public function update(Request $request, $id)
    {
        $anuncio = Anuncio::findOrFail($id);

        // Verificação de permissão
        if (auth()->user()->access !== 'ADM' && $anuncio->user_id !== auth()->id()) {
            return redirect()->route('anuncios.index')->with('erro', 'Você não tem permissão para editar este anúncio.');
        }

        $request->validate([
            'nome' => 'required|string|max:255',
            'equipamento_id' => 'required|exists:equipamento,id',
            'valor_diaria' => 'required|numeric|min:0',
            'regiao' => 'required|string|max:255',
        ]);

        $anuncio->update([
            'nome' => $request->nome,
            'equipamento_id' => $request->equipamento_id,
            'valor_diaria' => $request->valor_diaria,
            'regiao' => $request->regiao,
        ]);

        return redirect()->route('anuncios.show', $id)->with('sucesso', 'Anúncio atualizado com sucesso!');
    }

    /**
     * Remove um anúncio
     */
    public function destroy($id)
    {
        $anuncio = Anuncio::findOrFail($id);

        // Permissão: ADM pode tudo; cliente só o próprio
        if (auth()->user()->access !== 'ADM' && $anuncio->user_id !== auth()->id()) {
            return redirect()->route('anuncios.index')->with('erro', 'Você não tem permissão para excluir este anúncio.');
        }

        $anuncio->delete();
        return redirect()->route('anuncios.index')->with('sucesso', 'Anúncio excluído com sucesso!');
    }

    /**
     * Exibe detalhes de um anúncio
     */
    public function show($id)
    {
        $anuncio = Anuncio::with(['equipamento', 'equipamento.categoria', 'equipamento.locador'])
            ->find($id);

        if (!$anuncio) {
            return redirect()->route('anuncios.index')->with('erro', 'Anúncio não encontrado.');
        }

        $avaliacoes = Avaliacao::whereIn(
            'locacao_id',
            Locacao::where('equipamento_id', $anuncio->equipamento_id)->pluck('id')
        )->get();


        return view('anuncios.show', compact('anuncio', 'avaliacoes'));
    }

    public function meusAnuncios()
    {
        $usuario = auth()->user();

        // Detecta se é admin
        $isAdmin = $usuario->access === 'ADM';

        if ($isAdmin) {
            // Admin vê todos os anúncios
            $anuncios = Anuncio::with(['equipamento.categoria'])
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            // Cliente vê apenas os anúncios dos seus equipamentos
            $anuncios = Anuncio::with(['equipamento.categoria'])
                ->whereHas('equipamento', function ($query) use ($usuario) {
                    $query->where('user_id', $usuario->id);
                })
                ->orderBy('created_at', 'desc')
                ->get();
        }

        // Layout dinâmico
        $layout = $isAdmin ? 'layoutADM' : 'layout';

        // Categorias para a view (útil se você tiver filtros)
        $categorias = \App\Models\Categoria::all();

        return view('anuncios.meus-anuncios', compact('anuncios', 'layout', 'categorias'));
    }



}


