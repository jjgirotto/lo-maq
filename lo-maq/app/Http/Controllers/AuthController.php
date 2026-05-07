<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Exibe o formulário de Login
    public function ShowFormLogin()
    {
        if (!Auth::check()) {
            // Ajuste o caminho 'layouts.default' conforme a sua estrutura de pastas
            return view('auth.login', ['layout' => 'layouts.default']); 
        }
        return redirect()->intended(route('home'));
    }

    // Exibe o formulário de Registo
    public function ShowFormRegister()
    {
        return view('auth.register', ['layout' => 'layouts.default']);
    }

    public function Register(Request $request)
    {
        // Validação: Senha mínima de 3 caracteres
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed', 
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'access'   => 'CLI', 
        ]);

        // Login automático após registo
        Auth::login($user);

        return redirect()->route('home')->with('Sucesso', 'Conta criada com sucesso!');
    }

    public function Login(Request $request)
    {
        $credentials = $request->only("email", "password");
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        return redirect()->route("login")->with("erro", "Credenciais inválidas");
    }

    public function Logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("login");
    }
}