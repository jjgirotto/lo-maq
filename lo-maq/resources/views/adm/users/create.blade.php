@extends($layout)

@section('conteudo')

    <h1>Criar Novo Usuário</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('adm.user.create') }}">
        @CSRF

        <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input value="{{ old('name') }}" type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" required>
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input value="{{ old('email') }}" type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" required>
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Senha:</label>
            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="access" class="form-label">Tipo de Acesso:</label>
            <select id="access" name="access" class="form-control @error('access') is-invalid @enderror" required>
                <option value="">Selecione um tipo</option>
                <option value="CLI" {{ old('access') == 'CLI' ? 'selected' : '' }}>Cliente</option>
                <option value="ADM" {{ old('access') == 'ADM' ? 'selected' : '' }}>Administrador</option>
            </select>
            @error('access')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone:</label>
            <input value="{{ old('telefone') }}" type="text" id="telefone" name="telefone" class="form-control">
        </div>

        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço:</label>
            <input value="{{ old('endereco') }}" type="text" id="endereco" name="endereco" class="form-control">
        </div>

        <div class="mb-3">
            <label for="cpf" class="form-label">CPF:</label>
            <input value="{{ old('cpf') }}" type="text" id="cpf" name="cpf" class="form-control">
        </div>

        <div class="mb-3">
            <label for="cnpj" class="form-label">CNPJ:</label>
            <input value="{{ old('cnpj') }}" type="text" id="cnpj" name="cnpj" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Criar Usuário</button>
        <a href="{{ route('admin') }}" class="btn btn-secondary">Cancelar</a>
    </form>

@endsection
