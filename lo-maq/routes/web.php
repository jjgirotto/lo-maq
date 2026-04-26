<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipamentoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController; //para o futuro

Route::get('/', [HomeController::class, 'indexPublic'])->name('home-cli');

Route::resource('/equipamentos', EquipamentoController::class);

// LOGIN/LOGOUT
Route::get("/login", [AuthController::class, "ShowFormLogin"])->name("login");
Route::post("/login", [AuthController::class, "Login"]);

//middleware: rotas protegidas
Route::middleware("auth")->group(function () {
    
    // Rota de logout
    Route::post("/logout", [AuthController::class, "Logout"]);
    
    // Homepage após o usuário fazer o login com sucesso
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
});