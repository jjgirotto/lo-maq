<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Lomaq')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('estilo.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <style>
        .site-bg {
            position: fixed;
            inset: 0;
            background-image: url('{{ asset('images/background.webp') }}');
            background-size: cover;
            background-position: center;
            opacity: 0.18;
            filter: saturate(0.9) brightness(0.95);
            pointer-events: none;
            z-index: -1;
        }
        @media (prefers-reduced-motion: reduce) {
            .site-bg { transition: none; }
        }
    </style>
    @stack('head')
</head>

<body class="@yield('body_class')">
    @if (! View::hasSection('hide_site_bg'))
        <div class="site-bg" aria-hidden="true"></div>
    @endif

    <nav class="navbar navbar-expand-lg navbar-dark navbar-lomaq shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('home-cli-public') }}">
                <i class="bi bi-truck"></i> Lomaq
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
                aria-controls="navbarMain" aria-expanded="false" aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('home-cli-public')) active @endif"
                            href="{{ route('home-cli-public') }}">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('anuncios.index')) active @endif"
                            href="{{ route('anuncios.index') }}">Equipamentos</a>
                    </li>
                    @if(request()->routeIs('home-cli-public'))
                        <li class="nav-item">
                            <a class="nav-link" href="#como-funciona">Como funciona</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#vantagens">Vantagens</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contato">Contato</a>
                        </li>
                    @endif
                </ul>

                <div class="d-flex align-items-center gap-3">
                    @guest
                        <a href="{{ route('login') }}" class="btn-nav-login">Entrar</a>
                    @endguest

                    @auth
                        <span class="text-white-50 small d-none d-lg-inline">Olá, {{ auth()->user()->name }}</span>
                        <ul class="navbar-nav flex-row gap-1">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('anuncios.create') }}">Anunciar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/minhaConta">Minha conta</a>
                            </li>
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="nav-link border-0 bg-transparent">Sair</button>
                                </form>
                            </li>
                        </ul>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    @if (View::hasSection('full_width'))
        @yield('conteudo')
    @else
        <div class="container py-4">
            @yield('conteudo')
        </div>
    @endif

    @if (View::hasSection('site_footer'))
        @yield('site_footer')
    @else
        <footer class="site-footer">
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
                            @auth
                                <li><a href="{{ route('anuncios.create') }}">Anunciar</a></li>
                            @endauth
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
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
    <script src="{{ asset('interacoes.js') }}"></script>
    @stack('scripts')
</body>

</html>
