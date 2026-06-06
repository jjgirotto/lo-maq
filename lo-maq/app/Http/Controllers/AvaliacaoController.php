<?php

namespace App\Http\Controllers;

use App\Models\LocatarioDaLocacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Locacao;
use App\Models\Avaliacao;
use App\Models\Equipamento;
class AvaliacaoController extends Controller
{
    public function Create($id)
    {
        if (!Avaliacao::where('locacao_id', $id)->exists()) {
            $locacao = Locacao::findOrFail($id);
            $equipamento = Equipamento::findOrFail($locacao->equipamento_id);
            return view("locacoes.avaliacoes.create", compact('locacao', 'equipamento'));
        }
        return redirect()->route('locacoes.avaliar.edit', $id);
    }

    public function Store(Request $request)
    {
        try {
            $data = array_merge(
                $request->all(),
                [
                    'locacao_id' => $request->id,
                    // Salva a avaliação diretamente para o usuário logado:
                    'usuario_id' => Auth::user()->id, 
                ]
            );
            
            $avaliacao = Avaliacao::create($data);
            
            return redirect()->route("locacoes.index")
                ->with("sucesso", "Registro inserido com sucesso!");
        } catch (\Exception $e) {
            Log::error("Erro ao salvar o registro da avaliacao! " . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route("locacoes.index")
                ->with("erro", "Erro ao inserir! " . $e->getMessage());
        }
    }

    public function Edit(string $id)
    {
        $avaliacao = Avaliacao::where('locacao_id', $id)->firstOrFail();
        $locacao = Locacao::findOrFail($id);
        $equipamento = Equipamento::findOrFail($locacao->equipamento_id);
        return view("locacoes.avaliacoes.show", compact("avaliacao", 'equipamento'));
    }

    public function Update(Request $request)
    {
        //
        try {
            $avaliacao = Avaliacao::findOrFail($request->id);
            $avaliacao->update($request->all());

            return redirect()->route("locacoes.index")
                ->with("sucesso", "Registro alterado!");
        } catch (\Exception $e) {
            Log::error("Erro ao alterar o registro da avaliacao! " . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route("locacoes.index")
                ->with("erro", "Erro ao alterar!");
        }
    }


    public function Destroy(string $id)
    {
        try {
            $avaliacao = Avaliacao::findOrFail($id);
            $avaliacao->delete();
            return redirect()->route("locacoes.index")
                ->with("sucesso", "Registro excluído!");
        } catch (\Exception $e) {
            Log::error("Erro ao excluir o registro da avaliacao! " . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'id' => $id
            ]);
            return redirect()->route("locacoes.index")
                ->with("erro", "Erro ao excluir!");
        }
    }
}