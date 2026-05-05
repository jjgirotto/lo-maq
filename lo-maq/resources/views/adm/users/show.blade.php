@extends($layout)

@section('conteudo')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Listagem de Usuários</h1>
        <a href="{{ route('adm.user.create') }}" class="btn btn-primary">Criar Novo Usuário</a>
    </div>

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

    @if ($users->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Tipo de Acesso</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->telefone ?? 'N/A' }}</td>
                            <td>
                                @if ($user->access === 'ADM')
                                    <span class="badge bg-danger">Administrador</span>
                                @else
                                    <span class="badge bg-info">Cliente</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('adm.user.ViewEdit', $user->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                                    <i class="bi bi-trash"></i> Deletar
                                </button>
                            </td>
                        </tr>

                        <!-- Modal de Confirmação de Deleção -->
                        <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Confirmar Deleção</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        Tem certeza que deseja deletar o usuário <strong>{{ $user->name }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <form method="POST" action="{{ route('adm.user.delete', $user->id) }}" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Deletar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info" role="alert">
            Nenhum usuário cadastrado. <a href="{{ route('adm.user.create') }}">Criar novo usuário</a>
        </div>
    @endif

@endsection
