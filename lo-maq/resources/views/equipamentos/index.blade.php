@extends($layout)

@section('conteudo')

    <h2>Equipamentos</h2>
    @if(session('sucesso'))
        <p class="text-success">{{ session('sucesso') }}</p>
    @endif
    @if(session('erro'))
        <p class="text-danger">{{ session('erro') }}</p>
    @endif
    <a href="/equipamentos/create" class="btn btn-success mb-3">Novo Registro</a>
    <div class="table-responsive rounded-3">
    <table class="table table-hover table-striped">
        <thead>
            <tr >
                <th>Categoria</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Região</th>
                <th>Locador</th>
                <th>Operador Cert.</th>
                <th>Seguro</th>
                <th>Caução</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($equipamentos as $e)
                <tr class="align-middle">
                    <td>
                        @foreach ($categorias as $c)
                        @if ($e->categoria_id == $c->id)
                        {{ $c->titulo }}
                        @endif
                        @endforeach
                    </td>
                    <td style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $e->nome }}">
                    {{ Str::limit($e->nome, 20) }}
                    </td>
                    
                    <td>{{ $e->preco_periodo }}</td>
                    <td>{{ $e->regiao }}</td>
                    <td>
                        @foreach ($locador as $l)
                            @if ($e->locador_id == $l->id)
                                {{ $l->name }}
                            @endif
                        @endforeach
                    </td>
                    <td class="text-center">
                        @if($e->exige_operador_certificado == 0)
                            <img src="{{ asset('images/xmark.svg') }}" width="20rem">
                        @else
                            <img src="{{ asset('images/checkmark.svg') }}" width="20rem">
                        @endif
                    </td>
                    <td class="text-center">
                        @if($e->seguro_obrigatorio == 0)
                            <img src="{{ asset('images/xmark.svg') }}" width="20rem">
                        @else
                            <img src="{{ asset('images/checkmark.svg') }}" width="20rem">
                        @endif
                    </td>
                    <td class="text-center">
                        @if($e->caucao_obrigatoria == 0)
                            <img src="{{ asset('images/xmark.svg') }}" width="20rem">
                        @else
                            <img src="{{ asset('images/checkmark.svg') }}" width="20rem">
                        @endif
                    </td>
                    <td class="text-end">
                        <div class="d-flex flex-wrap justify-content-end gap-2">
                            <a href="/equipamentos/{{ $e->id }}/edit" class="btn btn-sm btn-warning">Editar</a>
                            <a href="/equipamentos/{{ $e->id }}" class="btn btn-sm btn-info">Consultar</a>
                        </div>
                    </td>
                </tr>
            </div>
            @endforeach
        </tbody>
    </table>

@endsection