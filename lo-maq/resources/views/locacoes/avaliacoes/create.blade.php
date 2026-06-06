@extends($layout)

@section('conteudo')

    <section class="container card">
        <h1>Avaliar {{ $equipamento->nome }}</h1>
        
        <form method="post" action="{{ route('locacoes.avaliar.store') }}">
            @CSRF
            <input type="hidden" id="id" name="id" value="{{$locacao->id}}" />
            <div class="mb-3">
                <p><strong>Valor por dia:</strong> R$ {{ number_format($equipamento->preco_periodo, 2, ',', '.') }}</p>
            </div>

            <div class="mb-3">
                <label for="nota" class="form-label">nota:</label>

                <input type="radio" id="star1" name="nota" value="1" />
                <label for="star1">1&#9733;</label>
                <input type="radio" id="star2" name="nota" value="2" />
                <label for="star2">&#9733;</label>
                <input type="radio" id="star3" name="nota" value="3" />
                <label for="star3">&#9733;</label>
                <input type="radio" id="star4" name="nota" value="4" />
                <label for="star4">&#9733;</label>
                <input type="radio" id="star5" name="nota" value="5" />
                <label for="star5">5&#9733;</label>
            </div>

            <div class="mb-3">
                <label for="estado_equipamento" class="form-label">estado_equipamento:</label>

                <input type="radio" id="estado1" name="estado_equipamento" value="1" />
                <label for="estado1">1&#9733;</label>
                <input type="radio" id="estado2" name="estado_equipamento" value="2" />
                <label for="estado2">&#9733;</label>
                <input type="radio" id="estado3" name="estado_equipamento" value="3" />
                <label for="estado3">&#9733;</label>
                <input type="radio" id="estado4" name="estado_equipamento" value="4" />
                <label for="estado4">&#9733;</label>
                <input type="radio" id="estado5" name="estado_equipamento" value="5" />
                <label for="estado5">5&#9733;</label>
            </div>

            <div class="mb-3">
                <label for="comentario" class="form-label">comentario:</label>
                <input type="text" id="comentario" name="comentario" class="form-control" required="">
            </div>

            <div class="mb-3">
                <label for="cumprimento_contrato" class="form-label">cumprimento_contrato:</label>
                <input type="hidden" id="cumprimento_contrato" name="cumprimento_contrato" value="0">
                <input type="checkbox" id="cumprimento_contrato" name="cumprimento_contrato" value="1">
            </div>

            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </section>

@endsection