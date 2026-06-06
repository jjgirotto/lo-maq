<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Lomaq - Admin')</title>

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

<body class="site-body @yield('body_class')">
    @if (! View::hasSection('hide_site_bg'))
        <div class="site-bg" aria-hidden="true"></div>
    @endif

    <nav class="navbar navbar-expand-lg navbar-dark navbar-lomaq shadow-sm">
        <div class="container-fluid px-3 px-lg-4">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('admin') }}">
                <i class="bi bi-truck"></i> Lomaq
                <span class="badge bg-white text-success fw-semibold d-none d-sm-inline">Admin</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin"
                aria-controls="navbarAdmin" aria-expanded="false" aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarAdmin">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('admin')) active @endif"
                            href="{{ route('admin') }}">
                            <i class="bi bi-speedometer2 me-1"></i> Painel
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('adm.user.*')) active @endif"
                            href="{{ route('adm.user.list') }}">
                            <i class="bi bi-people me-1"></i> Usuários
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('equipamentos*')) active @endif"
                            href="{{ url('/equipamentos') }}">
                            <i class="bi bi-tools me-1"></i> Equipamentos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('adm.locacao.*')) active @endif"
                            href="{{ route('adm.locacao.list') }}">
                            <i class="bi bi-calendar-check me-1"></i> Locações
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('categorias*')) active @endif"
                            href="{{ url('/categorias') }}">
                            <i class="bi bi-tags me-1"></i> Categorias
                        </a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-3">
                    @auth
                        <ul class="navbar-nav flex-row gap-1">
                            <li class="nav-item">
                                <a class="nav-link @if(request()->is('minhaConta')) active @endif"
                                    href="{{ url('/minhaConta') }}">Minha conta</a>
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

    <main class="site-main">
        @if (View::hasSection('full_width'))
            @if (session('sucesso') || session('erro'))
                <div class="container pt-3">
                    @if (session('sucesso'))
                        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                            <i class="bi bi-check-circle"></i>
                            {{ session('sucesso') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                        </div>
                    @endif
                    @if (session('erro'))
                        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ session('erro') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                        </div>
                    @endif
                </div>
            @endif
            @yield('conteudo')
        @else
            <div class="container py-4">
                @if (session('sucesso'))
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                        <i class="bi bi-check-circle"></i>
                        {{ session('sucesso') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                    </div>
                @endif
                @if (session('erro'))
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ session('erro') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                    </div>
                @endif
                @yield('conteudo')
            </div>
        @endif
    </main>

    <footer class="site-footer site-footer--compact">
        <div class="container">
            <div class="site-footer__copy mb-0 border-0 pt-0 mt-0">
                &copy; {{ date('Y') }} Lomaq. Painel administrativo.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
    <script src="{{ asset('interacoes.js') }}"></script>
    @stack('scripts')
</body>

</html>
