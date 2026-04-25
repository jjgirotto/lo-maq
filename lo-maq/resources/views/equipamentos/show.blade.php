@extends($layout)

@section('conteudo')

<h1>Dados do equipamento</h1>
<form method="post" action="/equipamentos/{{ $equipamento->id }}">
    @CSRF
    @METHOD('DELETE')
    
    <div class="mb-3">
        <label for="nome" class="form-label">Nome:</label>
        <input disabled value="{{$equipamento->nome}}" type="text" id="nome" name="nome" class="form-control" required="">
    </div>
    <div class="mb-3">
        <label for="marca" class="form-label">Marca:</label>
        <input disabled value="{{$equipamento->marca}}" type="text" id="marca" name="marca" class="form-control" required="">
    </div>
    <div class="mb-3">
        <label for="modelo" class="form-label">Modelo:</label>
        <input disabled value="{{$equipamento->modelo}}" type="text" id="modelo" name="modelo" class="form-control" required="">
    </div>
    <div class="mb-3">
        <label for="ano" class="form-label">Ano:</label>
        <input disabled value="{{$equipamento->ano}}" type="text" id="ano" name="ano" class="form-control" required="">
    </div>
    <div class="mb-3">
        <label for="capacidade" class="form-label">Capacidade:</label>
        <input disabled value="{{$equipamento->capacidade}}" type="text" id="capacidade" name="capacidade" class="form-control" required="">
    </div>
    <div class="mb-3">
        <label for="preco_periodo" class="form-label">Preco do Periodo:</label>
        <input disabled value="{{$equipamento->preco_periodo}}" type="text" id="preco_periodo" name="preco_periodo" class="form-control" required="">
    </div>

        <input disabled value="{{$equipamento->disponibilidade_calendario}}" type="hidden" id="disponibilidade_calendario" name="disponibilidade_calendario" class="form-control" required="">

    <div class="mb-3">
        <label for="regiao" class="form-label">Região:</label>
        <input disabled value="{{$equipamento->regiao}}" type="text" id="regiao" name="regiao" class="form-control" required="">
    </div>
    <div class="mb-3">
        <label for="exige_operador_certificado" class="form-label">Operador Certificado:</label>
        <input disabled value="{{$equipamento->exige_operador_certificado}}" type="text" id="exige_operador_certificado" name="exige_operador_certificado" class="form-control" required="">
    </div>
    <div class="mb-3">
        <label for="seguro_obrigatorio" class="form-label">Seguro Obrigatório:</label>
        <input disabled value="{{$equipamento->seguro_obrigatorio}}" type="text" id="seguro_obrigatorio" name="seguro_obrigatorio" class="form-control" required="">
    </div>
    <div class="mb-3">
        <label for="caucao_obrigatoria" class="form-label">Caução Obrigatória:</label>
        <input disabled value="{{$equipamento->caucao_obrigatoria}}" type="text" id="caucao_obrigatoria" name="caucao_obrigatoria" class="form-control" required="">
    </div>
    <div class="mb-3">
        <label for="locador_id" class="form-label">Locador:</label>
        <input disabled value="{{$locador->name}}" type="text" id="locador_id" name="locador_id" class="form-control" required="">
    </div>
    <div class="mb-3">
        <label for="categoria_id" class="form-label">Categoria:</label>
        <input disabled value="{{$categoria->titulo}}" type="text" id="categoria_id" name="categoria_id" class="form-control" required="">
    </div>
    
    <p>Deseja excluir esse registro?</p>
    <button type="submit" class="btn btn-danger">Sim</button>
    <a href="#" class="btn btn-secondary" onClick="history.back()">
        Não
    </a>
</form>

@endsection