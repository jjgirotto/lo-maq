@extends($layout)

@section('conteudo')

<h1>Alterar categoria</h1>

<form method="post"
      action="/categorias/{{ $categoria->id }}">

    @CSRF
    @METHOD('PUT')

    <div class="mb-3">

        <label for="titulo" class="form-label">
            Título:
        </label>

        <input value="{{ $categoria->titulo }}"
               type="text"
               id="titulo"
               name="titulo"
               class="form-control"
               required="">
    </div>

    <button type="submit" class="btn btn-primary">
        Salvar Alterações
    </button>

    <a href="{{ url()->previous() }}"
       class="btn btn-secondary">
        Voltar
    </a>

</form>

@endsection