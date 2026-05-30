@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Editar Avaliação #{{ $avaliacao->id }}</h2>

    <form action="{{ route('avaliacoes.update', $avaliacao->id) }}" method="POST">
        @csrf
        @method('PUT') 

        <div class="form-group">
            <label for="nota">Nota (1 a 5)</label>
            <input type="number" name="nota" id="nota" class="form-control" value="{{ $avaliacao->nota }}" required>
        </div>

        <div class="form-group mt-2">
            <label for="comentario">Comentário</label>
            <textarea name="comentario" id="comentario" class="form-control" rows="4">{{ $avaliacao->comentario }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Atualizar</button>
        <a href="{{ route('avaliacoes.index') }}" class="btn btn-secondary mt-3">Voltar</a>
    </form>
</div>
@endsection