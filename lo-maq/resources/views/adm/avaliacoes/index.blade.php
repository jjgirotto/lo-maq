@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Lista de Avaliações</h2>
    <a href="{{ route('avaliacoes.create') }}" class="btn btn-primary">Nova Avaliação</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nota</th>
                <th>Comentário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($avaliacoes as $avaliacao)
            <tr>
                <td>{{ $avaliacao->id }}</td>
                <td>{{ $avaliacao->nota }}</td>
                <td>{{ $avaliacao->comentario }}</td>
                <td>
                    <a href="{{ route('avaliacoes.show', $avaliacao->id) }}" class="btn btn-info btn-sm">Ver</a>
                    
                    <a href="{{ route('avaliacoes.edit', $avaliacao->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    
                    <form action="{{ route('avaliacoes.destroy', $avaliacao->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection