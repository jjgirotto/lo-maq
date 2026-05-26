<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Equipamento;
use App\Models\Locacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $layout = 'layouts.admin';
        return view('adm.users.list', compact('users', 'layout'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view("users.edit", compact("user"));
    }

    public function update(Request $request, string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update($request->all());
            return redirect()->route("users.index")
                ->with("sucesso", "Registro alterado!");
        } catch (\Exception $e) {
            Log::error("Erro ao alterar o registro do usuario! " . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route("users.index")
                ->with("erro", "Erro ao alterar!");
        }
    }

    public function ViewCreateUser()
    {
        return view("adm.users.create");
    }

    public function CreateUser(Request $request)
    {
        try {
            $dados = $request->all();
            $dados["password"] = Hash::make($dados["password"]);
            User::create($dados);
            return redirect()->route("adm.user.list")->with("Sucesso", "Novo usuario registrado!");
        } catch (\Exception $e) {
            Log::error(
                "Erro ao criar o usuario: " . $e->getMessage(),
                [
                    "stack" => $e->getTraceAsString(),
                    "request" => $request->all()
                ]
            );
            return redirect()->intended(route("adm.user.list"));
        }
    }

    public function ViewEditUser(string $id)
    {
        $user = User::findOrFail($id);
        return view("adm.users.edit", compact("user", 'id'));
    }

    public function ViewUser(string $id)
    {
        $user = User::findOrFail($id);
        $layout = 'layouts.admin';
        return view('adm.users.show', compact('user', 'layout'));
    }

    public function EditUser(Request $request)
    {
        try {

            $user = User::findOrFail($request->id);

            $dataToUpdate = [];
            if ($request->filled('name')) {
                $dataToUpdate['name'] = $request->input('name');
            }
            if ($request->filled('email')) {
                $dataToUpdate['email'] = $request->input('email');
            }
            if ($request->filled('password')) {
                $dataToUpdate['password'] = Hash::make($request->input('password'));
            }
            if ($request->filled('telefone')) {
                $dataToUpdate['telefone'] = $request->input('telefone');
            }
            if ($request->filled('endereco')) {
                $dataToUpdate['endereco'] = $request->input('endereco');
            }
            if ($request->filled('cpf')) {
                $dataToUpdate['cpf'] = $request->input('cpf');
            }
            if ($request->filled('cnpj')) {
                $dataToUpdate['cnpj'] = $request->input('cnpj');
            }

            $user->update($dataToUpdate);


            return redirect()->route("adm.user.list")
                ->with("sucesso", "Registro atualizado!");
        } catch (\Exception $e) {
            Log::error("Erro ao atualizar seu registro de usuario! " . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route("adm.user.list")
                ->with("erro", "Erro ao atualizar!");
        }
    }

    public function deleteUser(Request $request, string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route("adm.user.list")
                ->with("sucesso", "Usuário deletado com sucesso!");
        } catch (\Exception $e) {
            Log::error("Erro ao deletar o usuário! " . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->route("adm.user.list")
                ->with("erro", "Erro ao deletar o usuário!");
        }
    }

    public function indexCategoria()
    {
        //
        $categorias = Categoria::all();
        return view("categorias.index", compact("categorias"));
    }

    public function ViewLocacaoList()
    {
        //
        $locacoes = Locacao::all();
        $equipamentos = Equipamento::all();
        return view("adm.locacoes.list", compact("locacoes", "equipamentos"));
    }

    public function ShowLocacao(string $id)
    {
        $locacao = Locacao::findOrFail($id);
        $equipamento = Equipamento::findOrFail($locacao->equipamento_id);
        return view("adm.locacoes.show", compact("locacao", "equipamento", 'id'));
    }

    public function LocacaoDelete(string $id)
    {
        //
        try {
            $locacao = Locacao::findOrFail($id);
            $locacao->delete();
            return redirect()->route("adm.locacao.list")
                ->with("sucesso", "Registro excluído!");
        } catch (QueryException $e) {
            // Error code 1451 = cannot delete or update because it's linked to another table
            if ($e->errorInfo[1] == 1451) {
                return redirect()->route("adm.locacao.list")
                    ->with('erro', 'Não é possível excluir esta locacao, pois ela está vinculada a outros registros.');
            }
        } catch (\Exception $e) {
            Log::error("Erro ao excluir o registro da locacao! " . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'id' => $id
            ]);
            return redirect()->route("adm.locacao.list")
                ->with("erro", "Erro ao excluir!");
        }
    }
    public function ViewEditLocacao(string $id)
    {
        $locacao = Locacao::findOrFail($id);
        $equipamento = Equipamento::findOrFail($locacao->equipamento_id);
        return view("adm.locacoes.edit", compact("locacao", 'equipamento', 'id'));
    }
    public function EditLocacao(Request $request)
    {
        try {

            $locacao = Locacao::findOrFail($request->id);
            $equipamento = Equipamento::findOrFail($locacao->equipamento_id);

            $dataToUpdate = [];
            if ($request->filled('data_inicio')) {
                $dataToUpdate['data_inicio'] = $request->input('data_inicio');
            }
            if ($request->filled('data_fim')) {
                $dataToUpdate['data_fim'] = $request->input('data_fim');
            }

            if ($request->filled('data_inicio') && !$request->filled('data_fim')) {
                $startDate = Carbon::createFromFormat("Y-m-d", $dataToUpdate['data_inicio'])->startOfDay();
                $endDate = Carbon::createFromFormat("Y-m-d", $locacao->data_fim)->endOfDay();
                $days = max(1, $startDate->diffInDays($endDate->copy()->startOfDay()) + 1);
                $equipamentoSafe = Equipamento::findOrFail($equipamento->id);
                $valorTotal = $equipamentoSafe->preco_periodo * $days;
                $dataToUpdate['valor_total'] = $valorTotal;
            }
            if (!$request->filled('data_inicio') && $request->filled('data_fim')) {
                $startDate = Carbon::createFromFormat("Y-m-d", $locacao->data_inicio)->startOfDay();
                $endDate = Carbon::createFromFormat("Y-m-d", $dataToUpdate['data_fim'])->endOfDay();
                $days = max(1, $startDate->diffInDays($endDate->copy()->startOfDay()) + 1);
                $equipamentoSafe = Equipamento::findOrFail($equipamento->id);
                $valorTotal = $equipamentoSafe->preco_periodo * $days;
                $dataToUpdate['valor_total'] = $valorTotal;
            }
            if ($request->filled('data_inicio') && $request->filled('data_fim')) {
                $startDate = Carbon::createFromFormat("Y-m-d", $dataToUpdate['data_inicio'])->startOfDay();
                $endDate = Carbon::createFromFormat("Y-m-d", $dataToUpdate['data_fim'])->endOfDay();
                $days = max(1, $startDate->diffInDays($endDate->copy()->startOfDay()) + 1);
                $equipamentoSafe = Equipamento::findOrFail($equipamento->id);
                $valorTotal = $equipamentoSafe->preco_periodo * $days;
                $dataToUpdate['valor_total'] = $valorTotal;
            }

            if ($request->filled('tipo_locacao')) {
                $dataToUpdate['tipo_locacao'] = $request->input('tipo_locacao');
            }
            if ($request->filled('status_equipamento')) {
                $dataToUpdate['status_equipamento'] = $request->input('status_equipamento');
            }
            if ($request->filled('status_pagamento')) {
                $dataToUpdate['status_pagamento'] = $request->input('status_pagamento');
            }

            $locacao->update($dataToUpdate);


            return redirect()->route("adm.locacao.list")
                ->with("sucesso", "Registro atualizado!");
        } catch (\Exception $e) {
            Log::error("Erro ao atualizar o registro da locacao! " . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route("adm.locacao.list")
                ->with("erro", "Erro ao atualizar!");
        }
    }

    public function ViewCreateLocacaoEquipamentos()
    {
        $anuncios = \App\Models\Anuncio::with(['equipamento', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();
        $equipamento = Equipamento::all();
        return view("adm.locacoes.equipamentos", compact('anuncios'));
    }


    public function ViewCreateLocacao(string $id)
    {
        $users = User::all();
        $equipamento = Equipamento::findOrFail($id);
        return view("adm.locacoes.create", compact('equipamento', 'users'));
    }

    public function CreateLocacao(Request $request)
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
            $equipamento = Equipamento::findOrFail($request->equipamento_id);
            $valorTotal = $equipamento->preco_periodo * $days;
            $dataComplete = array_merge(
                $data,
                [
                    'equipamento_id' => $request->equipamento_id,
                    'valor_total' => $valorTotal,
                    'created_by' => $request->created_by,
                ]
            );
            $locacao = Locacao::create($dataComplete);

            return redirect()->route("adm.locacao.list")
                ->with("sucesso", "Registro inserido!");
        } catch (\Exception $e) {
            echo "Erro ao salvar o registro da locacao! " . $e->getMessage();

        }

    }
}
