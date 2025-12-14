<?php
// Arquivo: includes/funcoes_dashboard.php


/**
 *  Conta o total de clientes ativos para uma empresa específica.
 *  @param mysqli $mysqli objeto da conexão
 *  @param int $empresa_id ID da empresa
 *  @return int Total de clientes ativos
 */
function dashboard_contar_clientes_ativos(mysqli $mysqli, int $empresa_id): int {

    // 1. Usa prepared statement para evitar SQL Injection
    $stmt = $mysqli->prepare("SELECT COUNT(id) AS total FROM clientes WHERE empresa_id = ? AND status = 'ativo' AND excluido = 0");

    // 2. Liga o parâmetro e executa
    $stmt->bind_param('i', $empresa_id);
    $stmt->execute();

    // 3. Obtém o resultado
    $resultado = $stmt->get_result();
    $count = $resultado->fetch_row()[0] ?? 0;

    // 4. Fecha o statement
    $stmt->close();

    return (int)$count;
} 