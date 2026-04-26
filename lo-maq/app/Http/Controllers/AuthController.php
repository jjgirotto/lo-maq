<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Mostra a sua tela de Login
    public function ShowFormLogin()
    {
        if (!Auth::check()) {
            return view('auth.login'); // Sem compact('layout')!
        }
        return redirect()->intended(route('home'));
    }
    // 2. Processa o Login quando o usuário clica em "Entrar"
    public function Login(Request $request)
    {
        $credentials = $request->only("email", "password");
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect("/"); // Sucesso: vai para a Home
        } else {
            // Erro: volta para o login com mensagem
            return redirect()->route("login")->with("erro", "Credenciais inválidas");
        }
    }

    // 3. Processa o botão de "Sair"
    public function Logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("login");
    }
}