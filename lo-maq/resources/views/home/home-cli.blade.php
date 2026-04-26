@extends($layout)

@section('conteudo')

    <div class="text-center my-5">
        <h1 class="display-4 fw-bold">Bem-vindo ao LOMAQ - Cliente HOME-CLI</h1>
        <h5 class="lead text-muted"><strong>Busque e Anuncie equipamentos para alugar de forma prática e rápida.</strong></h5>
    </div>

    <div class="container mt-5">
        <div class="row g-4">


            <!-- Card Categorias -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <a href="/buscar" class="btn btn-primary btn-sm w-100">
                    <div class="card-body shadow-sm border-0 rounded-3">
                        <div class="card-body p-3 text-center">
                            <h5 class="card-title fw-semibold mb-3">Buscar</h5>
                            <p class="card-text text-muted">Busque equipamentos disponíveis.</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card Equipamentos -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <a href="/anunciar" class="btn btn-primary btn-sm w-100">
                    <div class="card-body shadow-sm border-0 rounded-3">
                        <div class="card-body p-3 text-center">
                            <h5 class="card-title fw-semibold mb-3">Anunciar</h5>
                            <p class="card-text text-muted">Anuncie seus equipamentos.</p>

                        </div>
                    </div>
                </a>
            </div>

            <!-- Card Locadores -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <a href="#" class="btn btn-primary btn-sm w-100">
                    <div class="card-body shadow-sm border-0 rounded-3">
                        <div class="card-body p-3 text-center">
                            <h5 class="card-title fw-semibold mb-3">Minhas Locacoes</h5>
                            <p class="card-text text-muted">Consulte suas locacoes</p>

                        </div>
                    </div>
                </a>
            </div>

            <!-- Card Locatários -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <a href="#" class="btn btn-primary btn-sm w-100">
                    <div class="card-body shadow-sm border-0 rounded-3">
                        <div class="card-body p-3 text-center">
                            <h5 class="card-title fw-semibold mb-3">Meus Anuncios</h5>
                            <p class="card-text text-muted">Visualize e Edite seus anuncios</p>

                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>

@endsection