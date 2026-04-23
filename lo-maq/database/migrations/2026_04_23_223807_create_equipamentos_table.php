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
        Schema::create('equipamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->integer('ano')->nullable();
            $table->string('capacidade')->nullable();
            $table->decimal('preco_periodo', 10, 2);
            $table->text('disponibilidade_calendario')->nullable();
            $table->decimal('raio_atendimento', 10, 2)->nullable();
            $table->boolean('exige_operador_certified')->default(false);
            $table->boolean('seguro_obrigatorio')->default(false);
            $table->boolean('caucao_obrigatoria')->default(false);
            // Chaves Estrangeiras
            $table->foreignId('usuario_id')->constrained('usuarios');
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipamentos');
    }
};
