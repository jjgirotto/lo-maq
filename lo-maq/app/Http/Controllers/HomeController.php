<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->access == 'ADM') {
            return redirect()->route('admin'); 
        }

        // Se não for ADM, assume que é CLI
        return redirect()->route('home.cliente');
    }

    // Rota da sua Homepage Pública
    public function indexPublic(Request $request)
    {

        if (Auth::check()) {
            return $this->index();
        }
        
        return view('welcome');
    }
}