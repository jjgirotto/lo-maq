<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lomaq - Admin</title>

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
            
            <div id="menu" class="d-flex align-items-center justify-content-between">
                
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin') }}">Painel Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('adm.user.list') }}">Usuários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('adm.user.create') }}">Criar Usuário</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/equipamentos">Equipamentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/minhaConta">Minha Conta</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="nav-link border-0 bg-transparent">Sair</button>
                        </form>
                    </li>
                </ul>
                @auth
                    <p class="m-3"><strong>Admin:</strong> {{ auth()->user()->name ?? 'usuário' }}</p>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Conteúdo principal -->
    <div class="container py-4">
        @if (session('sucesso'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('sucesso') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('erro'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('erro') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

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
