<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipamentoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\LocacaoController;
use App\Http\Controllers\AvaliacaoController;

use App\Http\Middleware\NivelAdmMiddleware;
use App\Http\Middleware\NivelCliMiddleware;

// --- 1. ROTAS PÚBLICAS ---
Route::get('/', [HomeController::class, 'indexPublic'])->name('home-cli-public');
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

        // Locações ADM
        Route::get('/adm/locacoes', [AdminController::class, 'ViewLocacaoList'])->name('adm.locacao.list');
        Route::get('/adm/locacoes/create', [AdminController::class, 'ViewCreateLocacao'])->name('adm.locacao.create');
        Route::post('/adm/locacoes/create', [AdminController::class, 'CreateLocacao'])->name('adm.locacao.store');
        Route::get('/adm/locacoes/{id}', [AdminController::class, 'ShowLocacao'])->name('adm.locacao.show');
        Route::delete('/adm/locacoes/{id}', [AdminController::class, 'LocacaoDelete'])->name('adm.locacao.delete');
        Route::get('/adm/locacoes/{id}/edit', [AdminController::class, 'ViewEditLocacao'])->name('adm.locacao.ViewEdit');
        Route::patch('/adm/locacoes/edit', [AdminController::class, 'EditLocacao'])->name('adm.locacao.edit');

        // Avaliações ADM (Adicionadas aqui)
        Route::get('/adm/avaliar/{id}', [AdminController::class, 'Create'])->name('adm.avaliar');
        Route::post('/adm/avaliar/store/', [AdminController::class, 'Store'])->name('adm.avaliar.store');
        Route::get('/adm/avaliar/{id}/edit', [AdminController::class, 'EditAvaliacao'])->name('adm.avaliar.edit');
        Route::patch('/adm/avaliar/edit', [AdminController::class, 'UpdateAvaliacao'])->name('adm.avaliar.update');
        Route::delete('/adm/avaliar/edit/{id}', [AdminController::class, 'DestroyAvaliacao'])->name('adm.avaliar.destroy');
    });

    // --- Subgrupo: Clientes ---
    Route::middleware([NivelCliMiddleware::class])->group(function () {
        Route::get('/home-cli', function () {
            return view("home.home-cli", ['layout' => 'layouts.default']);
        })->name('home.cliente'); 
        
        // Locações Cliente
        Route::get('/locacoes', [LocacaoController::class, 'index'])->name('locacoes.index');
        Route::get('/locacoes/show/{id}', [LocacaoController::class, 'show'])->name('locacoes.show');
        Route::get('/locacoes/create', [LocacaoController::class, 'create'])->name('locacoes.create');
        Route::post('/locacoes', [LocacaoController::class, 'store'])->name('locacoes.store');

        // Equipamentos Cliente
        Route::resource('/equipamentos', EquipamentoController::class);

        // Avaliações Cliente
        Route::get('/locacoes/avaliar/{id}', [AvaliacaoController::class, 'Create'])->name('locacoes.avaliar');
        Route::post('/locacoes/avaliar/store/', [AvaliacaoController::class, 'Store'])->name('locacoes.avaliar.store');
        Route::get('/locacoes/avaliar/{id}/edit', [AvaliacaoController::class, 'Edit'])->name('locacoes.avaliar.edit');
        Route::patch('/locacoes/avaliar/edit', [AvaliacaoController::class, 'Update'])->name('locacoes.avaliar.update');
        Route::delete('/locacoes/avaliar/edit/{id}', [AvaliacaoController::class, 'Destroy'])->name('locacoes.avaliar.destroy');
    });

    // --- Rotas de Anúncios (ADM e CLI) ---
    Route::get('/anuncios', [AnuncioController::class, 'index'])->name('anuncios.index');
    Route::get('/meus-anuncios', [AnuncioController::class, 'meusAnuncios'])->name('anuncios.meus');

    // CRUD de Anúncios (somente logados podem criar, editar, deletar)
    Route::get('/anuncios/create', [AnuncioController::class, 'create'])->name('anuncios.create');
    Route::get('/anunciar', [AnuncioController::class, 'create'])->name('anunciar');
    Route::post('/anuncios', [AnuncioController::class, 'store'])->name('anuncios.store');
    Route::get('/anuncios/{id}/edit', [AnuncioController::class, 'edit'])->name('anuncios.edit');
    Route::put('/anuncios/{id}', [AnuncioController::class, 'update'])->name('anuncios.update');
    Route::delete('/anuncios/{id}', [AnuncioController::class, 'destroy'])->name('anuncios.destroy');
});

Route::get('/anuncios/{id}', [AnuncioController::class, 'show'])->name('anuncios.show');