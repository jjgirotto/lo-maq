@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Detalhes da Avaliação</h2>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Avaliação #{{ $avaliacao->id }}</h5>
            <p><strong>Nota:</strong> {{ $avaliacao->nota }} / 5</p>
            <p><strong>Comentário:</strong> {{ $avaliacao->comentario }}</p>
            <p><strong>Criado em:</strong> {{ $avaliacao->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('avaliacoes.index') }}" class="btn btn-secondary">Voltar</a>
        <a href="{{ route('avaliacoes.edit', $avaliacao->id) }}" class="btn btn-warning">Editar</a>
    </div>
</div>
@endsection