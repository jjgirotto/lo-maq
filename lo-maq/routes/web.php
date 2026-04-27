<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipamentoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController; //para o futuro
use App\Http\Controllers\ClienteController;

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

    // Rotas para o cliente
    Route::get('/minhaConta', [ClienteController::class, 'edit']);
    Route::patch('/minhaConta', [ClienteController::class, 'updateCredentials']);
    
});

//futuro middleware para admin
Route::get('/adm/users/create', [AdminController::class, 'ViewCreateUser'])->name('adm.user.create');
Route::post('/adm/users/create', [AdminController::class, 'CreateUser'])->name('adm.user.create');
Route::get('/adm/users/{id}/edit', [AdminController::class, 'ViewEditUser'])->name('adm.user.ViewEdit');
Route::patch('/adm/users/edit', [AdminController::class, 'EditUser'])->name('adm.user.edit');

Route::get('/admin', function () {
    return view('home.home-adm');
});