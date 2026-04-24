@extends($layout)

@section('conteudo')

    <h1>Alterar equipamento</h1>
    <form method="post" action="/equipamentos/{{ $equipamento->id }}" enctype="multipart/form-data">
        @CSRF
        @METHOD('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input value="{{$equipamento->nome}}" type="text" id="nome" name="nome" class="form-control" required="">
        </div>
        <div class="mb-3">
            <label for="marca" class="form-label">Marca:</label>
            <input value="{{$equipamento->marca}}" type="text" id="marca" name="marca" class="form-control" required="">
        </div>
        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo:</label>
            <input value="{{$equipamento->modelo}}" type="text" id="modelo" name="modelo" class="form-control" required="">
        </div>
        <div class="mb-3">
            <label for="ano" class="form-label">Ano:</label>
            <input value="{{$equipamento->ano}}" type="number" id="ano" name="ano" class="form-control" required="">
        </div>
        <div class="mb-3">
            <label for="capacidade" class="form-label">Capacidade:</label>
            <input value="{{$equipamento->capacidade}}" type="text" id="capacidade" name="capacidade" class="form-control"
                required="">
        </div>
        <div class="mb-3">
            <label for="preco_periodo" class="form-label">Preco do Periodo:</label>
            <input value="{{$equipamento->preco_periodo}}" type="number" id="preco_periodo" name="preco_periodo"
                class="form-control" required="">
        </div>
        <div class="mb-3">
            <label for="disponibilidade_calendario" class="form-label">Disponibilidade Calendario:</label>
            <input value="{{$equipamento->disponibilidade_calendario}}" type="text" id="disponibilidade_calendario"
                name="disponibilidade_calendario" class="form-control" required="">
        </div>
        <div class="mb-3">
            <label for="raio_atendimento" class="form-label">Raio de Atendimento (km):</label>
            <input value="{{$equipamento->raio_atendimento}}" type="number" id="raio_atendimento" name="raio_atendimento"
                class="form-control" required="">
        </div>

        <div class="mb-3">
            <input type="hidden" id="hidden_certificado" name="exige_operador_certificado" value="0">
            <input type="checkbox" id="exige_operador_certificado" name="exige_operador_certificado" value="1"
            @if ($equipamento->exige_operador_certificado == 1)
            checked            
            @endif
            >
            <label for="exige_operador_certificado" class="form-label">Operador Certificado</label>
        </div>
        <div class="mb-3">
            <input type="hidden" id="hidden_seguro" name="seguro_obrigatorio" value="0">
            <input type="checkbox" id="seguro_obrigatorio" name="seguro_obrigatorio" value="1"
            @if ($equipamento->seguro_obrigatorio == 1)
            checked            
            @endif
            >
            <label for="seguro_obrigatorio" class="form-label">Seguro Obrigatório</label>
        </div>
        <div class="mb-3">
            <input type="hidden" id="hidden_caucao" name="caucao_obrigatoria" value="0">
            <input type="checkbox" id="caucao_obrigatoria" name="caucao_obrigatoria" value="1" 
            @if ($equipamento->caucao_obrigatoria == 1)
            checked            
            @endif
            >
            <label for="caucao_obrigatoria" class="form-label">Caução Obrigatória</label>
        </div>

        <div class="mb-3">
            <label for="locador_id" class="form-label">Selecione o Locador:</label>
            <select class="form-select" name="locador_id" id="locador_id">
                @foreach($locador as $l)
                    @if ($equipamento->locador_id == $l->id)
                        <option selected value="{{$l->id}}">{{ $l->name }}</option>
                    @else
                        <option value="{{$l->id}}">{{ $l->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="categoria_id" class="form-label">Selecione a Categoria:</label>
            <select class="form-select" name="categoria_id" id="categoria_id">
                @foreach($categorias as $c)
                    @if ($equipamento->categoria_id == $c->id)
                        <option selected value="{{$c->id}}">{{ $c->titulo }}</option>
                    @else
                        <option value="{{$c->id}}">{{ $c->titulo }}</option>
                    @endif
                @endforeach
            </select>
        </div>

            <!-- IMAGEM ATUAL -->
        @if($equipamento->image_path)
            <div class="mb-3">
                <label class="form-label">Imagem Atual:</label>
                <div>
                    <img src="{{ asset('storage/' . $equipamento->image_path) }}" 
                        alt="Imagem do equipamento" style="max-width: 200px; max-height: 150px; object-fit: cover;">
                </div>
                <div class="form-check mt-2">
                    <input type="checkbox" name="remover_imagem" value="1" id="remover_imagem" class="form-check-input">
                    <label for="remover_imagem" class="form-check-label">Remover imagem atual</label>
                </div>
            </div>
        @endif

        <div class="mb-3">
            <label for="foto" class="form-label">Nova Imagem (opcional):</label>
            <input type="file" id="foto" name="foto" class="form-control" accept="image/*">
        </div>

        

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
    </form>

@endsection