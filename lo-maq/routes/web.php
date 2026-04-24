<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipamentoController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/equipamentos', EquipamentoController::class);
