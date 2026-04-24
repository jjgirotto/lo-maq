@extends($layout)

@section('conteudo')

    <h1>Novo equipamento</h1>
    <form method="post" action="/equipamentos" enctype="multipart/form-data">
        @CSRF

        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control" required="">
        </div>
        <div class="mb-3">
            <label for="marca" class="form-label">Marca:</label>
            <input type="text" id="marca" name="marca" class="form-control" required="">
        </div>
        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo:</label>
            <input type="text" id="modelo" name="modelo" class="form-control" required="">
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto do Equipamento:</label>
            <input type="file" id="foto" name="foto" class="form-control" accept="image/*">
        </div>
        <div class="mb-3">
            <label for="ano" class="form-label">Ano:</label>
            <input type="number" id="ano" name="ano" class="form-control" required="">
        </div>
        <div class="mb-3">
            <label for="capacidade" class="form-label">Capacidade:</label>
            <input type="text" id="capacidade" name="capacidade" class="form-control" required="">
        </div>
        <div class="mb-3">
            <label for="preco_periodo" class="form-label">Preco do Periodo:</label>
            <input type="number" id="preco_periodo" name="preco_periodo" class="form-control" required="">
        </div>
        <input type="hidden" id="disponibilidade_calendario" name="disponibilidade_calendario" value="-" required="">

        <div class="mb-3">
            <label for="regiao" class="form-label">Região:</label>
            <input type="text" id="regiao" name="regiao" class="form-control" required="">
        </div>

        <div class="mb-3">
            <input type="hidden" id="hidden_certificado" name="exige_operador_certificado" value="0">
            <input type="checkbox" id="exige_operador_certificado" name="exige_operador_certificado" value="1">
            <label for="exige_operador_certificado" class="form-label">Operador Certificado</label>
        </div>
        <div class="mb-3">
            <input type="hidden" id="hidden_seguro" name="seguro_obrigatorio" value="0">
            <input type="checkbox" id="seguro_obrigatorio" name="seguro_obrigatorio" value="1">
            <label for="seguro_obrigatorio" class="form-label">Seguro Obrigatório</label>
        </div>
        <div class="mb-3">
            <input type="hidden" id="hidden_caucao" name="caucao_obrigatoria" value="0">
            <input type="checkbox" id="caucao_obrigatoria" name="caucao_obrigatoria" value="1">
            <label for="caucao_obrigatoria" class="form-label">Caução Obrigatória</label>
        </div>

        @foreach($locador as $l)
            <input type="hidden" id="locador_id" name="locador_id" value="{{ $l->id }}">
        @endforeach

        <div class="mb-3">
            <label for="categoria_id" class="form-label">Selecione a Categoria:</label>
            <select class="form-select" name="categoria_id" id="categoria_id">
                @foreach($categorias as $c)
                    <option value="{{$c->id}}">{{ $c->titulo }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
    </form>

@endsection