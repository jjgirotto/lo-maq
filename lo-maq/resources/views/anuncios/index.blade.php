@extends($layout)

@section('title', 'AgroFrota - Equipamentos Disponíveis')

@section('conteudo')
<div class="container py-4">
    <h1 class="mb-4 text-center">Equipamentos Disponíveis</h1>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Buscar Equipamentos</h4>
                    </div>

                    <div class="card-body">
                        <!-- Formulário de Busca -->
                        <form action="{{ route('anuncios.index') }}" method="GET" class="mb-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="termo" class="form-label">Nome/região</label>
                                        <input type="text" class="form-control" id="termo" name="termo"
                                            placeholder="Digite o que procura..." value="{{ request('termo') }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="categoria" class="form-label">Categoria</label>
                                        <select class="form-select" id="categoria" name="categoria">
                                            <option value="">Todas as Categorias</option>
                                            @foreach($categorias as $categoria)
                                                <option value="{{ $categoria->id }}"
                                                    {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                                                    {{ $categoria->titulo }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="bi bi-search"></i> Buscar
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="row row-cols-1 row-cols-md-3 g-3">
                            @forelse($anuncios as $anuncio)
                                <div class="col">
                                    <div class="card h-100 shadow-sm">
                                        <img src="{{ asset('storage/' . $anuncio->equipamento->image_path) }}"
                                            class="card-img-top"
                                            alt="Foto de {{ $anuncio->equipamento->nome }}"
                                            style="height: 150px; object-fit: cover;"
                                        >

                                        <div class="card-body p-2 ">
                                            <div class="">
                                                <h5 class="card-title mb-1" title="{{ $anuncio->nome }}" title="{{ $anuncio->nome }}" style="font-size: 1rem; line-height: 1.1;">
                                                    {{ Str::limit($anuncio->nome, 25) }}</h5>
                                            
                                                <p class="card-text mb-1" style="font-size: 0.85rem; max-height: 1.8em; overflow: hidden;">
                                                    <small class="text-muted">
                                                        {{ $anuncio->equipamento->marca }} {{ $anuncio->equipamento->modelo }}
                                                    </small>
                                                </p>
                                                <h6 class="card-subtitle mb-1" style="font-size: 0.9rem;">
                                                    <span class="text-muted">Diária:</span>
                                                    <strong class="text-success">
                                                        R$ {{ number_format($anuncio->valor_diaria, 2, ',', '.') }}
                                                    </strong>
                                                </h6>
                                                <p class="card-text mb-1" style="font-size: 0.8rem;">
                                                    <small class="text-muted">
                                                        Anunciado por: {{ $anuncio->user->name }}
                                                    </small>
                                                </p>
                                            </div>

                                            <div class="d-flex flex-column">
                                                <a href="{{ route('anuncios.show', $anuncio->id) }}" class="btn btn-primary w-100">
                                                    Ver Detalhes
                                                </a>
                                                @if(($user->access ?? null)!= 'ADM')
                                                <a href="{{ route('locacoes.create', $anuncio->equipamento_id) }}" class="btn btn-primary w-100 mt-2">Locar</a>
                                                @endif
                                            </div>
                                        </div>

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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection