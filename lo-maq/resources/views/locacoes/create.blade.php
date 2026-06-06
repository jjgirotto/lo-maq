@extends($layout)

@section('conteudo')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Nova Locação</h1>
        <a href="{{ route('locacoes.index') }}" class="btn btn-secondary">Voltar</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('locacoes.store') }}">
        @csrf
        <input type="hidden" name="usuario_id" value="{{ auth()->id() }}">

        <div class="card mb-4">
            <div class="card-header">
                <strong>Equipamento</strong>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="equipamento_id" class="form-label">Equipamento</label>
                        <select name="equipamento_id" id="equipamento_id" class="form-select" required>
                            <option value="" disabled @selected(empty($equipamentoSelecionado))>Selecione um equipamento</option>
                            @foreach($equipamentos as $eq)
                                <option value="{{ $eq->id }}" data-preco="{{ $eq->preco_periodo }}"
                                    @selected(!empty($equipamentoSelecionado) && $eq->id == $equipamentoSelecionado)>
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
                        <input type="date" id="data_inicio" name="data_inicio" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="data_fim" class="form-label">Data de fim</label>
                        <input type="date" id="data_fim" name="data_fim" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Valor total</label>
                        <input type="text" id="valor_total" class="form-control" value="R$ 0,00" readonly>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{ route('locacoes.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>

    <script>
        const precoMap = {};
        document.querySelectorAll('#equipamento_id option').forEach(option => {
            if (option.value) {
                precoMap[option.value] = parseFloat(option.dataset.preco) || 0;
            }
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
            } else {
                totalInput.value = 'R$ 0,00';
            }
        }

        document.getElementById('equipamento_id').addEventListener('change', calcularTotal);
        document.getElementById('data_inicio').addEventListener('change', calcularTotal);
        document.getElementById('data_fim').addEventListener('change', calcularTotal);
    </script>

@endsection
