@extends($layout)

@section('conteudo')

    <h1>Dados da Locacao</h1>
    <form method="post" action="{{ route('adm.locacao.show', $locacao->id) }}">
        @CSRF
        @METHOD('DELETE')

        <div class="mb-3">
            <label class="form-label">{{ $equipamento->nome }}</label>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ $equipamento->marca }}</label>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ $equipamento->modelo }}</label>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ $equipamento->image_path }}</label>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ $equipamento->ano }}</label>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ $equipamento->capacidade }}</label>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ $equipamento->preco_periodo }}</label>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ $equipamento->exige_operador_certificado }}</label>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ $equipamento->seguro_obrigatorio }}</label>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ $equipamento->caucao_obrigatoria }}</label>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ \Carbon\Carbon::parse($locacao->data_inicio)->format('d/m/Y') }}</label>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ \Carbon\Carbon::parse($locacao->data_fim)->format('d/m/Y') }}</label>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ $locacao->status_equipamento }}</label>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ $locacao->tipo_locacao }}</label>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ $locacao->valor_total }}</label>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ $locacao->status_pagamento }}</label>
        </div>

        <p>Deseja excluir esse registro?</p>
        <button type="submit" class="btn btn-danger">Sim</button>
        <a href="#" class="btn btn-secondary" onClick="history.back()">
            Não
        </a>
    </form>

@endsection