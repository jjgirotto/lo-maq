@extends($layout)

@section('conteudo')

<div class="text-center my-5">
    <h1 class="display-4 fw-bold">Bem-vindo ao LOMAQ - Admin</h1>
    <h5 class="lead text-muted"><strong>Gerencie de forma prática e rápida.</strong></h5>
</div>

<div class="container mt-5">
    <div class="row g-4">
 

        <!-- Card Categorias -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card-body shadow-sm border-0 rounded-3">
                    <div class="card-body p-3 text-center">
                        <h5 class="card-title fw-semibold mb-3">Categorias</h5>
                        <p class="card-text text-muted">Gerencie todas as categorias disponíveis.</p>
                        <a href="/categorias" class="btn btn-primary btn-sm w-100">Abrir</a>
                    </div>
                </div>
            </div>

        <!-- Card Equipamentos -->
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card-body shadow-sm border-0 rounded-3">
                <div class="card-body p-3 text-center">
                    <h5 class="card-title fw-semibold mb-3">Equipamentos</h5>
                    <p class="card-text text-muted">Visualize, adicione ou edite equipamentos.</p>
                    <a href="/equipamentos" class="btn btn-primary btn-sm w-100">Abrir</a>
                </div>
            </div>
        </div>


        <!-- TEMPORARIO, ATÉ DECIDIRMOS COMO FICARÁ LOCADORES/LOCATARIOS -->
        <!-- Card Locadores -->
        <!-- <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card-body shadow-sm border-0 rounded-3">
                <div class="card-body p-3 text-center">
                    <h5 class="card-title fw-semibold mb-3">Locações</h5>
                    <p class="card-text text-muted">Gerencie informações das Locacoes.</p>
                    <a href="/adm/locacoes" class="btn btn-primary btn-sm w-100">Abrir</a>
                </div>
            </div>
        </div> -->

        <!-- Card Locatários -->
        <!-- <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card-body shadow-sm border-0 rounded-3">
                <div class="card-body p-3 text-center">
                    <h5 class="card-title fw-semibold mb-3">Usuários</h5>
                    <p class="card-text text-muted">Gerencie informações dos Usuários.</p>
                    <a href="/adm/users" class="btn btn-primary btn-sm w-100">Abrir</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card-body shadow-sm border-0 rounded-3">
                <div class="card-body p-3 text-center">
                    <h5 class="card-title fw-semibold mb-3">Anúncios</h5>
                    <p class="card-text text-muted">Gerencie informações dos Anúncios.</p>
                    <a href="{{ route('anuncios.meus') }}" class="btn btn-primary btn-sm w-100">Abrir</a>
                </div>
            </div>
        </div> -->

    </div>
</div>

@endsection