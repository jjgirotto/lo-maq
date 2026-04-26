@extends($layout)

@section('title', 'Lomaq - Homepage')

@section('conteudo')
<div class="container py-4">
    <h1 class="mb-4 text-center">Equipamentos Disponíveis - PUBLIC</h1>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse($anuncios as $anuncio)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    {{-- Imagem do equipamento --}}
                    <img src="{{ asset('storage/' . $anuncio->equipamento->image_path) }}" 
                         class="card-img-top" 
                         alt="Foto de {{ $anuncio->equipamento->nome }}"
                         style="height: 200px; object-fit: cover;">
                    
                    <div class="card-body">
                        {{-- Título do anúncio --}}
                        <h5 class="card-title">{{ $anuncio->nome }}</h5>
                        
                        {{-- Detalhes do equipamento --}}
                        <p class="card-text">
                            <small class="text-muted">
                                {{ $anuncio->equipamento->marca }} {{ $anuncio->equipamento->modelo }}
                            </small>
                        </p>

                        {{-- Valor da diária --}}
                        <h6 class="card-subtitle mb-2">
                            <span class="text-muted">Diária:</span>
                            <strong class="text-success">
                                R$ {{ number_format($anuncio->valor_diaria, 2, ',', '.') }}
                            </strong>
                        </h6>

                        {{-- Anunciante --}}
                        <p class="card-text">
                            <small class="text-muted">
                                Anunciado por: {{ $anuncio->user->name }}
                            </small>
                        </p>

                        {{-- Botão para mais detalhes --}}
                        <a href="{{ route('anuncios.show', $anuncio->id) }}" class="btn btn-primary w-100">Ver Desssstalhes</a>
                        {{if($user->access == 'ADM') echo "<!--"}}<a href="{{ route('locacoes.create', $anuncio->equipamento_id) }}" class="btn btn-primary w-100">zzLocar</a>{{if($user->access == 'ADM') echo "-->"}}
                    </div>

                    {{-- Região --}}
                    <div class="card-footer">
                        <small class="text-muted">
                            Região: {{ $anuncio->regiao }}
                        </small>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <p class="mb-0">Nenhum anúncio disponível no momento.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection