@extends($layout)

@section('conteudo')

    <h2>Users</h2>
    @if(session('sucesso'))
        <p class="text-success">{{ session('sucesso') }}</p>
    @endif
    @if(session('erro'))
        <p class="text-danger">{{ session('erro') }}</p>
    @endif
    <a href="{{ route('adm.user.create') }}" class="btn btn-success mb-3">Novo User</a>
    <div class="table-responsive rounded-3">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>access</th>
                    <th>id</th>
                    <th>name</th>
                    <th>email</th>
                    <th>telefone</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                        <tr class="align-middle">
                            <td>{{ $u->access }}</td>
                            <td>{{ $u->id }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->telefone }}</td>

                            <td class="text-end">
                                <div class="d-flex flex-wrap justify-content-end gap-2">
                                    <a href="{{ route('adm.user.ViewEdit', $u->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <a href="{{ route('adm.user.show', $u->id) }}" class="btn btn-sm btn-info">Consultar</a>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $u->id }}">
                                        <i class="bi bi-trash"></i> Deletar
                                    </button>
                                </div>
                            </td>
                        </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @foreach($users as $u)
        <div class="modal fade" id="deleteModal{{ $u->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmar Deleção</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja deletar o usuário <strong>{{ $u->name }}</strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form method="POST" action="{{ route('adm.user.delete', $u->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Deletar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection