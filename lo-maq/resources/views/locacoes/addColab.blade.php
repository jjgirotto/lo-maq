@extends($layout)

@section('conteudo')

    <h1>Adicionar Colaborador</h1>
    <form method="post" action="{{ route('locacoes.addColab') }}">
        @CSRF

        <input type="hidden" id='locacao_id' name='locacao_id' value="{{ $locacao->id }}">
        <input type="hidden" id="data_inicio" name="data_inicio" value="{{ $locacao->data_inicio }}" required="">
        <input type="hidden" id="data_fim" name="data_fim" value="{{ $locacao->data_fim }}" required="">

        <div class="mb-3">
            <label for="id_colab" class="form-label">Selecione o Locatario:</label>
            <select class="form-select" name="id_colab" id="id_colab">
                @foreach($locadores as $l)
                    <option value="{{$l->id}}">{{ $l->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

@endsection