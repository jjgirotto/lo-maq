@extends($layout)

@section('title', 'Criar conta - Lomaq')
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
                <h1 class="auth-hero__title">Criar conta na Lomaq</h1>
                <p class="auth-hero__lead">
                    Cadastre-se para anunciar equipamentos e gerenciar suas locações.
                </p>
            </div>
        </div>
    </section>

    <div class="container auth-form-wrap px-3 px-md-0">
        <div class="auth-card auth-card--wide">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-exclamation-circle"></i>
                        <strong>Verifique os dados abaixo:</strong>
                    </div>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.post') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold small text-muted mb-1">Nome completo</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ old('name') }}" placeholder="Seu nome" required autofocus>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold small text-muted mb-1">E-mail</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" id="email" name="email" class="form-control"
                            value="{{ old('email') }}" placeholder="seu@email.com" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold small text-muted mb-1">Senha (mín. 3 caracteres)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Crie uma senha" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-semibold small text-muted mb-1">Confirmar senha</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-control" placeholder="Repita a senha" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-lomaq-primary w-100 mb-3">
                    <i class="bi bi-person-plus me-1"></i> Criar conta
                </button>

                <p class="auth-card__footer text-center mb-0">
                    Já tem conta?
                    <a href="{{ route('login') }}">Entrar</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
