@extends($layout)

@section('conteudo')

    <h1>Criar Anúncio (Simples)</h1>

    @if(session('sucesso'))
        <div class="alert alert-success">{{ session('sucesso') }}</div>
    @endif

    @if(session('erro'))
        <div class="alert alert-danger">{{ session('erro') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('anuncios.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Anúncio</label>
            <input type="text" id="nome" name="nome" class="form-control" value="{{ old('nome') }}" required>
        </div>

        <div class="mb-3">
            <label for="equipamento_id" class="form-label">Equipamento</label>
            <select name="equipamento_id" id="equipamento_id" class="form-select" required>
                <option value="">Selecione um equipamento</option>
                @foreach($equipamentos as $equip)
                    @if($user->id == $equip->locador_id)
                        <option value="{{ $equip->id }}" {{ old('equipamento_id') == $equip->id ? 'selected' : '' }}>
                            {{ $equip->nome }} - {{ $equip->marca }} {{ $equip->modelo }} ({{ $equip->ano }})
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="valor_diaria" class="form-label">Valor da Diária</label>
            <input readonly type="number" step="0.01" id="valor_diaria" name="valor_diaria" class="form-control"
                value="{{ old('valor_diaria') }}" required>
        </div>

        <div class="mb-3">
            <label for="regiao" class="form-label">Região</label>
            <input readonly type="text" id="regiao" name="regiao" class="form-control" value="{{ old('regiao') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
    </form>

    <script>

        const equipamentos = @json($equipamentos);
        function calcularTotal() {
            const equipID = document.getElementById('equipamento_id').value;
            const equip = equipamentos.find(e => e.id == equipID);
            if (!equip) return;

            const precoPeriodo = parseFloat(equip.preco_periodo);
            const regiao = equip.regiao;

            const totalSpan = document.getElementById('valor_diaria');
            const regiaoSpan = document.getElementById('regiao');


            totalSpan.value = precoPeriodo.toFixed(2);
            regiaoSpan.value = regiao;
        }

        document.getElementById('equipamento_id').addEventListener('change', calcularTotal);
    </script>

@endsection