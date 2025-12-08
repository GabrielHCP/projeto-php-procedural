
<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Meus</strong> resultados</h1>

    <div class="row">
        <!-- Card Sales -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Faturamento</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="dollar-sign"></i>
                            </div>
                        </div>
                    </div>

                    <h1 class="mt-1 mb-3">R$ 2.382</h1>

                </div>
            </div>
        </div>

        <!-- Card Earnings -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Clientes ativos</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="users"></i>
                            </div>
                        </div>
                    </div>

                    <h1 class="mt-1 mb-3"><?php echo htmlspecialchars($dados['total_clientes_ativos']); ?></h1>
                  
                </div>
            </div>
        </div>

        <!-- Card Visitors -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Orçamentos emitidos</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="file"></i>
                            </div>
                        </div>
                    </div>

                    <h1 class="mt-1 mb-3">15</h1>
                    
                </div>
            </div>
        </div>

        <!-- Card Orders -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Tickets</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="message-circle"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">64</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
       <div class="col-12 col-lg-6 col-xxl-6 d-flex">
            <div class="card flex-fill">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Clientes</h5>
                    <span class="badge bg-primary">5</span>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <h6 class="mb-1">Project Apollo</h6>
                                <small class="text-muted">ID: #001</small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-success mb-1">Ativo</span>
                                <small class="d-block text-muted">01/01/2021</small>
                            </div>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <h6 class="mb-1">Project Zeus</h6>
                                <small class="text-muted">ID: #002</small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-warning mb-1">Pendente</span>
                                <small class="d-block text-muted">15/02/2021</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="#" class="btn btn-sm btn-primary">Ver todos os clientes</a>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6 col-xxl-6 d-flex">
            <div class="card flex-fill">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Orçamentos emitidos</h5>
                    <span class="badge bg-info">3</span>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <h6 class="mb-1">Orçamento Apollo</h6>
                                <small class="text-muted">ID: #ORC-001</small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-success mb-1">Aprovado</span>
                                <small class="d-block text-muted">R$ 15.000,00</small>
                            </div>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <h6 class="mb-1">Orçamento Zeus</h6>
                                <small class="text-muted">ID: #ORC-002</small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-warning mb-1">Em análise</span>
                                <small class="d-block text-muted">R$ 8.500,00</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="#" class="btn btn-sm btn-info">Ver todos os orçamentos</a>
                </div>
            </div>
        </div>
    </div>
</div>