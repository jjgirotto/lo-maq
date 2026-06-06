@extends($layout)

@section('title', 'Entrar - Lomaq')
@section('hide_site_bg')@endsection
@section('full_width')@endsection

@push('head')
<style>
    .auth-hero {
        background-image: linear-gradient(rgba(35, 70, 32, 0.55), rgba(35, 70, 32, 0.45)),
            url('{{ asset('images/background.webp') }}');
    }
</style>
@endpush

@section('conteudo')
<div class="home-full-bleed auth-page">
    <section class="auth-hero">
        <div class="container py-4">
            <div class="auth-hero__content">
                <h1 class="auth-hero__title">Entrar na Lomaq</h1>
                <p class="auth-hero__lead">
                    Acesse sua conta para gerenciar locações e anúncios.
                </p>
            </div>
        </div>
    </section>

    <div class="container auth-form-wrap px-3 px-md-0">
        <div class="auth-card">
            @if(session('erro'))
                <div class="alert alert-danger d-flex align-items-center gap-2" role="alert">
                    <i class="bi bi-exclamation-circle"></i>
                    {{ session('erro') }}
                </div>
            @endif

            @if(session('Sucesso'))
                <div class="alert alert-success d-flex align-items-center gap-2" role="alert">
                    <i class="bi bi-check-circle"></i>
                    {{ session('Sucesso') }}
                </div>
            @endif

            <form method="post" action="">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold small text-muted mb-1">E-mail</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" id="email" name="email" class="form-control"
                            placeholder="seu@email.com" required autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold small text-muted mb-1">Senha</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Sua senha" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-lomaq-primary w-100 mb-3">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Entrar
                </button>

                <p class="auth-card__footer text-center mb-0">
                    Ainda não tem conta?
                    <a href="{{ route('register') }}">Criar conta</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
