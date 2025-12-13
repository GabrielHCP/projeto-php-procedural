<?php

// Arquivo: includes/funcoes_clientes.php


/**
 *  Lista todos os clientes para a empresa logada.
 *  @param mysqli $mysqli objeto de conexão
 *  @param int $empresa_id ID da empresa logada
 *  @return array lista de clientes
 */
function listar_todos_clientes(mysqli $mysqli, int $empresa_id): array {

    $sql = "SELECT id, nome, email_contato, status, data_cadastro FROM clientes
            WHERE empresa_id = ? 
                AND excluido = 0 /* flag para pegar apenas clientes não excluídos */
            ORDER BY id ASC";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $empresa_id);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $lista = $resultado->fetch_all(MYSQLI_ASSOC);

    $stmt->close();

    return $lista;
}

/**
 * Insere ou atualiza um cliente no banco de dados
 * @param mysqli $mysqli objeto de conexão
 * @param int empresa_id ID da empresa logada
 * @param array $dados do formulário (POST)
 * @return bool
 */
function salvar_cliente(mysqli $mysqli, int $empresa_id, array $dados): bool {

    // 1. Limpeza básica e validação
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $documento = trim($dados['cpf_cnpj'] ?? ''); // Mudando 'cpf_cnpj' para documento
    $status = $dados['status'] ?? 'ativo';
    
    if(empty($nome) || empty($email)) {
        return false; // Em um sistema real o ideal é retornar o erro.
    }

    // 2. Lógica de INSERT vs. UPDATE
    if(!empty($dados['id'])) {
        // É EDIÇÃO (UPDATE)
        $sql = "UPDATE clientes SET nome = ?, documento = ?, email_contato = ?, status = ? WHERE id = ? AND empresa_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ssssii', $nome, $documento, $email, $status, $dados['id'], $empresa_id);
    } else {
        // É CADASTRO (INSERT)
        $sql = "INSERT INTO clientes (nome, documento, email_contato, status, empresa_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ssssi', $nome, $documento, $email, $status, $empresa_id);
    }

    $sucesso = $stmt->execute();
    $stmt->close();

    return $sucesso;
}

/**
 * Busca informações do cliente pelo ID
 * @param mysqli $mysqli objeto de conexão
 * @param int empresa_id ID da empresa logada
 * @param int $cliente_id ID do cliente gravado no banco
 * @return array $lista retorna o array com os dados
 */
function buscar_cliente_por_id(mysqli $mysqli, int $empresa_id, int $cliente_id): array {

    // 1. Montando query para buscar cliente.
    $sql = "SELECT * FROM clientes WHERE id = ? AND empresa_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ii', $cliente_id, $empresa_id);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $cliente = $resultado->fetch_assoc();

    $stmt->close();

    return $cliente;
}

/**
 * Realiza a exclusão lógica (Soft Delete) de um cliente, filtrado pela empresa.
 * @param mysqli $mysqli Objeto de conexão
 * @param int $empresa_id ID da empresa logada
 * @param int $cliente_id ID do cliente a ser excluído
 * @return bool Retorna true se a exclusão foi bem-sucedida.
 */
function excluir_cliente(mysqli $mysqli, int $empresa_id, int $cliente_id): bool {

    // 1. Setando a flag de exclusão
    $sql = "UPDATE clientes SET excluido = 1 WHERE id = ? AND empresa_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ii', $cliente_id, $empresa_id);

    $sucesso = $stmt->execute();
    $stmt->close();

    return $sucesso;
}