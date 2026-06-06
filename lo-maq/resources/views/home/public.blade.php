@extends($layout)

@section('title', 'Lomaq - Locação de equipamentos')
@section('hide_site_bg')@endsection
@section('full_width')@endsection

@push('head')
<style>
    .home-hero {
        background-image: linear-gradient(rgba(35, 70, 32, 0.55), rgba(35, 70, 32, 0.45)),
            url('{{ asset('images/background.webp') }}');
    }
</style>
@endpush

@section('conteudo')
<div class="home-full-bleed">
    <section class="home-hero">
        <div class="container py-5">
            <div class="home-hero__content">
                <h1 class="home-hero__title">
                    Locação de equipamentos de forma simples, rápida e segura.
                </h1>
                <p class="home-hero__lead">
                    Encontre os melhores equipamentos para o seu trabalho com praticidade e economia.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ auth()->check() ? route('anuncios.index') : route('login') }}" class="btn btn-lomaq-primary btn-lg">
                        <i class="bi bi-search me-1"></i> Ver equipamentos
                    </a>
                    <a href="#como-funciona" class="btn btn-lomaq-outline btn-lg">
                        <i class="bi bi-play-circle me-1"></i> Como funciona
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="home-stats py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="home-stat">
                        <div class="home-stat__value">{{ $equipamentosCount ?? 0 }}</div>
                        <div class="home-stat__label">Equipamentos cadastrados</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="home-stat">
                        <div class="home-stat__value">{{ $anunciosCount ?? 0 }}</div>
                        <div class="home-stat__label">Anúncios disponíveis</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="home-stat">
                        <div class="home-stat__value"><i class="bi bi-shield-check"></i></div>
                        <div class="home-stat__label">Gestão simples de locações</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="home-section" id="vantagens">
        <div class="container">
            <h2 class="home-section__title">Por que alugar com a Lomaq?</h2>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="home-benefit">
                        <div class="home-benefit__icon"><i class="bi bi-shield-check"></i></div>
                        <h3 class="home-benefit__title">Segurança</h3>
                        <p class="home-benefit__text">
                            Equipamentos cadastrados e processo de locação organizado para maior confiança.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="home-benefit">
                        <div class="home-benefit__icon"><i class="bi bi-cash-coin"></i></div>
                        <h3 class="home-benefit__title">Economia</h3>
                        <p class="home-benefit__text">
                            Alugue apenas quando precisar, sem o custo de compra e manutenção permanente.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="home-benefit">
                        <div class="home-benefit__icon"><i class="bi bi-clock"></i></div>
                        <h3 class="home-benefit__title">Praticidade</h3>
                        <p class="home-benefit__text">
                            Busque equipamentos por categoria e região de forma rápida e direta.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="home-benefit">
                        <div class="home-benefit__icon"><i class="bi bi-headset"></i></div>
                        <h3 class="home-benefit__title">Suporte</h3>
                        <p class="home-benefit__text">
                            Acompanhamento para locadores e locatários durante todo o processo.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="home-section bg-white" id="como-funciona">
        <div class="container">
            <h2 class="home-section__title">Como funciona?</h2>
            <div class="home-steps">
                <div class="home-step">
                    <span class="home-step__number">1</span>
                    <i class="bi bi-search home-step__icon"></i>
                    <h3 class="home-step__title">Escolha o equipamento</h3>
                    <p class="home-step__text">Navegue pelos anúncios e encontre a máquina ideal para sua operação.</p>
                </div>
                <div class="home-step">
                    <span class="home-step__number">2</span>
                    <i class="bi bi-calendar3 home-step__icon"></i>
                    <h3 class="home-step__title">Selecione o período</h3>
                    <p class="home-step__text">Defina as datas de locação conforme a sua necessidade.</p>
                </div>
                <div class="home-step">
                    <span class="home-step__number">3</span>
                    <i class="bi bi-file-earmark-text home-step__icon"></i>
                    <h3 class="home-step__title">Faça a reserva</h3>
                    <p class="home-step__text">Formalize a locação pelo sistema de forma simples e transparente.</p>
                </div>
                <div class="home-step">
                    <span class="home-step__number">4</span>
                    <i class="bi bi-truck home-step__icon"></i>
                    <h3 class="home-step__title">Retire e utilize</h3>
                    <p class="home-step__text">Coloque o equipamento em operação e foque no que importa: a produção.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="home-section pt-0">
        <div class="container">
            <div class="home-cta-banner d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <p class="home-cta-banner__text">
                    <i class="bi bi-leaf me-2"></i>
                    Pronto para aumentar sua produtividade? Alugue os melhores equipamentos e foque no que realmente importa: o seu trabalho.
                </p>
                <a href="{{ auth()->check() ? route('anuncios.index') : route('login') }}" class="btn btn-lomaq-primary btn-lg text-nowrap">
                    Ver equipamentos <i class="bi bi-chevron-right ms-1"></i>
                </a>
            </div>
        </div>
    </section>
</div>
@endsection

@section('site_footer')
<footer class="site-footer home-full-bleed">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="site-footer__brand"><i class="bi bi-truck"></i> Lomaq</div>
                <p class="text-muted small mb-0">
                    Plataforma para locação de equipamentos com praticidade, segurança e economia.
                </p>
            </div>
            <div class="col-md-2">
                <div class="site-footer__heading">Navegação</div>
                <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
                    <li><a href="{{ route('home-cli-public') }}">Início</a></li>
                    <li><a href="{{ route('anuncios.index') }}">Equipamentos</a></li>
                    <li><a href="#como-funciona">Como funciona</a></li>
                    <li><a href="#vantagens">Vantagens</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <div class="site-footer__heading">Ajuda</div>
                <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
                    <li><a href="{{ route('login') }}">Entrar</a></li>
                    @if (Route::has('register'))
                        <li><a href="{{ route('register') }}">Criar conta</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-md-3" id="contato">
                <div class="site-footer__heading">Contato</div>
                <ul class="list-unstyled d-flex flex-column gap-2 mb-0 text-muted small">
                    <li><i class="bi bi-envelope me-1"></i> contato@lomaq.com</li>
                    <li><i class="bi bi-telephone me-1"></i> (00) 0000-0000</li>
                </ul>
            </div>
        </div>
        <div class="site-footer__copy">
            &copy; {{ date('Y') }} Lomaq. Todos os direitos reservados.
        </div>
    </div>
</footer>
@endsection
