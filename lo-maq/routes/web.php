<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipamentoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Middleware\NivelAdmMiddleware;
use App\Http\Middleware\NivelCliMiddleware;


// --- 1. ROTAS PÚBLICAS ---
Route::get('/', [HomeController::class, 'indexPublic'])->name('home-cli-public');
Route::resource('/equipamentos', EquipamentoController::class);
Route::resource('/categorias', CategoriaController::class);


// Login e Registo (Pasta 'auth')
Route::get("/login", [AuthController::class, "ShowFormLogin"])->name("login");
Route::post("/login", [AuthController::class, "Login"]);
Route::get("/cadastrar", [AuthController::class, "ShowFormRegister"])->name("register");
Route::post("/cadastrar", [AuthController::class, "Register"])->name("register.post");


// --- 2. ROTAS PROTEGIDAS (PRECISA DE LOGIN) ---
Route::middleware("auth")->group(function () {
    
    Route::post("/logout", [AuthController::class, "Logout"])->name('logout');
    
    // Redireciona conforme o nível (ADM ou CLI)
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/minhaConta', [ClienteController::class, 'edit']);
    Route::patch('/minhaConta', [ClienteController::class, 'updateCredentials']);

    // --- Subgrupo: Administradores ---
    Route::middleware([NivelAdmMiddleware::class])->group(function () {
        Route::get('/adm', function () {
            return view('home.home-adm', ['layout' => 'layouts.admin']); 
        })->name('admin');

        Route::prefix('adm')->group(function () {
            // Pasta: resources/views/adm/users/...
            Route::get('/users', [AdminController::class, 'index'])->name('adm.user.list');
            Route::get('/users/create', [AdminController::class, 'ViewCreateUser'])->name('adm.user.create');
            Route::post('/users/create', [AdminController::class, 'CreateUser'])->name('adm.user.create');
            Route::get('/users/{id}', [AdminController::class, 'ViewUser'])->name('adm.user.show');
            Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('adm.user.delete');
            Route::get('/users/{id}/edit', [AdminController::class, 'ViewEditUser'])->name('adm.user.ViewEdit');
            Route::patch('/users/edit', [AdminController::class, 'EditUser'])->name('adm.user.edit');
        });
    });

    // --- Subgrupo: Clientes ---
    Route::middleware([NivelCliMiddleware::class])->group(function () {
        Route::get('/home-cli', function () {
            return view("home.home-cli", ['layout' => 'layouts.default']);
        })->name('home.cliente'); 
    });
});