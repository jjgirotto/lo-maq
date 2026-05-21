@extends('layouts.default')

@section('conteudo')
<h3>Editar Locação #{{ $locacao->id }}</h3>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('locacoes.update', $locacao->id) }}">
    @csrf
    @method('PUT')

    @if(auth()->user()->access === 'ADM')
        <div class="mb-3">
            <label class="form-label">Usuário</label>
            <select name="usuario_id" class="form-select">
                @foreach($users as $u)
                    <option value="{{ $u->id }}" @if($u->id == $locacao->usuario_id) selected @endif>{{ $u->name }}</option>
                @endforeach
            </select>
        </div>
    @else
        <input type="hidden" name="usuario_id" value="{{ auth()->id() }}">
        <div class="mb-3">
            <label class="form-label">Locatário</label>
            <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
        </div>
    @endif

    <div class="mb-3">
        <label class="form-label">Equipamento</label>
        <select name="equipamento_id" class="form-select" required>
            @foreach($equipamentos as $eq)
                <option value="{{ $eq->id }}" data-preco="{{ $eq->preco_periodo }}" @if($eq->id == $locacao->equipamento_id) selected @endif>{{ $eq->nome ?? $eq->id }}</option>
            @endforeach
        </select>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Data Início</label>
            <input type="date" name="data_inicio" class="form-control" value="{{ $locacao->data_inicio }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Data Fim</label>
            <input type="date" name="data_fim" class="form-control" value="{{ $locacao->data_fim }}" required>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Valor Total</label>
        <input type="text" id="valor_total" name="valor_total" class="form-control" value="{{ $locacao->valor_total }}" readonly>
    </div>

    <button class="btn btn-primary">Atualizar</button>
    <a href="{{ route('locacoes.index') }}" class="btn btn-secondary">Cancelar</a>
</form>

<script>
    const dataInicioEl = document.querySelector('input[name="data_inicio"]');
    const dataFimEl = document.querySelector('input[name="data_fim"]');
    const equipamentoEl = document.querySelector('select[name="equipamento_id"]');
    const valorTotalEl = document.querySelector('#valor_total');
    const precoMap = {};

    document.querySelectorAll('select[name="equipamento_id"] option').forEach(option => {
        precoMap[option.value] = parseFloat(option.dataset.preco) || 0;
    });

    function calcularValorTotal() {
        const inicio = dataInicioEl.value;
        const fim = dataFimEl.value;
        const equipamentoId = equipamentoEl.value;
        const preco = precoMap[equipamentoId] || 0;

        if (!inicio || !fim || !preco) {
            valorTotalEl.value = '';
            return;
        }

        const dtInicio = new Date(inicio);
        const dtFim = new Date(fim);
        if (dtFim < dtInicio) {
            valorTotalEl.value = '';
            return;
        }

        const dias = Math.floor((dtFim - dtInicio) / (1000 * 60 * 60 * 24)) + 1;
        valorTotalEl.value = (dias * preco).toFixed(2);
    }

    [dataInicioEl, dataFimEl, equipamentoEl].forEach(el => {
        if (el) {
            el.addEventListener('change', calcularValorTotal);
        }
    });

    window.addEventListener('load', calcularValorTotal);
</script>

@endsection
