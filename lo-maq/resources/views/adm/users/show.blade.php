@extends($layout)

@section('conteudo')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Consulta de Usuário</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('adm.user.list') }}" class="btn btn-secondary">Voltar</a>
            <a href="{{ route('adm.user.ViewEdit', $user->id) }}" class="btn btn-warning">Editar</a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Telefone</label>
                    <input type="text" class="form-control" value="{{ $user->telefone ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tipo de Acesso</label>
                    <input type="text" class="form-control" value="{{ $user->access === 'ADM' ? 'Administrador' : 'Cliente' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Endereço</label>
                    <input type="text" class="form-control" value="{{ $user->endereco ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">CPF</label>
                    <input type="text" class="form-control" value="{{ $user->cpf ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">CNPJ</label>
                    <input type="text" class="form-control" value="{{ $user->cnpj ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Criado em</label>
                    <input type="text" class="form-control" value="{{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : 'N/A' }}" readonly>
                </div>
            </div>
        </div>
    </div>

@endsection
