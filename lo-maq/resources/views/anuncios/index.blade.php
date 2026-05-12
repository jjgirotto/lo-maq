@extends($layout)

@section('conteudo')

<h2>Anúncios</h2>

@if(session('sucesso'))
    <p class="text-success">{{ session('sucesso') }}</p>
@endif
@if(session('erro'))
    <p class="text-danger">{{ session('erro') }}</p>
@endif

<a href="{{ route('anuncios.create') }}" class="btn btn-success mb-3">Novo Anúncio</a>

<div class="table-responsive rounded-3">
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>Título</th>
                <th>Equipamento</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Criado em</th>
                <th class="text-end"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($anuncios as $a)
                <tr class="align-middle">
                    <td style="max-width: 180px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $a->titulo }}">
                        {{ Str::limit($a->nome, 25) }}
                    </td>
                    <td>{{ $a->equipamento->nome ?? '-' }}</td>
                    <td>{{ $a->equipamento->categoria->titulo ?? '-' }}</td>
                    <td>R$ {{ number_format($a->equipamento->preco_periodo ?? 0, 2, ',', '.') }}</td>

                    <td>{{ $a->created_at->format('d/m/Y') }}</td>
                    <td class="text-end">
                        <div class="d-flex flex-wrap justify-content-end gap-2">
                            <a href="{{ route('anuncios.edit', $a->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <a href="{{ route('anuncios.show', $a->id) }}" class="btn btn-sm btn-info">Consultar</a>
                            <form action="{{ route('anuncios.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Deseja excluir este anúncio?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Nenhum anúncio encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
