@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Criar Nova Avaliação</h2>

    <form action="{{ route('avaliacoes.store') }}" method="POST">
        @csrf 

        <div class="form-group">
            <label for="nota">Nota (1 a 5)</label>
            <input type="number" name="nota" id="nota" class="form-control" min="1" max="5" required>
        </div>

        <div class="form-group mt-2">
            <label for="comentario">Comentário</label>
            <textarea name="comentario" id="comentario" class="form-control" rows="4"></textarea>
        </div>

        <button type="submit" class="btn btn-success mt-3">Salvar Avaliação</button>
        <a href="{{ route('avaliacoes.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
</div>
@endsection