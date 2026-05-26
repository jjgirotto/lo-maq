<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Equipamento;
use App\Models\Locacao;
use App\Models\LocatarioDaLocacao;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LocacaoController extends Controller
{
    
    public function index()
    {
        //
        $locador = Auth::user();
        $locacoes = Locacao::where('created_by', $locador->id)->get();
        $equipamentoIds = $locacoes->pluck('equipamento_id');
        $equipamentos = Equipamento::whereIn('id', $equipamentoIds)->get();
        $locatariosDasLocacoes = LocatarioDaLocacao::all();
        return view("locacoes.index", compact("locador", 'locacoes', 'equipamentos', 'locatariosDasLocacoes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $equipamentos = Equipamento::all();

    return view("locacoes.create", compact('equipamentos'));
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
                'tipo_locacao' => ['required', 'boolean'],
            ]);

            $startDate = Carbon::createFromFormat("Y-m-d", $data['data_inicio'])->startOfDay();
            $endDate = Carbon::createFromFormat("Y-m-d", $data['data_fim'])->endOfDay();
            $days = max(1, $startDate->diffInDays($endDate->copy()->startOfDay()) + 1);
            $equipamentoSafe =
    Equipamento::findOrFail($request->equipamento_id);
            $valorTotal = $equipamentoSafe->preco_periodo * $days;
            $dataComplete = array_merge(
                $data,
                [
                    'equipamento_id' => $equipamentoSafe->id,
                    'valor_total' => $valorTotal,
                    'created_by' => Auth::user()->id,
                ]
            );
            $locacao = Locacao::create($dataComplete);

            LocatarioDaLocacao::create(
                [
                    'data_inicio' => $dataComplete['data_inicio'],
                    'data_fim' => $dataComplete['data_fim'],
                    'valor_individual' => $dataComplete['valor_total'],
                    'locacao_id' => $locacao->id,
                    'locatario_id' => $dataComplete['created_by'],
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


    public function createLocatarioDaLocacao(string $id)
    {
        $locacao = Locacao::findOrFail($id);
        $locadoresExistentes = LocatarioDaLocacao::where('locacao_id', $id)->pluck('locatario_id');
        $locadores = User::where('access', '!=', 'ADM')->whereNotIn('id', $locadoresExistentes)->get();
        return view("locacoes.addColab", compact('locacao', 'locadores', 'id'));
    }

    public function storeLocatarioDaLocacao(Request $request)
    {
        LocatarioDaLocacao::create(
            [
                'data_inicio' => $request['data_inicio'],
                'data_fim' => $request['data_fim'],
                'locacao_id' => $request['locacao_id'],
                'locatario_id' => $request['id_colab'],
            ]
        );
        $colabList = LocatarioDaLocacao::where('locacao_id', $request['locacao_id'])->get();
        $divideBy = $colabList->count();
        if ($divideBy > 0) {

            $totalValue = Locacao::findOrFail($request['locacao_id'])->valor_total;
            $valorIndividual = $totalValue / $divideBy;
            LocatarioDaLocacao::where('locacao_id', $request['locacao_id'])->update(['valor_individual' => $valorIndividual]);
        }
        return back()->with('sucesso', 'Participante adicionado e valor dividido com sucesso!');
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
