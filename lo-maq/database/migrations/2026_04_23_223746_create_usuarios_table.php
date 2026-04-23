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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // INT UNSIGNED AUTO_INCREMENT
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('senha');
            $table->enum('tipo', ['locador', 'locatario', 'admin']);
            $table->string('telefone', 20)->nullable();
            $table->string('endereco')->nullable();
            $table->string('documento', 20)->nullable();
            $table->float('reputacao_media')->default(0);
            $table->timestamps(); // Cria created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
