<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locacoes', function (Blueprint $table) {
            $table->id();
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->string('status_equipamento', 50)->nullable();
            $table->tinyInteger('tipo_locacao')->nullable();
            $table->decimal('valor_total', 10, 2)->nullable();
            $table->string('status_pagamento', 50)->nullable();
    
            $table->foreignId('usuario_id')->constrained('users');
            $table->foreignId('equipamento_id')->constrained('equipamento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locacoes');
    }
};
