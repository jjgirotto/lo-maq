@extends($layout)

@section('conteudo')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h1 class="mb-4">Criar Conta</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.post') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nome Completo</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Senha (mín. 3 caracteres)</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Registar</button>
            <a href="{{ route('login') }}" class="btn btn-link">Voltar ao Login</a>
        </form>
    </div>
</div>
@endsection