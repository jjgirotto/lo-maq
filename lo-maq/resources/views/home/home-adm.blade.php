@extends($layout)

@section('title', 'Painel Admin - Lomaq')
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
                    <i class="bi bi-shield-lock me-1"></i> Área administrativa
                </p>
                <h1 class="panel-hero__title">Bem-vindo, {{ auth()->user()->name }}</h1>
                <p class="panel-hero__lead">
                    Gerencie categorias, equipamentos, locações e usuários de forma prática e rápida.
                </p>
            </div>
        </div>
    </section>

    <div class="container panel-grid-wrap px-3 px-md-0">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <a href="{{ url('/categorias') }}" class="panel-action-card">
                    <div class="panel-action-card__icon"><i class="bi bi-tags"></i></div>
                    <h2 class="panel-action-card__title">Categorias</h2>
                    <p class="panel-action-card__text">Gerencie todas as categorias disponíveis.</p>
                    <span class="panel-action-card__cta">Abrir <i class="bi bi-chevron-right"></i></span>
                </a>
            </div>

            <div class="col-lg-3 col-md-6">
                <a href="{{ url('/equipamentos') }}" class="panel-action-card">
                    <div class="panel-action-card__icon"><i class="bi bi-tools"></i></div>
                    <h2 class="panel-action-card__title">Equipamentos</h2>
                    <p class="panel-action-card__text">Visualize, adicione ou edite equipamentos.</p>
                    <span class="panel-action-card__cta">Abrir <i class="bi bi-chevron-right"></i></span>
                </a>
            </div>

            <div class="col-lg-3 col-md-6">
                <a href="{{ route('adm.locacao.list') }}" class="panel-action-card">
                    <div class="panel-action-card__icon"><i class="bi bi-calendar-check"></i></div>
                    <h2 class="panel-action-card__title">Locações</h2>
                    <p class="panel-action-card__text">Gerencie informações das locações.</p>
                    <span class="panel-action-card__cta">Abrir <i class="bi bi-chevron-right"></i></span>
                </a>
            </div>

            <div class="col-lg-3 col-md-6">
                <a href="{{ route('adm.user.list') }}" class="panel-action-card">
                    <div class="panel-action-card__icon"><i class="bi bi-people"></i></div>
                    <h2 class="panel-action-card__title">Usuários</h2>
                    <p class="panel-action-card__text">Gerencie informações dos usuários.</p>
                    <span class="panel-action-card__cta">Abrir <i class="bi bi-chevron-right"></i></span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
