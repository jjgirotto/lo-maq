@extends($layout)

@section('conteudo')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Consulta de Locação</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('adm.locacao.list') }}" class="btn btn-secondary">Voltar</a>
            <a href="{{ route('adm.locacao.ViewEdit', $locacao->id) }}" class="btn btn-warning">Editar</a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <strong>Equipamento</strong>
        </div>
        <div class="card-body">
            <div class="row g-3">
                @if($equipamento->image_path)
                    <div class="col-12">
                        <label class="form-label">Imagem</label>
                        <div>
                            <img src="{{ asset('storage/' . $equipamento->image_path) }}"
                                alt="{{ $equipamento->nome }}"
                                class="img-thumbnail"
                                style="max-height: 200px;">
                        </div>
                    </div>
                @endif
                <div class="col-md-6">
                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control" value="{{ $equipamento->nome }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Marca</label>
                    <input type="text" class="form-control" value="{{ $equipamento->marca }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Modelo</label>
                    <input type="text" class="form-control" value="{{ $equipamento->modelo }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Ano</label>
                    <input type="text" class="form-control" value="{{ $equipamento->ano }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Capacidade</label>
                    <input type="text" class="form-control" value="{{ $equipamento->capacidade }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Preço por período</label>
                    <input type="text" class="form-control"
                        value="R$ {{ number_format($equipamento->preco_periodo, 2, ',', '.') }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Operador certificado</label>
                    <input type="text" class="form-control"
                        value="{{ $equipamento->exige_operador_certificado ? 'Sim' : 'Não' }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Seguro obrigatório</label>
                    <input type="text" class="form-control"
                        value="{{ $equipamento->seguro_obrigatorio ? 'Sim' : 'Não' }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Caução obrigatória</label>
                    <input type="text" class="form-control"
                        value="{{ $equipamento->caucao_obrigatoria ? 'Sim' : 'Não' }}" readonly>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <strong>Dados da locação</strong>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Locador</label>
                    <input type="text" class="form-control"
                        value="{{ $locacao->locador->name ?? '—' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Locatário</label>
                    <input type="text" class="form-control"
                        value="{{ $locacao->usuario->name ?? '—' }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Data de início</label>
                    <input type="text" class="form-control"
                        value="{{ \Carbon\Carbon::parse($locacao->data_inicio)->format('d/m/Y') }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Data de fim</label>
                    <input type="text" class="form-control"
                        value="{{ \Carbon\Carbon::parse($locacao->data_fim)->format('d/m/Y') }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Valor total</label>
                    <input type="text" class="form-control"
                        value="R$ {{ number_format($locacao->valor_total, 2, ',', '.') }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Pagamento realizado</label>
                    <input type="text" class="form-control" value="{{ $locacao->statusPagamentoLabel() }}" readonly>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-danger">
        <div class="card-body">
            <p class="mb-3">Deseja excluir esse registro?</p>
            <form method="post" action="{{ route('adm.locacao.show', $locacao->id) }}" class="d-flex gap-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Sim, excluir</button>
                <a href="{{ route('adm.locacao.list') }}" class="btn btn-secondary">Não</a>
            </form>
        </div>
    </div>

@endsection
