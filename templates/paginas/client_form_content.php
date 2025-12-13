<div class="mb-3">
    <h1 class="h3 d-inline align-middle"><?php echo htmlspecialchars($titulo_pagina); ?></h1>
</div>

<div class="row">

    <div class="col-lg-4">

        <form method="POST" action="clientes.php?acao=salvar"> 

            <?php if(isset($dados['id']) && $dados['id'] > 0): ?>
               
                <input type="hidden" name="id" value="<?php echo $dados['id']; ?>">
            
            <?php endif; ?>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">CNPJ/CPF</h5>
                </div>
                <div class="card-body">
                    <input name="cpf_cnpj" type="text" class="form-control" placeholder="CNPJ/CPF" value="<?php echo htmlspecialchars($dados['documento'] ?? ''); ?>">
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Razão social/Nome</h5>
                </div>
                <div class="card-body">
                    <input name="nome" type="text" class="form-control" placeholder="Razão social/Nome" value="<?php echo htmlspecialchars($dados['nome'] ?? ''); ?>">
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">E-mail de contato</h5>
                </div>
                <div class="card-body">
                    <input name="email" type="text" class="form-control" placeholder="E-mail de contato" value="<?php echo htmlspecialchars($dados['email_contato'] ?? ''); ?>">
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Status</h5>
                </div>
                <div class="card-body">
                    <select class="form-select mb-3" name="status">
                        <option value="ativo" <?php echo (isset($dados['status']) && $dados['status'] == 'ativo') ? 'selected' : ''; ?>>
                            Ativo
                        </option>
                        <option value="inativo" <?php echo (isset($dados['status']) && $dados['status'] == 'inativo') ? 'selected' : ''; ?>>
                            Inativo
                        </option>
                    </select>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <button class="btn btn-primary" type="submit">Cadastrar cliente</button>
                    <a href="clientes.php" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </form>

    </div>


</div>