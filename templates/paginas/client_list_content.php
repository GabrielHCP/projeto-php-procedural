<div class="row mb-3">
    <div class="col-12">
        <a href="clientes.php?acao=adicionar" class="btn btn-primary">Cadastrar novo cliente</a>
    </div>
</div>
<div class="row">
    <div class="col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header">

                <h5 class="card-title mb-0">Clientes cadastrados</h5>
            </div>
            <table class="table table-hover my-0">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th class="d-none d-xl-table-cell">E-mail</th>
                        <th class="d-none d-xl-table-cell">Status</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        // Loop da variável definida no Controller (clientes.php)
                        foreach($dados['lista_clientes'] as $cliente):
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($cliente['nome']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['email_contato'])?></td>
                        <td>
                            <?php 
                                $status_cliente = htmlspecialchars($cliente['status']);
                                $badge_class = ($status_cliente == 'ativo') ? 'bg-success' : 'bg-warning';
                            ?>
                            <span class="badge <?php echo $badge_class; ?>"><?php echo ucfirst($status_cliente); ?></span>
                        </td>
                        <td>
                            <a href="clientes.php?acao=editar&id=<?php echo $cliente['id']; ?>" class="btn btn-sm btn-info">Editar</a>
                            <a href="clientes.php?acao=excluir&id=<?php echo $cliente['id']; ?>" class="btn btn-sm btn-danger">Excluir</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
