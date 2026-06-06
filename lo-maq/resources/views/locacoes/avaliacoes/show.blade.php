@extends($layout)

@section('conteudo')
    <section class="container card">
        <h1>Editar Avaliacao: {{ $equipamento->nome }}</h1>

        <form method="POST" action="{{ route('locacoes.avaliar.update', $avaliacao->id) }}">
            @CSRF
            <input type="hidden" name="_method" id="methodField" value="PATCH">

            <input type="hidden" name="id" id="id" value="{{$avaliacao->id}}">


            <div class="mb-3">
                <p><strong>Valor por dia:</strong> R$ {{ number_format($equipamento->preco_periodo, 2, ',', '.') }}</p>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="nota" class="form-label">Avaliação (1 à 5):</label>
                    <select id="nota" class="form-control" name="nota" id="nota">
                        <option value="1" {{ $avaliacao->nota == "1" ? 'selected' : '' }}>1</option>
                        <option value="2" {{ $avaliacao->nota == "2" ? 'selected' : '' }}>2</option>
                        <option value="3" {{ $avaliacao->nota == "3" ? 'selected' : '' }}>3</option>
                        <option value="4" {{ $avaliacao->nota == "4" ? 'selected' : '' }}>4</option>
                        <option value="5" {{ $avaliacao->nota == "5" ? 'selected' : '' }}>5</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="estado_equipamento" class="form-label">Estado do equipamento (1 à 5):</label>  
                    
                    <select class="form-control" name="estado_equipamento" id="estado_equipamento">
                        <option value="1" {{ $avaliacao->estado_equipamento == 1 ? 'selected' : '' }}>1</option>
                        <option value="2" {{ $avaliacao->estado_equipamento == 2 ? 'selected' : '' }}>2</option>
                        <option value="3" {{ $avaliacao->estado_equipamento == 3 ? 'selected' : '' }}>3</option>
                        <option value="4" {{ $avaliacao->estado_equipamento == 4 ? 'selected' : '' }}>4</option>
                        <option value="5" {{ $avaliacao->estado_equipamento == 5 ? 'selected' : '' }}>5</option>
                    </select>
                </div>
            </div>

            <div class="mb-3 form-group">
                <label for="comentario" class="form-label">Deixe um comentário:</label>
                <textarea id="comentario" name="comentario" class="form-control" required="">{{ $avaliacao->comentario }}</textarea>
            </div>

            <div class="mb-3 form-group">
                <label for="cumprimento_contrato" class="form-label">
                    O contrato foi cumprido corretamente?
                </label>

                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="cumprimento_contrato"
                        value="0"
                        {{ $avaliacao->cumprimento_contrato == 0 ? 'checked' : '' }}
                    >
                    <label class="form-check-label" for="cumprimento_contrato_nao">
                        Não
                    </label>
                </div>

                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="cumprimento_contrato"
                        value="1"
                        {{ $avaliacao->cumprimento_contrato == 1 ? 'checked' : '' }}
                    >
                    <label class="form-check-label" for="cumprimento_contrato_sim">
                        Sim
                    </label>
                </div>
            </div>


            <button type="submit" class="btn btn-primary" onclick="document.getElementById('methodField').value='PATCH'">
                Salvar Mudancas
            </button>

            <button type="submit" class="btn btn-primary" formaction="{{ route('locacoes.avaliar.destroy', $avaliacao->id) }}"
                onclick="document.getElementById('methodField').value='DELETE'">
                Deletar
            </button>


        </form>
    </section>

@endsection