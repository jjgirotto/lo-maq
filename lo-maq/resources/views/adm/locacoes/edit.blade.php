@extends($layout)

@section('conteudo')
    <h1>Nova Locacao</h1>
    <form method="post" action="{{ route('adm.locacao.create', $equipamento) }}">
        @CSRF
        <input type="hidden" id="equipamento_id" name="equipamento_id" value="{{ $equipamento->id }}">
        <div class="mb-3">
            <h3>{{ $equipamento->nome }}</h3>
            <p><strong>Valor por dia:</strong> R$ {{ number_format($equipamento->preco_periodo, 2, ',', '.') }}</p>
        </div>

        <div class="mb-3">
            <label for="data_inicio" class="form-label">data_inicio:</label>
            <input type="date" id="data_inicio" name="data_inicio" class="form-control" required="">
        </div>
        <div class="mb-3">
            <label for="data_fim" class="form-label">data_fim:</label>
            <input type="date" id="data_fim" name="data_fim" class="form-control" required="">
        </div>
        <div class="mb-3">
            <h3>Total: R$ <span id="valor_total">0.00</span></h3>
        </div>
        <div class="mb-3">
            <label for="tipo_locacao" class="form-label">tipo_locacao:</label>
            <input type="hidden" id="tipo_locacao" name="tipo_locacao" value="0">
            <input type="checkbox" id="tipo_locacao" name="tipo_locacao" value="1">
        </div>
        <div class="mb-3">
            <label for="created_by" class="form-label">created_by</label>
            <select name="created_by" id="created_by" class="form-select" required>
                @foreach($users as $u)
                    <option value="{{ $u->id }}">
                        {{ $u->name }}
                    </option>
                @endforeach
            </select>
        </div>



        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>


    <script>
        const valorDia = {{ $equipamento->preco_periodo }};

        function calcularTotal() {
            const inicio = document.getElementById('data_inicio').value;
            const fim = document.getElementById('data_fim').value;
            const totalSpan = document.getElementById('valor_total');

            if (inicio && fim) {
                const dataInicio = new Date(inicio);
                const dataFim = new Date(fim);

                // Difference in milliseconds → days
                const diffTime = dataFim - dataInicio;
                const diffDias = diffTime / (1000 * 60 * 60 * 24);

                if (diffDias >= 0) {
                    const total = (diffDias + 1) * valorDia;
                    totalSpan.textContent = total.toFixed(2);
                } else {
                    totalSpan.textContent = "0.00";
                }
            }
        }

        document.getElementById('data_inicio').addEventListener('change', calcularTotal);
        document.getElementById('data_fim').addEventListener('change', calcularTotal);
    </script>

@endsection