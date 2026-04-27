<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ClienteController extends Controller
{
    public function updateCredentials(Request $request)
    {
        try {
            $user = Auth::user();

            if (!Hash::check($request->input('passwordOld'), $user->password)) {
                return redirect()->route("home")
                    ->with("erro", "Senha atual incorreta!");
            }

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


            return redirect()->route("home")
                ->with("sucesso", "Registro atualizado!");
        } catch (\Exception $e) {
            Log::error("Erro ao atualizar seu registro de usuario! " . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route("home")
                ->with("erro", "Erro ao atualizar!");
        }
    }

    public function edit()
    {
        $user = Auth::user();
        return view("users.edit", compact("user"));
    }
}
