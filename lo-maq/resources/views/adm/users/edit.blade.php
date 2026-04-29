@extends($layout)

@section('conteudo')

    <h1>Editar Usuário</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('adm.user.edit') }}">
        @CSRF
        @METHOD('PATCH')

        <input type="hidden" name="id" value="{{ $user->id }}">

        <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input value="{{ $user->name }}" type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" required>
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input value="{{ $user->email }}" type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" required>
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Senha (deixe em branco para manter a atual):</label>
            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="access" class="form-label">Tipo de Acesso:</label>
            <select id="access" name="access" class="form-control @error('access') is-invalid @enderror" required>
                <option value="CLI" {{ $user->access == 'CLI' ? 'selected' : '' }}>Cliente</option>
                <option value="ADM" {{ $user->access == 'ADM' ? 'selected' : '' }}>Administrador</option>
            </select>
            @error('access')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone:</label>
            <input value="{{ $user->telefone }}" type="text" id="telefone" name="telefone" class="form-control">
        </div>

        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço:</label>
            <input value="{{ $user->endereco }}" type="text" id="endereco" name="endereco" class="form-control">
        </div>

        <div class="mb-3">
            <label for="cpf" class="form-label">CPF:</label>
            <input value="{{ $user->cpf }}" type="text" id="cpf" name="cpf" class="form-control">
        </div>

        <div class="mb-3">
            <label for="cnpj" class="form-label">CNPJ:</label>
            <input value="{{ $user->cnpj }}" type="text" id="cnpj" name="cnpj" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Atualizar Usuário</button>
        <a href="{{ route('admin') }}" class="btn btn-secondary">Cancelar</a>
    </form>

@endsection
