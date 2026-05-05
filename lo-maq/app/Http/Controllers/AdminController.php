<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
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
}
