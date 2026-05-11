@extends($layout)

@section('conteudo')

<h1>Dados da categoria</h1>

<form method="post"
      action="/categorias/{{ $categoria->id }}">

    @CSRF
    @METHOD('DELETE')

    <div class="mb-3">

        <label for="titulo" class="form-label">
            Título:
        </label>

        <input disabled
               value="{{ $categoria->titulo }}"
               type="text"
               id="titulo"
               name="titulo"
               class="form-control">

    </div>

    <p>Deseja excluir esse registro?</p>

    <button type="submit"
            class="btn btn-danger">

        Sim

    </button>

    <a href="#"
       class="btn btn-secondary"
       onClick="history.back()">

        Não

    </a>

</form>

@endsection