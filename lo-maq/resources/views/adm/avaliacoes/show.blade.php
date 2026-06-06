@extends($layout)

@section('conteudo')

    <h1>Editar Avaliacao</h1>
    <h1>{{ $equipamento->nome }}</h1>
    <form method="POST" action="{{ route('adm.avaliar.update', $avaliacao->id) }}">
        @CSRF
        <input type="hidden" name="_method" id="methodField" value="PATCH">

        <input type="hidden" name="id" id="id" value="{{$avaliacao->id}}">


        <div class="mb-3">
            <p><strong>Valor por dia:</strong> R$ {{ number_format($equipamento->preco_periodo, 2, ',', '.') }}</p>
        </div>

        <div class="mb-3">
            <label for="nota" class="form-label">nota:</label>

            <input type="radio" id="star1" name="nota" value="1" {{ $avaliacao->nota == "1" ? 'checked' : '' }} />
            <label for="star1">1&#9733;</label>
            <input type="radio" id="star2" name="nota" value="2" {{ $avaliacao->nota == "2" ? 'checked' : '' }} />
            <label for="star2">&#9733;</label>
            <input type="radio" id="star3" name="nota" value="3" {{ $avaliacao->nota == "3" ? 'checked' : '' }} />
            <label for="star3">&#9733;</label>
            <input type="radio" id="star4" name="nota" value="4" {{ $avaliacao->nota == "4" ? 'checked' : '' }} />
            <label for="star4">&#9733;</label>
            <input type="radio" id="star5" name="nota" value="5" {{ $avaliacao->nota == "5" ? 'checked' : '' }} />
            <label for="star5">5&#9733;</label>
        </div>

        <div class="mb-3">
            <label for="estado_equipamento" class="form-label">estado_equipamento:</label>

            <input type="radio" id="estado1" name="estado_equipamento" value="1" {{ $avaliacao->estado_equipamento == "1" ? 'checked' : '' }} />
            <label for="estado1">1&#9733;</label>
            <input type="radio" id="estado2" name="estado_equipamento" value="2" {{ $avaliacao->estado_equipamento == "2" ? 'checked' : '' }} />
            <label for="estado2">&#9733;</label>
            <input type="radio" id="estado3" name="estado_equipamento" value="3" {{ $avaliacao->estado_equipamento == "3" ? 'checked' : '' }} />
            <label for="estado3">&#9733;</label>
            <input type="radio" id="estado4" name="estado_equipamento" value="4" {{ $avaliacao->estado_equipamento == "4" ? 'checked' : '' }} />
            <label for="estado4">&#9733;</label>
            <input type="radio" id="estado5" name="estado_equipamento" value="5" {{ $avaliacao->estado_equipamento == "5" ? 'checked' : '' }} />
            <label for="estado5">5&#9733;</label>
        </div>

        <div class="mb-3">
            <label for="comentario" class="form-label">comentario:</label>
            <input type="text" id="comentario" name="comentario" class="form-control" required=""
                value="{{ $avaliacao->comentario }}">
        </div>

        <div class="mb-3">
            <label for="cumprimento_contrato" class="form-label">cumprimento_contrato:</label>
            <input type="hidden" id="cumprimento_contrato" name="cumprimento_contrato" value="0">
            <input type="checkbox" id="cumprimento_contrato" name="cumprimento_contrato" value="1" {{ $avaliacao->cumprimento_contrato == "1" ? 'checked' : '' }}>
        </div>

        <div class="mb-3">
            <label for="locacao_id" class="form-label">locacao_id</label>
            <select name="locacao_id" id="locacao_id" class="form-select" required>
                @foreach($locacoes as $l)
                    <option value="{{ $l->id }}" {{ $avaliacao->locacao_id == $l->id ? 'selected' : '' }}>
                        {{ $l->id }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="locatariodalocacao_id" class="form-label">locatariodalocacao_id</label>
            <select name="locatariodalocacao_id" id="locatariodalocacao_id" class="form-select" required>
                @foreach($locatariosdaslocacoes as $l)
                    <option value="{{ $l->id }}" {{ $avaliacao->locatariodalocacao_id == $l->id ? 'selected' : '' }}>
                        {{ $l->id }}
                    </option>
                @endforeach
            </select>
        </div>


        <button type="submit" onclick="document.getElementById('methodField').value='PATCH'">
            Salvar Mudancas
        </button>

        <button type="submit" formaction="{{ route('adm.avaliar.destroy', $avaliacao->id) }}"
            onclick="document.getElementById('methodField').value='DELETE'">
            Deletar
        </button>


    </form>

@endsection