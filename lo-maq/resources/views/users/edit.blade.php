@extends($layout)

@section('conteudo')

    <h1>Atualizar Usuario</h1>
    <form method="post" action="/minhaConta">
        @CSRF
        @METHOD('PATCH')

        <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input value="{{$user->name}}" type="text" id="name" name="name" class="form-control" required="">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input value="{{$user->email}}" type="email" id="email" name="email" class="form-control" required="">
        </div>
        <div class="mb-3">
            <label for="passwordOld" class="form-label">Senha velha:</label>
            <input value="" type="password" id="passwordOld" name="passwordOld" class="form-control" required="">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Senha nova:</label>
            <input value="" type="password" id="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">telefone:</label>
            <input value="{{$user->telefone}}" type="text" id="telefone" name="telefone" class="form-control">
        </div>
        <div class="mb-3">
            <label for="endereco" class="form-label">endereco:</label>
            <input value="{{$user->endereco}}" type="text" id="endereco" name="endereco" class="form-control">
        </div>
        <div class="mb-3">
            <label for="cpf" class="form-label">cpf:</label>
            <input value="{{$user->cpf}}" type="text" id="cpf" name="cpf" class="form-control">
        </div>
        <div class="mb-3">
            <label for="cnpj" class="form-label">cnpj:</label>
            <input value="{{$user->cnpj}}" type="text" id="cnpj" name="cnpj" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
    </form>

@endsection