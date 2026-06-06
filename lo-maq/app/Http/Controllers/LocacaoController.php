<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Equipamento;
use App\Models\Locacao;
use App\Models\LocatarioDaLocacao;
use Illuminate\Support\Facades\Auth;
class LocacaoController extends Controller
{
    
    public function index()
    {
        $locador = Auth::user();
        $locacoes = Locacao::with('equipamento')
            ->where('created_by', $locador->id)
            ->get();

        return view("locacoes.index", compact('locacoes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $equipamentos = Equipamento::orderBy('nome')->get();
        $equipamentoSelecionado = $request->query('equipamento_id');

        if (!$equipamentoSelecionado) {
            $queryString = rtrim($request->getQueryString() ?? '', '=');
            if ($queryString !== '' && ctype_digit($queryString)) {
                $equipamentoSelecionado = (int) $queryString;
            }
        }

        if (!$equipamentoSelecionado) {
            foreach (array_keys($request->query()) as $key) {
                if (is_numeric($key)) {
                    $equipamentoSelecionado = (int) $key;
                    break;
                }
            }
        }

        return view("locacoes.create", compact('equipamentos', 'equipamentoSelecionado'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'data_inicio' => ['required', 'date'],
                'data_fim' => ['required', 'date', 'after_or_equal:data_inicio'],
            ]);

            $startDate = Carbon::createFromFormat("Y-m-d", $data['data_inicio'])->startOfDay();
            $endDate = Carbon::createFromFormat("Y-m-d", $data['data_fim'])->endOfDay();
            $days = max(1, $startDate->diffInDays($endDate->copy()->startOfDay()) + 1);
            $equipamentoSafe =
    Equipamento::findOrFail($request->equipamento_id);
            $valorTotal = $equipamentoSafe->preco_periodo * $days;
            $usuarioId = $request->input('usuario_id', Auth::user()->id);
            $dataComplete = array_merge(
                $data,
                [
                    'equipamento_id' => $equipamentoSafe->id,
                    'valor_total' => $valorTotal,
                    'usuario_id' => $usuarioId,
                    'created_by' => Auth::user()->id,
                    'status_pagamento' => '0',
                ]
            );
            $locacao = Locacao::create($dataComplete);

            LocatarioDaLocacao::create(
                [
                    'data_inicio' => $dataComplete['data_inicio'],
                    'data_fim' => $dataComplete['data_fim'],
                    'valor_individual' => $dataComplete['valor_total'],
                    'locacao_id' => $locacao->id,
                    'usuario_id' => $usuarioId,
                ]
            );

            return redirect()->route("locacoes.index")
                ->with("sucesso", "Locação criada com sucesso!");
        } catch (\Exception $e) {
            echo "Erro ao salvar o registro da locacao! " . $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $locador = Auth::user();
        $locacao = Locacao::findOrFail($id);
        if ($locador->id === $locacao->created_by) {
            $equipamento = Equipamento::findOrFail($locacao->equipamento_id);
            return view("locacoes.show", compact("locador", 'locacao', 'equipamento'));
        }
        return view("locacoes.index");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
