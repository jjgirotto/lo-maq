@extends($layout)

@section('conteudo')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Editar Locação</h1>
        <a href="{{ route('adm.locacao.list') }}" class="btn btn-secondary">Voltar</a>
    </div>

    <form method="post" action="{{ route('adm.locacao.edit') }}">
        @csrf
        @method('PATCH')
        <input type="hidden" name="id" value="{{ $locacao->id }}">

        <div class="card mb-4">
            <div class="card-header">
                <strong>Equipamento</strong>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="equipamento_id" class="form-label">Equipamento</label>
                        <select name="equipamento_id" id="equipamento_id" class="form-select" required>
                            @foreach($equipamentos as $eq)
                                <option value="{{ $eq->id }}" data-preco="{{ $eq->preco_periodo }}"
                                    @selected($eq->id == $locacao->equipamento_id)>
                                    {{ $eq->nome }} — {{ $eq->marca }}
                                </option>
                            @endforeach
                        </select>
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
                    <div class="col-md-4">
                        <label for="data_inicio" class="form-label">Data de início</label>
                        <input type="date" id="data_inicio" name="data_inicio" class="form-control"
                            value="{{ \Carbon\Carbon::parse($locacao->data_inicio)->format('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="data_fim" class="form-label">Data de fim</label>
                        <input type="date" id="data_fim" name="data_fim" class="form-control"
                            value="{{ \Carbon\Carbon::parse($locacao->data_fim)->format('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Valor total</label>
                        <input type="text" id="valor_total" class="form-control"
                            value="R$ {{ number_format($locacao->valor_total, 2, ',', '.') }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="created_by" class="form-label">Locador</label>
                        <select name="created_by" id="created_by" class="form-select" required>
                            @foreach($users as $u)
                                <option value="{{ $u->id }}" @selected($u->id == $locacao->created_by)>
                                    {{ $u->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="usuario_id" class="form-label">Locatário</label>
                        <select name="usuario_id" id="usuario_id" class="form-select" required>
                            @foreach($users as $u)
                                <option value="{{ $u->id }}" @selected($u->id == $locacao->usuario_id)>
                                    {{ $u->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input type="hidden" name="status_pagamento" value="0">
                            <input type="checkbox" class="form-check-input" id="status_pagamento" name="status_pagamento" value="1"
                                @if(\App\Models\Locacao::statusPagamentoAtivo($locacao->status_pagamento)) checked @endif>
                            <label class="form-check-label" for="status_pagamento">Pagamento realizado</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{ route('adm.locacao.list') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>

    <script>
        const precoMap = {};
        document.querySelectorAll('#equipamento_id option').forEach(option => {
            precoMap[option.value] = parseFloat(option.dataset.preco) || 0;
        });

        function calcularTotal() {
            const inicio = document.getElementById('data_inicio').value;
            const fim = document.getElementById('data_fim').value;
            const equipamentoId = document.getElementById('equipamento_id').value;
            const valorDia = precoMap[equipamentoId] || 0;
            const totalInput = document.getElementById('valor_total');

            if (inicio && fim && valorDia) {
                const dataInicio = new Date(inicio);
                const dataFim = new Date(fim);
                const diffTime = dataFim - dataInicio;
                const diffDias = diffTime / (1000 * 60 * 60 * 24);

                if (diffDias >= 0) {
                    const total = (diffDias + 1) * valorDia;
                    totalInput.value = 'R$ ' + total.toFixed(2).replace('.', ',');
                } else {
                    totalInput.value = 'R$ 0,00';
                }
            }
        }

        document.getElementById('equipamento_id').addEventListener('change', calcularTotal);
        document.getElementById('data_inicio').addEventListener('change', calcularTotal);
        document.getElementById('data_fim').addEventListener('change', calcularTotal);
    </script>

@endsection
