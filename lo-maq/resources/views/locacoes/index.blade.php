@extends($layout)

@section('conteudo')

    <h2>Locações</h2>
    @if(session('sucesso'))
        <p class="text-success">{{ session('sucesso') }}</p>
    @endif
    @if(session('erro'))
        <p class="text-danger">{{ session('erro') }}</p>
    @endif
    <div class="table-responsive rounded-3">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Marca</th>
                    <th>Inicio</th>
                    <th>Fim</th>
                    <th>Qtd. Colab</th>
                    <th>Preco Total</th>
                    <th>Preco Indiv.</th>
                    <th>Status</th>
                    <th>Pagamento</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @foreach($locacoes as $l)
                    <div>
                        <tr class="align-middle">
                            @foreach ($equipamentos as $e)
                                @if ($e->id == $l->equipamento_id)
                                    <td>
                                        {{ $e->nome }}
                                    </td>
                                    <td>
                                        {{ $e->marca }}
                                    </td>
                                @endif
                            @endforeach

                            <td>{{ Carbon\Carbon::parse($l->data_inicio)->format('d/m/Y') }}</td>
                            <td>{{ Carbon\Carbon::parse($l->data_fim)->format('d/m/Y') }}</td>
                            <td>{{ $locatariosDasLocacoes->where('locacao_id', $l->id)->count() }}</td>
                            <td>{{ $l->valor_total }}</td>
                            @php
                                $qtd = $locatariosDasLocacoes->where('locacao_id', $l->id)->count();
                                $individual = $qtd > 0 ? $l->valor_total / $qtd : 0;
                            @endphp
                            <td>{{ number_format($individual, 2, ',', '.') }}</td>
                            <td>{{ $l->status_equipamento }}</td>
                            <td>{{ $l->status_pagamento }}</td>

                            <td class="text-end">
                                <div class="d-flex flex-wrap justify-content-end gap-2">
                                    <a href="{{ route('locacoes.avaliar', $l->id) }}" class="btn btn-sm btn-warning">Avaliar</a>
                                    <a href="{{ route('locacoes.showAdd', $l->id) }}" class="btn btn-sm btn-warning">ADD</a>
                                    <a href="{{ route('locacoes.show', $l->id) }}" class="btn btn-sm btn-info">Consultar</a>
                                </div>
                            </td>
                        </tr>
                    </div>
                @endforeach
            </tbody>
        </table>

@endsection