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
        Schema::create('equipamento', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome');
            $table->string('marca');
            $table->string('modelo');
            $table->string('image_path')->nullable();
            $table->integer('ano');
            $table->string('capacidade');
            $table->float('preco_periodo');
            $table->string('disponibilidade_calendario');
            $table->string('regiao');
            $table->boolean('exige_operador_certificado');
            $table->boolean('seguro_obrigatorio');
            $table->boolean('caucao_obrigatoria');

            $table->foreignId('locador_id')->constrained('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('categoria_id')->constrained('categoria')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipamento');
    }
};
