@extends($layout)

@section('conteudo')

    <h2>Users</h2>
    @if(session('sucesso'))
        <p class="text-success">{{ session('sucesso') }}</p>
    @endif
    @if(session('erro'))
        <p class="text-danger">{{ session('erro') }}</p>
    @endif
    <a href="/adm/users/create" class="btn btn-success mb-3">Novo User</a>
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
                    <div>
                        <tr class="align-middle">
                            <td>{{ $u->access }}</td>
                            <td>{{ $u->id }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->telefone }}</td>

                            <td class="text-end">
                                <div class="d-flex flex-wrap justify-content-end gap-2">
                                    <a href="/adm/users/{{ $u->id }}/edit" class="btn btn-sm btn-warning">Editar</a>
                                    <a href="/adm/users/{{ $u->id }}" class="btn btn-sm btn-info">Consultar</a>
                                </div>
                            </td>
                        </tr>
                    </div>
                @endforeach
            </tbody>
        </table>

@endsection