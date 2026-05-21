@extends('layouts.default')

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Locações</h3>
    <a href="{{ route('locacoes.create') }}" class="btn btn-primary">Nova Locação</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Usuário</th>
            <th>Equipamento</th>
            <th>Período</th>
            <th>Valor</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($locacoes as $l)
        <tr>
            <td>{{ $l->id }}</td>
            <td>{{ $l->usuario->name ?? $l->usuario_id }}</td>
            <td>{{ $l->equipamento->nome ?? $l->equipamento_id }}</td>
            <td>{{ $l->data_inicio }} → {{ $l->data_fim }}</td>
            <td>{{ $l->valor_total }}</td>
            <td>
                <a href="{{ route('locacoes.show', $l->id) }}" class="btn btn-sm btn-info">Ver</a>
                <a href="{{ route('locacoes.edit', $l->id) }}" class="btn btn-sm btn-secondary">Editar</a>
                <form action="{{ route('locacoes.destroy', $l->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Remover locação?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Remover</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $locacoes->links() }}

@endsection
