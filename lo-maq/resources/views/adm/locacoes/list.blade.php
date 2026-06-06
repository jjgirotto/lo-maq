@extends($layout)

@section('conteudo')

    <h2>Locações</h2>
    @if(session('sucesso'))
        <p class="text-success">{{ session('sucesso') }}</p>
    @endif
    @if(session('erro'))
        <p class="text-danger">{{ session('erro') }}</p>
    @endif
    <a href="{{ route('adm.locacao.create') }}" class="btn btn-success mb-3">Nova Locação</a>
    <div class="table-responsive rounded-3">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Marca</th>
                    <th>Locatário</th>
                    <th>Início</th>
                    <th>Fim</th>
                    <th>Total</th>
                    <th>Pagamento</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($locacoes as $l)
                    <tr class="align-middle">
                        <td>{{ $l->equipamento->nome ?? '—' }}</td>
                        <td>{{ $l->equipamento->marca ?? '—' }}</td>
                        <td>{{ $l->usuario->name ?? '—' }}</td>
                        <td>{{ \Carbon\Carbon::parse($l->data_inicio)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($l->data_fim)->format('d/m/Y') }}</td>
                        <td>{{ $l->valor_total }}</td>
                        <td>{{ $l->statusPagamentoLabel() }}</td>
                        <td class="text-end">
                            <div class="d-flex flex-wrap justify-content-end gap-2">
                                <a href="{{ route('adm.locacao.ViewEdit', $l->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <a href="{{ route('adm.locacao.show', $l->id) }}" class="btn btn-sm btn-info">Consultar</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Nenhuma locação encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
