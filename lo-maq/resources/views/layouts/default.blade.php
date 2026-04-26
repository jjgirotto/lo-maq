<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lomaq- default</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS customizado -->
    <link rel="stylesheet" href="{{ asset('estilo.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="/">Lomaq</a>
            
            <div id="menu" class="d-flex align-items-center justify-content-between" >
                
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    {{--
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('anuncios.index') }}">Buscar</a>
                    </li>
                    --}}
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Entrar</a>
                    </li>
                    @endguest
                    
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="/anuncios/create">Anunciar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/equipamentos">Equipamentos</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="/locacoes">Minhas Locações</a>
                    </li> -->
                    {{--
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('anuncios.meus') }}">Meus Anúncios</a>
                    </li>
                    --}}
                    <!--<li class="nav-item">-->
                        <!--<a class="nav-link" href="#">Histórico</a>-->
                    <!--</li>-->
                    <li class="nav-item">
                        <a class="nav-link" href="/minhaConta">Minha Conta</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="nav-link border-0 bg-transparent">Sair</button>
                        </form>
                    </li>
                    @endauth
                </ul>
                @auth
                    <p class="m-3">Olá, {{ auth()->user()->name ?? 'usuário' }}</p>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Conteúdo principal -->
    <div class="container py-4">
        @yield("conteudo")
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>

    <!-- JS customizado -->
    <script src="{{ asset('interacoes.js') }}"></script>
</body>

</html>