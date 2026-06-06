@extends($layout)

@section('title', 'Minha área - Lomaq')
@section('full_width')@endsection

@push('head')
<style>
    .panel-hero {
        background-image: linear-gradient(rgba(35, 70, 32, 0.55), rgba(35, 70, 32, 0.45)),
            url('{{ asset('images/background.webp') }}');
    }
</style>
@endpush

@section('conteudo')
<div class="home-full-bleed panel-page">
    <section class="panel-hero">
        <div class="container py-4 py-lg-5">
            <div class="panel-hero__content">
                <p class="panel-hero__eyebrow mb-2">
                    <i class="bi bi-person-circle me-1"></i> Área do cliente
                </p>
                <h1 class="panel-hero__title">Olá, {{ auth()->user()->name }}</h1>
                <p class="panel-hero__lead">
                    Busque e anuncie equipamentos para alugar de forma prática e rápida.
                </p>
            </div>
        </div>
    </section>

    <div class="container panel-grid-wrap px-3 px-md-0">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <a href="{{ route('anuncios.index') }}" class="panel-action-card">
                    <div class="panel-action-card__icon"><i class="bi bi-search"></i></div>
                    <h2 class="panel-action-card__title">Buscar</h2>
                    <p class="panel-action-card__text">Busque equipamentos disponíveis.</p>
                    <span class="panel-action-card__cta">Abrir <i class="bi bi-chevron-right"></i></span>
                </a>
            </div>

            <div class="col-lg-3 col-md-6">
                <a href="{{ route('anunciar') }}" class="panel-action-card">
                    <div class="panel-action-card__icon"><i class="bi bi-megaphone"></i></div>
                    <h2 class="panel-action-card__title">Anunciar</h2>
                    <p class="panel-action-card__text">Anuncie seus equipamentos.</p>
                    <span class="panel-action-card__cta">Abrir <i class="bi bi-chevron-right"></i></span>
                </a>
            </div>

            <div class="col-lg-3 col-md-6">
                <a href="{{ route('locacoes.index') }}" class="panel-action-card">
                    <div class="panel-action-card__icon"><i class="bi bi-calendar-check"></i></div>
                    <h2 class="panel-action-card__title">Minhas locações</h2>
                    <p class="panel-action-card__text">Consulte suas locações.</p>
                    <span class="panel-action-card__cta">Abrir <i class="bi bi-chevron-right"></i></span>
                </a>
            </div>

            <div class="col-lg-3 col-md-6">
                <a href="{{ route('anuncios.meus') }}" class="panel-action-card">
                    <div class="panel-action-card__icon"><i class="bi bi-collection"></i></div>
                    <h2 class="panel-action-card__title">Meus anúncios</h2>
                    <p class="panel-action-card__text">Visualize e edite seus anúncios.</p>
                    <span class="panel-action-card__cta">Abrir <i class="bi bi-chevron-right"></i></span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
