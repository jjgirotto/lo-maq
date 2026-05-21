@extends('layouts.default')

@section('conteudo')
<h3>Locação #{{ $locacao->id }}</h3>

<div class="card mb-3">
    <div class="card-body">
        <p><strong>Usuário:</strong> {{ $locacao->usuario->name ?? $locacao->usuario_id }}</p>
        <p><strong>Equipamento:</strong> {{ $locacao->equipamento->nome ?? $locacao->equipamento_id }}</p>
        <p><strong>Período:</strong> {{ $locacao->data_inicio }} → {{ $locacao->data_fim }}</p>
        <p><strong>Valor Total:</strong> {{ $locacao->valor_total }}</p>
        <p><strong>Status Pagamento:</strong> {{ $locacao->status_pagamento }}</p>
    </div>
</div>

<a href="{{ route('locacoes.index') }}" class="btn btn-secondary mt-3">Voltar</a>

@endsection
